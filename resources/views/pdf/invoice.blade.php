<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->invoice_no }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; color: #333; font-size: 13px; line-height: 1.4; margin: 0; padding: 0; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; }
        .header { display: flex; justify-content: space-between; border-bottom: 2px solid #6366f1; padding-bottom: 20px; margin-bottom: 20px; }
        .company-logo { font-size: 24px; font-weight: bold; color: #6366f1; }
        .company-info { font-size: 11px; text-align: right; }
        .invoice-title { font-size: 28px; font-weight: bold; color: #1e293b; text-transform: uppercase; margin: 20px 0; }
        .bill-grid { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .bill-grid td { vertical-align: top; width: 50%; }
        .section-title { font-weight: bold; color: #64748b; text-transform: uppercase; font-size: 10px; margin-bottom: 5px; border-bottom: 1px solid #e2e8f0; }
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .items-table th { background: #f8fafc; border-bottom: 2px solid #e2e8f0; padding: 10px; text-align: left; font-size: 11px; color: #64748b; }
        .items-table td { padding: 12px 10px; border-bottom: 1px solid #f1f5f9; }
        .totals { width: 40%; float: right; }
        .totals table { width: 100%; border-collapse: collapse; }
        .totals td { padding: 8px 10px; text-align: right; }
        .grand-total { background: #6366f1; color: white; font-weight: bold; }
        .footer { margin-top: 100px; padding-top: 20px; border-top: 1px solid #e2e8f0; font-size: 10px; text-align: center; color: #94a3b8; }
        .gst-badge { font-size: 10px; background: #f1f5f9; padding: 2px 6px; border-radius: 4px; border: 1px solid #e2e8f0; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table style="width:100%;">
            <tr>
                <td><div class="company-logo">PASIWARE TECHNOLOGIES (P) LTD.</div></td>
                <td style="text-align:right;">
                    <div style="font-weight:bold; font-size:14px;">TAX INVOICE</div>
                    <div style="font-size:11px; color:#64748b;">#{{ $invoice->invoice_no }}</div>
                </td>
            </tr>
        </table>

        <div style="margin-top:20px;">
            <table class="bill-grid">
                <tr>
                    <td>
                        <div class="section-title">Seller Details (From)</div>
                        <div style="font-weight:bold;">Pasiware Technologies (P) Ltd.</div>
                        <div>CIN: U62013UP2024PTC200353</div>
                        <div>GSTIN: <span style="font-weight:bold; color:#6366f1;">09AAOCP6250E1Z7</span></div>
                        <div style="margin-top:5px;">Reg. Office: Co Ramashankar Singh, NONI SARVAT, Ghorawal, Sonbhadra, UP 231215</div>
                        <div>Branch: Aktha, Paharia, Varanasi (U.P) 221007</div>
                        <div>Email: support@pasiware.com | Call: +91 9648022011</div>
                    </td>
                    <td style="text-align:right;">
                        <div class="section-title">Buyer Details (To)</div>
                        <div style="font-weight:bold;">{{ $invoice->company->name }}</div>
                        <div>Company ID: {{ $invoice->company->company_id }}</div>
                        @if($invoice->company->gst_no)
                            <div>GSTIN: <span style="font-weight:bold;">{{ $invoice->company->gst_no }}</span></div>
                        @endif
                        <div>Email: {{ $invoice->company->email }}</div>
                        <div>Address: {{ $invoice->company->address ?: 'N/A' }}, {{ $invoice->company->state }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <div style="margin:20px 0; font-size:11px;">
            <strong>Invoice Date:</strong> {{ $invoice->created_at->format('d M Y') }} | 
            <strong>Billing Cycle:</strong> One-time Setup
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th style="text-align:right;">Unit Price</th>
                    <th style="text-align:center;">Qty</th>
                    <th style="text-align:right;">Amount (Excl. GST)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div style="font-weight:bold;">{{ $invoice->billing_type == 'upgrade' ? 'Plan Upgrade License Fee' : 'New License Subscription Fee' }}</div>
                        <div style="font-size:10px; color:#64748b;">
                            Plan: {{ $item_name }} | Capacity: {{ $item_capacity }} Users
                        </div>
                    </td>
                    <td style="text-align:right;">&#8377;{{ number_format($invoice->base_amount) }}</td>
                    <td style="text-align:center;">1</td>
                    <td style="text-align:right;">&#8377;{{ number_format($invoice->base_amount) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="totals">
            <table>
                <tr>
                    <td>Subtotal:</td>
                    <td>&#8377;{{ number_format($invoice->base_amount) }}</td>
                </tr>
                <tr>
                    <td>GST (18%):</td>
                    <td>&#8377;{{ number_format($invoice->gst_amount, 2) }}</td>
                </tr>
                <tr class="grand-total">
                    <td style="padding:12px 10px;">Grand Total:</td>
                    <td style="padding:12px 10px;">&#8377;{{ number_format($invoice->total_amount) }}</td>
                </tr>
            </table>
        </div>

        <div style="clear:both; margin-top:40px;">
            <div style="font-size:11px; color:#64748b;">
                <strong>Amount in words:</strong><br>
                {{ $amount_in_words }} Only.
            </div>
        </div>

        <div class="footer">
            This is a computer generated tax invoice and does not require a physical signature.<br>
            © {{ date('Y') }} Pasiware Technologies (P) Ltd.
        </div>
    </div>
</body>
</html>
