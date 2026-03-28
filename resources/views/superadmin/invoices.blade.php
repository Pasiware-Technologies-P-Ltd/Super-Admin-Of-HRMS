<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Invoices | PASIWARE HRM</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.311.0/umd/lucide.min.js"></script>
    <style>
        .table-container { 
            border-radius: 0.5rem; 
            border: 1px solid var(--glass-border); 
            overflow-x: auto; 
            background: var(--card-bg);
        }
        table { width: 100%; border-collapse: collapse; min-width: 600px; }
        .invoice-badge { padding: 0.4rem 0.8rem; border-radius: 5px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; }
        .type-sub { background: rgba(99, 102, 241, 0.1); color: #6366f1; }
        .type-up { background: rgba(236, 72, 153, 0.1); color: #ec4899; }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 1rem;
            }
            .header-top {
                width: 100%;
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 0.5rem;
            }
            .mobile-logo {
                display: block !important;
                font-weight: 800;
                color: var(--primary);
            }
            .main-content { padding: 1rem; }
            h1 { font-size: 1.5rem; }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
        <aside class="sidebar">
            <div class="sidebar-logo">PASIWARE HRM</div>
            <ul class="nav-links">
                <li>
                    <a href="{{ route('dashboard') }}" class="nav-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('companies.list') }}" class="nav-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 22V4c0-1.1.9-2 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>
                        Companies
                    </a>
                </li>
                <li>
                    <a href="{{ route('plans.list') }}" class="nav-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                        HRM Plans
                    </a>
                </li>
                <li>
                    <a href="{{ route('subscriptions.list') }}" class="nav-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                        Subscriptions
                    </a>
                </li>
                <li>
                    <a href="{{ route('upgrades.list') }}" class="nav-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14.5 9 10l3 4.5 8-7"/><polyline points="14 7.5 20 7.4 20.1 13.4"/></svg>
                        Plan Upgrades
                    </a>
                </li>
                <li>
                    <a href="{{ route('invoices.list') }}" class="nav-item active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                        Invoices
                    </a>
                </li>
            </ul>

            <div class="user-profile">
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
                <div class="user-info">
                    <h4>{{ auth()->user()->name ?? 'Super Admin' }}</h4>
                    <p>Super Admin</p>
                </div>
                <div class="user-actions">
                    <a href="{{ route('password.change') }}" title="Change Password">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3L15.5 7.5z"/></svg>
                    </a>
                    <a href="#" class="logout" onclick="event.preventDefault(); confirmLogout();" title="Logout">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"/><line x1="12" y1="2" x2="12" y2="12"/></svg>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <div class="header">
                <div class="header-top">
                    <button class="menu-toggle" onclick="toggleSidebar()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                    </button>
                    <div class="mobile-logo">PASIWARE HRM</div>
                </div>
                <div>
                    <h1 style="margin:0;">Billing Invoices</h1>
                    <p style="color: var(--text-muted); margin:0;">Download and manage all subscription & upgrade bills</p>
                </div>
            </div>

            <div class="search-container">
                <div class="search-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </div>
                <input type="text" id="search-input" class="search-input" placeholder="Search Invoice or Company..." oninput="jsTableSearch()">
            </div>

            <div class="content-section" style="padding: 0;">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Inv No</th>
                                <th>Organization</th>
                                <th>Type</th>
                                <th>Total Amount</th>
                                <th>Date</th>
                                <th style="text-align: right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($invoices as $inv)
                                <tr>
                                    <td style="font-weight:700;">{{ $inv->invoice_no }}</td>
                                    <td>
                                        <div style="font-weight:600;">{{ $inv->company->name }}</div>
                                        <div style="font-size:0.75rem; color:var(--text-muted);">{{ $inv->company->company_id }}</div>
                                    </td>
                                    <td>
                                        <span class="invoice-badge {{ $inv->billing_type == 'subscription' ? 'type-sub' : 'type-up' }}">
                                            {{ $inv->billing_type }}
                                        </span>
                                    </td>
                                    <td style="font-weight:700; color:#10b981;">₹{{ number_format($inv->total_amount) }}</td>
                                    <td>{{ $inv->created_at->format('d M, Y') }}</td>
                                    <td style="text-align: right;">
                                        <a href="{{ route('invoice.download', $inv->id) }}" class="btn btn-primary" style="font-size: 0.75rem; padding: 0.4rem 0.8rem; display:inline-flex; align-items: center; gap: 0.4rem;">
                                            <i data-lucide="download" style="width: 14px;"></i> PDF
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" style="text-align:center; padding: 3rem; color: var(--text-muted);">No invoices found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="margin-top: 2rem;">
                {{ $invoices->links() }}
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.sidebar-overlay').classList.toggle('active');
        }
        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                document.getElementById('logout-form').submit();
            }
        }

        function jsTableSearch() {
            const input = document.getElementById('search-input');
            const filter = input.value.toUpperCase();
            const table = document.querySelector('table');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const row = tr[i];
                const text = row.textContent || row.innerText;
                if (text.toUpperCase().indexOf(filter) > -1) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
