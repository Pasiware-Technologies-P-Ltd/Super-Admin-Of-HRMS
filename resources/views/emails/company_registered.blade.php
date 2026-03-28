<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration Successful | PASIWARE HRM</title>
    <style>
        body { font-family: 'Outfit', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; margin: 0; padding: 0; background-color: #f1f5f9; }
        .wrapper { width: 100%; table-layout: fixed; background-color: #f1f5f9; padding-bottom: 40px; }
        .main { background-color: #ffffff; margin: 0 auto; width: 100%; max-width: 600px; border-spacing: 0; color: #1e293b; border-radius: 12px; overflow: hidden; margin-top: 40px; }
        .header { background: #6366f1; background: linear-gradient(135deg, #6366f1 0%, #ec4899 100%); padding: 60px 20px; text-align: center; color: white; }
        .content { padding: 40px 30px; line-height: 1.6; }
        .footer { background: #f8fafc; padding: 30px; text-align: center; font-size: 0.85rem; color: #64748b; }
        .btn { display: inline-block; padding: 12px 30px; background: #6366f1; color: #ffffff !important; text-decoration: none; border-radius: 8px; font-weight: 600; margin-top: 20px; }
        .badge { background: #f1f5f9; padding: 8px 15px; border-radius: 5px; font-family: monospace; font-weight: bold; color: #6366f1; border: 1px solid #e2e8f0; }
        h1 { margin: 0; font-size: 24px; }
        p { margin-bottom: 1.5rem; }
    </style>
</head>
<body>
    <div class="wrapper">
        <table class="main" width="100%">
            <tr>
                <td class="header">
                    <h1>Welcome to PASIWARE HRM</h1>
                    <p style="opacity: 0.9;">Your Premium HRM Solution is ready</p>
                </td>
            </tr>
            <tr>
                <td class="content">
                    <h3>Hello {{ $company->name }},</h3>
                    <p>Congratulations! Your company has been successfully registered on the **PASIWARE HRM** Enterprise platform. You are now part of our premium network of smart organizations.</p>
                    
                    <div style="background: #f8fafc; padding: 25px; border-radius: 10px; margin-bottom: 25px; border: 1px solid #f1f5f9;">
                        <h4 style="margin-top: 0; color: #475569;">Your Organization Details:</h4>
                        <table width="100%">
                            <tr>
                                <td style="color: #64748b; padding-bottom: 5px;">Company Unique ID:</td>
                                <td style="text-align: right; padding-bottom: 5px;"><span class="badge">{{ $company->company_id }}</span></td>
                            </tr>
                            <tr>
                                <td style="color: #64748b; padding-bottom: 5px;">Registration State:</td>
                                <td style="text-align: right; padding-bottom: 5px;">{{ $company->state }}</td>
                            </tr>
                            <tr>
                                <td style="color: #64748b;">Contact Email:</td>
                                <td style="text-align: right;">{{ $company->email }}</td>
                            </tr>
                        </table>
                    </div>

                    <p>Next Step: Please coordinate with our Super Admin to activate your License Plan and start managing your employees efficiently.</p>
                    
                    <center>
                        <a href="{{ config('app.url') }}" class="btn">Explore Dashboard</a>
                    </center>
                </td>
            </tr>
            <tr>
                <td class="footer">
                    &copy; {{ date('Y') }} PASIWARE Technologies. All rights reserved.<br>
                    You are receiving this because your organization was registered on our Super Admin portal.
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
