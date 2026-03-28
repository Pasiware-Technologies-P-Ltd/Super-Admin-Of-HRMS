<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\HrmPlan;
use App\Models\HrmSubscription;
use App\Models\HrmUpgrade;
use App\Models\HrmInvoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyRegistered;
use App\Mail\SubscriptionActivated;
use App\Mail\PlanUpgraded;

class SuperAdminController extends Controller
{
    public function index()
    {
        $recentSubscriptions = HrmSubscription::with(['company', 'plan'])->latest()->take(5)->get();
        $recentUpgrades = HrmUpgrade::with(['company', 'oldPlan', 'newPlan'])->latest()->take(5)->get();
        $companies = Company::where('status', 'active')->get(); // Add this back for modals
        $plans = HrmPlan::where('status', 'active')->get();
        
        $stats = [
            'total_companies' => Company::count(),
            'active_companies' => Company::where('status', 'active')->count(),
            'active_subscriptions' => HrmSubscription::where('status', 'active')->count(),
            'total_employees' => DB::table('employees')->count(),
            'total_revenue' => HrmSubscription::sum('paid_amount'),
            'monthly_revenue' => HrmSubscription::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('paid_amount'),
            'total_plans' => HrmPlan::count(),
        ];

        return view('superadmin.dashboard', compact('recentSubscriptions', 'recentUpgrades', 'companies', 'plans', 'stats'));
    }

    public function companiesList(Request $request)
    {
        $query = Company::with('subscription.plan');

        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('mobile', 'like', "%$search%")
                  ->orWhere('company_id', 'like', "%$search%");
            });
        }

        $companies = $query->latest()->get();
        $plans = HrmPlan::where('status', 'active')->get();
        
        return view('superadmin.companies', compact('companies', 'plans'));
    }

    public function storeCompany(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'company_type' => 'required',
            'state' => 'required',
            'country' => 'required',
        ]);

        $lastCompany = Company::orderBy('id', 'desc')->first();
        if (!$lastCompany || !str_contains($lastCompany->company_id, 'PWTCMP')) {
            $company_id = 'PWTCMP501';
        } else {
            $lastNumber = (int) str_replace('PWTCMP', '', $lastCompany->company_id);
            $company_id = 'PWTCMP' . ($lastNumber + 1);
        }
        
        try {
            $company = Company::create([
                'company_id' => $company_id,
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'company_type' => $request->company_type,
                'state' => $request->state,
                'country' => $request->country,
                'gst_no' => $request->gst_no,
                'status' => 'active'
            ]);

            // Send Professional Email
            try {
                Mail::to($company->email)->send(new CompanyRegistered($company));
            } catch (\Exception $e) {
                \Log::error("Mail Error (Registration): " . $e->getMessage());
            }

            return redirect()->back()->with('success', "Company ($company_id) registered successfully!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function updateCompany(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:active,inactive'
        ]);

        try {
            $company = Company::where('company_id', $id)->firstOrFail();
            $company->update($request->all());
            return redirect()->back()->with('success', 'Company updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function storeSubscription(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:company,company_id',
            'plan_id' => 'required|exists:hrm_plan,id'
        ]);

        try {
            $plan = HrmPlan::find($request->plan_id);
            
            // Check if already subscribed
            $existing = HrmSubscription::with('plan')->where('company_id', $request->company_id)->first();
            if ($existing) {
                return redirect()->back()->with('error', "Organization ({$request->company_id}) is already subscribed to '{$existing->plan->plan_name}'. Please use 'Upgrade Plan' to change capacity.");
            }

            $subscription = HrmSubscription::with('company')->updateOrCreate(
                ['company_id' => $request->company_id],
                [
                    'plan_id' => $plan->id,
                    'paid_amount' => $plan->price,
                    'employee_per_price' => $plan->employee_per_price,
                    'employee_capacity' => $plan->employee_capacity,
                    'status' => 'active',
                    'total_employee' => '0',
                    'active_employee' => '0'
                ]
            );

            // Generate Invoice Record
            $baseAmount = $plan->price;
            $gstAmount = $baseAmount * 0.18;
            $totalAmount = $baseAmount + $gstAmount;

            $invoice = HrmInvoice::create([
                'invoice_no' => $this->generateInvoiceNo(),
                'company_id' => $subscription->company->id,
                'billing_type' => 'subscription',
                'billing_id' => $subscription->id,
                'base_amount' => $baseAmount,
                'gst_amount' => $gstAmount,
                'total_amount' => $totalAmount,
            ]);

            // Send Professional Email
            try {
                $subscription->load('plan');
                $amount_in_words = $this->numberToWords($invoice->total_amount);
                Mail::to($subscription->company->email)->send(new SubscriptionActivated($subscription, $invoice, $amount_in_words));
            } catch (\Exception $e) {
                \Log::error("Mail Error (Activation): " . $e->getMessage());
            }

            return redirect()->back()->with('success', 'Plan subscribed successfully! Invoice #' . $invoice->invoice_no);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /* HRM Plan Management */
    public function plansList()
    {
        $plans = HrmPlan::all();
        return view('superadmin.plans', compact('plans'));
    }

    public function storePlan(Request $request)
    {
        $request->validate([
            'plan_name' => 'required',
            'price' => 'required|numeric',
            'employee_capacity' => 'required|integer',
        ]);

        try {
            HrmPlan::create($request->all() + ['status' => 'active']);
            return redirect()->back()->with('success', 'Plan created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function updatePlan(Request $request, $id)
    {
        $request->validate([
            'plan_name' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive'
        ]);

        try {
            $plan = HrmPlan::findOrFail($id);
            $plan->update($request->all());
            return redirect()->back()->with('success', 'Plan updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function subscriptionsList(Request $request)
    {
        $query = HrmSubscription::with(['company', 'plan']);

        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('company_id', 'like', "%$search%")
                  ->orWhereHas('company', function($sq) use ($search) {
                      $sq->where('name', 'like', "%$search%");
                  });
            });
        }

        $subscriptions = $query->latest()->get();
        return view('superadmin.subscriptions', compact('subscriptions'));
    }

    public function updateSubscriptionStatus(Request $request, $id)
    {
        try {
            $sub = HrmSubscription::findOrFail($id);
            $sub->update(['status' => $request->status]);
            return redirect()->back()->with('success', 'Subscription status updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /* HRM Plan Upgrade */
    public function upgradesList(Request $request)
    {
        $query = HrmUpgrade::with(['company', 'oldPlan', 'newPlan']);

        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('company_id', 'like', "%$search%")
                  ->orWhereHas('company', function($sq) use ($search) {
                      $sq->where('name', 'like', "%$search%");
                  });
            });
        }

        $upgrades = $query->latest()->get();
        return view('superadmin.upgrades', compact('upgrades'));
    }

    public function upgradePlan(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'new_plan_id' => 'required|exists:hrm_plan,id'
        ]);

        try {
            $subscription = HrmSubscription::with(['plan', 'company'])->where('company_id', $request->company_id)->firstOrFail();
            $newPlan = HrmPlan::findOrFail($request->new_plan_id);

            // Validation: New capacity must be greater
            if ($newPlan->employee_capacity <= $subscription->employee_capacity) {
                return redirect()->back()->with('error', 'Upgrade failed: New plan capacity must be greater than current capacity (' . $subscription->employee_capacity . ' Users).');
            }

            // Calculation: Subtract old setup fee from new one
            $oldSetupFee = $subscription->paid_amount;
            $newSetupFeeResult = max(0, $newPlan->price - $oldSetupFee);

            // Save specialized history
            $upgrade = HrmUpgrade::create([
                'company_id' => $subscription->company_id,
                'old_plan_id' => $subscription->plan_id,
                'new_plan_id' => $newPlan->id,
                'old_setup_fee' => $oldSetupFee,
                'new_setup_fee' => $newSetupFeeResult,
                'old_emp_price' => $subscription->employee_per_price,
                'new_emp_price' => $newPlan->employee_per_price,
                'old_capacity' => $subscription->employee_capacity,
                'new_capacity' => $newPlan->employee_capacity,
            ]);

            // Update Subscription
            $subscription->update([
                'plan_id' => $newPlan->id,
                'paid_amount' => $newPlan->price, 
                'employee_per_price' => $newPlan->employee_per_price,
                'employee_capacity' => $newPlan->employee_capacity,
            ]);

            // Generate Invoice Record
            $baseAmount = $newSetupFeeResult;
            $gstAmount = $baseAmount * 0.18;
            $totalAmount = $baseAmount + $gstAmount;

            $invoice = HrmInvoice::create([
                'invoice_no' => $this->generateInvoiceNo(),
                'company_id' => $subscription->company->id,
                'billing_type' => 'upgrade',
                'billing_id' => $upgrade->id,
                'base_amount' => $baseAmount,
                'gst_amount' => $gstAmount,
                'total_amount' => $totalAmount,
            ]);

            // Send Professional Email
            try {
                $amount_in_words = $this->numberToWords($invoice->total_amount);
                Mail::to($subscription->company->email)->send(new PlanUpgraded($upgrade->load(['oldPlan', 'newPlan', 'company']), $invoice, $amount_in_words));
            } catch (\Exception $e) {
                \Log::error("Mail Error (Upgrade): " . $e->getMessage());
            }

            return redirect()->back()->with('success', "Plan upgraded successfully! Invoice #" . $invoice->invoice_no);
        } catch (\Exception $e) {
            \Log::error("Upgrade Error: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine());
            return redirect()->back()->with('error', 'Major Error: ' . $e->getMessage());
        }
    }

    public function invoicesList(Request $request)
    {
        $search = $request->input('search');

        $invoices = HrmInvoice::with('company')
            ->when($search, function ($query, $search) {
                return $query->where('invoice_no', 'like', "%{$search}%")
                    ->orWhereHas('company', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                          ->orWhere('company_id', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(15);

        return view('superadmin.invoices', compact('invoices'));
    }

    public function downloadInvoice($id)
    {
        $invoice = HrmInvoice::with('company')->findOrFail($id);
        
        // Get details based on type
        $item_name = "N/A";
        $item_capacity = 0;

        if($invoice->billing_type == 'subscription') {
            $sub = HrmSubscription::with('plan')->find($invoice->billing_id);
            if($sub) {
                $item_name = $sub->plan->plan_name;
                $item_capacity = $sub->employee_capacity;
            }
        } else {
            $upg = HrmUpgrade::with('newPlan')->find($invoice->billing_id);
            if($upg) {
                $item_name = $upg->newPlan->plan_name;
                $item_capacity = $upg->new_capacity;
            }
        }

        $pdf = Pdf::loadView('pdf.invoice', [
            'invoice' => $invoice,
            'item_name' => $item_name,
            'item_capacity' => $item_capacity,
            'amount_in_words' => $this->numberToWords($invoice->total_amount)
        ]);
        
        return $pdf->download($invoice->invoice_no . '.pdf');
    }

    private function generateInvoiceNo()
    {
        $year = date('Y');
        $lastInvoice = HrmInvoice::whereYear('created_at', $year)->orderBy('id', 'desc')->first();
        
        if (!$lastInvoice) {
            $number = 1;
        } else {
            $lastNo = explode('-', $lastInvoice->invoice_no);
            $number = (int) end($lastNo) + 1;
        }
        
        return 'INV-' . $year . '-' . str_pad($number, 5, '0', STR_PAD_LEFT);
    }

    private function numberToWords($number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty',
            30 => 'Thirty', 40 => 'Forty', 50 => 'Fifty',
            60 => 'Sixty', 70 => 'Seventy',
            80 => 'Eighty', 90 => 'Ninety');
        $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
    }
}
