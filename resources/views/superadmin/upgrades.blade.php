<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM Plan Upgrades | PASIWARE HRM</title>
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
        table { width: 100%; border-collapse: collapse; min-width: 900px; }
        .plan-box { padding: 0.5rem; border-radius: 0.5rem; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.05); }
        .fee-diff { color: #10b981; font-weight: 700; }

        @media (max-width: 1024px) {
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
                    <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('companies.list') }}" class="nav-item {{ request()->routeIs('companies.list') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 22V4c0-1.1.9-2 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>
                        Companies
                    </a>
                </li>
                <li>
                    <a href="{{ route('plans.list') }}" class="nav-item {{ request()->routeIs('plans.list') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                        HRM Plans
                    </a>
                </li>
                <li>
                    <a href="{{ route('subscriptions.list') }}" class="nav-item {{ request()->routeIs('subscriptions.list') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                        Subscriptions
                    </a>
                </li>
                <li>
                    <a href="{{ route('upgrades.list') }}" class="nav-item {{ request()->routeIs('upgrades.list') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14.5 9 10l3 4.5 8-7"/><polyline points="14 7.5 20 7.4 20.1 13.4"/></svg>
                        Plan Upgrades
                    </a>
                </li>
                <li>
                    <a href="{{ route('invoices.list') }}" class="nav-item {{ request()->routeIs('invoices.list') ? 'active' : '' }}">
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
                    <h1 style="margin:0;">HRM Plan Upgrades</h1>
                    <p style="color: var(--text-muted); margin:0;">Tracking migration from lower to higher capacity plans</p>
                </div>
            </div>

            <div class="search-container">
                <div class="search-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </div>
                <input type="text" id="search-input" class="search-input" placeholder="Search Company or ID..." oninput="jsTableSearch()">
            </div>

            @if(session('success'))
                <div style="background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem; color: #10b981;">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div style="background: rgba(239, 68, 68, 0.2); border: 1px solid #ef4444; padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem; color: #ef4444;">{{ session('error') }}</div>
            @endif

            <div class="content-section" style="padding:0;">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Org / Company</th>
                                <th>Old Plan</th>
                                <th>New upgraded Plan</th>
                                <th>Setup Fee Paid</th>
                                <th>New Capacity</th>
                                <th>Upgrade Date</th>
                                <th style="text-align:right;">Billing Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($upgrades as $upg)
                                <tr>
                                    <td>
                                        <div style="font-weight:600;">{{ $upg->company->name ?? 'Unknown' }}</div>
                                        <code style="color: var(--primary); font-size:0.75rem;">{{ $upg->company_id }}</code>
                                    </td>
                                    <td>
                                        <div class="plan-box" style="border-color: rgba(239, 68, 68, 0.2);">
                                            <div style="font-size:0.85rem; color:#f87171;">{{ $upg->oldPlan->plan_name }}</div>
                                            <div style="font-size:0.75rem; color:var(--text-muted);">₹{{ number_format($upg->old_setup_fee) }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="plan-box" style="border-color: rgba(16, 185, 129, 0.2);">
                                            <div style="font-size:0.85rem; color:#34d399; font-weight:600;">{{ $upg->newPlan->plan_name }}</div>
                                            <div style="font-size:0.75rem; color:var(--text-muted);">₹{{ number_format($upg->newPlan->price) }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fee-diff">₹{{ number_format($upg->new_setup_fee) }}</div>
                                        <span style="font-size:0.65rem; color: #64748b;">(Differential)</span>
                                    </td>
                                    <td>
                                        <div style="font-weight:600;">{{ $upg->old_capacity ?? 0 }} → {{ $upg->new_capacity }}</div>
                                        <span style="font-size:0.7rem; color:#60a5fa;">+{{ $upg->new_capacity - ($upg->old_capacity ?? 0) }} Users</span>
                                    </td>
                                    <td>{{ $upg->created_at->format('d M Y') }}</td>
                                    <td style="text-align: right;">
                                        @php 
                                            $inv = \App\Models\HrmInvoice::where('billing_type', 'upgrade')->where('billing_id', $upg->id)->first();
                                        @endphp
                                        @if($inv)
                                            <div style="display:flex; flex-direction:column; align-items: flex-end;">
                                                <a href="{{ route('invoice.download', $inv->id) }}" class="btn" style="padding: 0.35rem 0.7rem; font-size: 0.75rem; background: rgba(99, 102, 241, 0.1); border: 1px solid rgba(99, 102, 241, 0.3); color: #818cf8; display:inline-flex; align-items:center; gap: 0.4rem;">
                                                    <i data-lucide="download" style="width: 14px;"></i> Invoice
                                                </a>
                                                <span style="font-size:0.6rem; color: #64748b; margin-top:0.2rem;">{{ $inv->invoice_no }}</span>
                                            </div>
                                        @else
                                            <span style="color:#64748b; font-size: 0.8rem;">N/A</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" style="text-align:center; padding: 4rem;">No upgrade history found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Pagination links removed because controller uses get() -->
        </main>
    </div>

    <!-- Global Upgrade Modal -->
    <div id="globalUpgradeModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); z-index:1100; backdrop-filter:blur(8px);">
        <div class="modal-content" style="max-width: 600px; padding: 2.5rem; border-radius: 1.5rem; border: 1px solid var(--glass-border); background: var(--bg-dark); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
                <h2 style="margin:0;">🚀 Global Plan Upgrade</h2>
                <button onclick="closeModal('globalUpgradeModal')" style="background:none; border:none; color:var(--text-muted); cursor:pointer; font-size:1.5rem;">×</button>
            </div>
            
            <form action="{{ route('plan.upgrade') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Select Company (Existing Clients)</label>
                    <select name="company_id" required style="width:100%; padding:1rem; background:rgba(0,0,0,0.3); border:1px solid var(--glass-border); border-radius:0.75rem; color:white;">
                        <option value="" disabled selected>-- Search & Select Company --</option>
                        @php $subs = \App\Models\HrmSubscription::with('company')->get(); @endphp
                        @foreach($subs as $s)
                            <option value="{{ $s->company_id }}">{{ $s->company->name ?? 'Unknown' }} ({{ $s->company_id }})</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group" style="margin-top:1.5rem;">
                    <label>Select Target Higher Capacity Plan</label>
                    <select name="new_plan_id" required style="width:100%; padding:1rem; background:rgba(0,0,0,0.3); border:1px solid var(--glass-border); border-radius:0.75rem; color:white;">
                        <option value="" disabled selected>-- Select New Plan --</option>
                        @php $allPlans = \App\Models\HrmPlan::where('status', 'active')->orderBy('employee_capacity', 'asc')->get(); @endphp
                        @foreach($allPlans as $p)
                            <option value="{{ $p->id }}">{{ $p->plan_name }} ({{ $p->employee_capacity }} Users) - ₹{{ number_format($p->price) }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="button" class="btn" style="background: rgba(255,255,255,0.05); flex:1;" onclick="closeModal('globalUpgradeModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="background: var(--secondary); flex:1; justify-content:center;">Execute Upgrade</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();
        function openModal(id) { document.getElementById(id).style.display = 'block'; }
        function closeModal(id) { document.getElementById(id).style.display = 'none'; }
        
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
