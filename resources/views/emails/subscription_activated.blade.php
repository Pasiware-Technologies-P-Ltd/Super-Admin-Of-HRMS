<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>License Activated | PASIWARE HRM</title>
    <style>
        body { font-family: 'Outfit', Arial, sans-serif; background: #f4f7f9; margin: 0; padding: 0; color: #334155; }
        .wrapper { width: 100%; max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .hero { background: #10b981; padding: 50px 30px; text-align: center; color: white; }
        .hero h1 { margin: 0; font-size: 28px; }
        .hero p { opacity: 0.9; margin: 10px 0 0; }
        .main { padding: 40px 30px; }
        .info-card { background: #f8fafc; border: 1px solid #e1e7ec; border-radius: 10px; padding: 25px; margin-bottom: 30px; }
        .info-card table { width: 100%; }
        .info-card td { padding: 10px 0; border-bottom: 1px solid #e2e8f0; }
        .info-card td:last-child { text-align: right; font-weight: 700; color: #1e293b; }
        .btn { display: inline-block; padding: 15px 35px; background: #10b981; color: white !important; text-decoration: none; border-radius: 30px; font-weight: 700; }
        .footer { padding: 30px; text-align: center; font-size: 13px; color: #94a3b8; }
        .highlight { color: #10b981; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="hero">
            <h1>License Activated Successfully!</h1>
            <p>Your Organization is now empowered with {{ $subscription->plan->plan_name }}</p>
        </div>
        
        <div class="main">
            <h3>Hello {{ $subscription->company->name }},</h3>
            <p>Your subscription has been successfully activated by the Super Admin. You can now access your full Enterprise Dashboard with the following plan details:</p>
            
            <div class="info-card">
                <h4 style="margin:0 0 15px; color: #64748b; font-size:12px; text-transform:uppercase; letter-spacing:1px;">Activation Receipt</h4>
                <table>
                    <tr>
                        <td style="color:#64748b;">Plan Name:</td>
                        <td>{{ $subscription->plan->plan_name }}</td>
                    </tr>
                    <tr>
                        <td style="color:#64748b;">Setup Fee (Base):</td>
                        <td>₹{{ number_format($subscription->paid_amount) }}</td>
                    </tr>
                    <tr>
                        <td style="color:#64748b;">GST (18%):</td>
                        <td>₹{{ number_format($subscription->paid_amount * 0.18, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="color:#64748b; font-weight:700;">Grand Total:</td>
                        <td class="highlight" style="font-size:18px;">₹{{ number_format($subscription->paid_amount * 1.18) }}</td>
                    </tr>
                    <tr>
                        <td style="color:#64748b;">Per-Employee Rate:</td>
                        <td>₹{{ $subscription->employee_per_price }}/mo</td>
                    </tr>
                    <tr>
                        <td style="color:#64748b;">Maximum Capacity:</td>
                        <td style="color:#6366f1;">{{ $subscription->employee_capacity }} Users</td>
                    </tr>
                </table>
            </div>

            <p style="text-align: center;">
                <a href="{{ config('app.url') }}" class="btn">Login to HRM Portal</a>
            </p>
        </div>
        
        <div class="footer">
            &copy; {{ date('Y') }} PASIWARE Technologies. All rights reserved.<br>
            Managed by PASIWARE HRM Super Admin.
        </div>
    </div>
</body>
</html>
