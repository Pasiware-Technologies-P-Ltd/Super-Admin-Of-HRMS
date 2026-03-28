<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HrmSubscription extends Model
{
    use HasFactory;

    protected $table = 'hrm_subscriptions';
    protected $fillable = ['company_id', 'plan_id', 'paid_amount', 'employee_per_price', 'employee_capacity', 'status', 'total_employee', 'active_employee'];
    public $timestamps = true;

    public function plan()
    {
        return $this->belongsTo(HrmPlan::class, 'plan_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }

    public function getTotalEmployees()
    {
        return DB::table('employees')->where('company_id', $this->company_id)->count();
    }

    public function getActiveEmployees()
    {
        // Assuming 'status' column exists in employees table and uses 'active' string
        return DB::table('employees')->where('company_id', $this->company_id)->where('status', 'active')->count();
    }
}
