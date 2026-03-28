<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Plan Upgrade Successful | PASIWARE HRM</title>
    <style>
        body { font-family: 'Outfit', sans-serif; background: #fdfdfd; margin: 0; padding: 0; color: #3c4858; }
        .wrapper { width: 100%; max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .hero { background: #6366f1; background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); padding: 50px 30px; text-align: center; color: white; }
        .hero h1 { margin: 0; font-size: 28px; }
        .hero p { opacity: 0.9; margin: 10px 0 0; }
        .main { padding: 40px 30px; }
        .info-card { background: #fdfdfd; border: 1px dashed #e1e7ec; border-radius: 10px; padding: 25px; margin-bottom: 30px; }
        .info-card table { width: 100%; font-size: 14px; }
        .info-card td { padding: 12px 0; border-bottom: 1px solid #f1f5f9; }
        .info-card td:last-child { text-align: right; color: #1e293b; font-weight: 600; }
        .btn { display: inline-block; padding: 15px 35px; background: #6366f1; color: white !important; text-decoration: none; border-radius: 30px; font-weight: 700; }
        .footer { padding: 30px; text-align: center; font-size: 13px; color: #94a3b8; }
        .upgrade-badge { background: #ec4899; color: white; padding: 2px 10px; border-radius: 10px; font-size: 10px; text-transform: uppercase; font-weight: 700; margin-left: 10px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="hero">
            <h1>🚀 Plan Upgrade Successful!</h1>
            <p>Your Organization has been migrated to {{ $upgrade->newPlan->plan_name }}</p>
        </div>
        
        <div class="main">
            <h3>Congratulations {{ $upgrade->company->name }},</h3>
            <p>Your request to upgrade your license has been executed successfully. Your organization now has expanded capacity and enhanced capabilities!</p>
            
            <div class="info-card">
                <h4 style="margin:0 0 15px; color: #64748b; font-size:11px; text-transform:uppercase; letter-spacing:1px;">Migration Summary (Old vs New)</h4>
                <table>
                    <tr>
                        <td style="color:#64748b;">Previous Plan:</td>
                        <td>{{ $upgrade->oldPlan->plan_name }}</td>
                    </tr>
                    <tr>
                        <td style="color:#64748b;">New Active Plan:</td>
                        <td>{{ $upgrade->newPlan->plan_name }} <span class="upgrade-badge">Activated</span></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="background: #f8fafc; padding: 5px 10px; font-weight: 700; font-size: 11px; color: #6366f1; border-radius: 5px;">CAPACITY & PRICING UPDATE</td>
                    </tr>
                    <tr>
                        <td style="color:#64748b;">Employee Capacity:</td>
                        <td>{{ $upgrade->old_capacity }} <span style="color:#94a3b8; font-weight:400;">→</span> <span style="color:#6366f1;">{{ $upgrade->new_capacity }} Users</span></td>
                    </tr>
                    <tr>
                        <td style="color:#64748b;">Per-Employee Rate:</td>
                        <td>₹{{ $upgrade->old_emp_price }} <span style="color:#94a3b8; font-weight:400;">→</span> <span style="color:#10b981;">₹{{ $upgrade->new_emp_price }} /mo</span></td>
                    </tr>
                    <tr>
                        <td style="color:#64748b; font-size:11px;">Upgrade Subtotal:</td>
                        <td style="font-size:12px;">₹{{ number_format($upgrade->new_setup_fee) }}</td>
                    </tr>
                    <tr>
                        <td style="color:#64748b; font-size:11px;">GST (18%):</td>
                        <td style="font-size:12px;">₹{{ number_format($upgrade->new_setup_fee * 0.18, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="color:#6366f1; font-weight:700; padding-top:15px;">TOTAL UPGRADE FEE:</td>
                        <td style="color: #10b981; font-weight:800; font-size:16px; padding-top:15px;">₹{{ number_format($upgrade->new_setup_fee * 1.18) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border:none; text-align: right; font-size: 10px; color: #94a3b8;">*Difference calculated from previous setup fee.</td>
                    </tr>
                </table>
            </div>

            <p style="text-align: center;">
                <a href="{{ config('app.url') }}" class="btn">Login to Enterprise Dashboard</a>
            </p>
        </div>
        
        <div class="footer">
            &copy; {{ date('Y') }} PASIWARE Technologies. All rights reserved.<br>
            Managed by PASIWARE HRM Super Admin.
        </div>
    </div>
</body>
</html>
