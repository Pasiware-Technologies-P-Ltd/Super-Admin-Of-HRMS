<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasiware Super Admin | Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.311.0/umd/lucide.min.js"></script>
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
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
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'Admin', 0, 1)) }}
                </div>
                <div class="user-info">
                    <h4>{{ auth()->user()->name ?? 'Super Admin' }}</h4>
                    <p>{{ auth()->user()->name ?? 'Super Admin' }}</p>
                </div>
                <div class="user-actions">
                    <a href="{{ route('password.change') }}" title="Change Password">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3L15.5 7.5z"/></svg>
                    </a>
                    <a href="#" class="logout" onclick="event.preventDefault(); confirmLogout();" title="Logout">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"/><line x1="12" y1="2" x2="12" y2="12"/></svg>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <div class="header-top">
                    <button class="menu-toggle" onclick="toggleSidebar()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                    </button>
                    <div class="mobile-logo">PASIWARE HRM</div>
                </div>
                
                <div class="hide-on-mobile" style="flex: 1;">
                    <h1 class="desktop-title" style="margin-bottom: 0;">Super Admin Dashboard</h1>
                    <!-- <p style="color: var(--text-muted); margin-top: 0.2rem;">Laravel Enterprise Edition</p> -->
                </div>

                <div style="display: flex; gap: 1rem; align-items: center; justify-content: flex-end; flex-wrap: wrap;">
                    <button class="btn btn-primary" onclick="openModal('registerModal')"><i data-lucide="plus-circle"></i> Register Company</button>
                    <button class="btn btn-primary" style="background: var(--secondary);" onclick="openModal('subscribeModal')"><i data-lucide="credit-card"></i> Subscribe Plan</button>
                </div>
            </div>

            @if(session('success'))
                <div style="background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem; color: #10b981;">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div style="background: rgba(239, 68, 68, 0.2); border: 1px solid #ef4444; padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem; color: #ef4444;">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Premium Stats Grid -->
            <div class="stats-grid">
                <!-- Total Revenue -->
                <div class="stat-card revenue">
                    <i data-lucide="indian-rupee" class="stat-icon"></i>
                    <div class="stat-label">Total Revenue</div>
                    <div class="stat-value">₹{{ number_format($stats['total_revenue']) }}</div>
                    <div class="stat-trend trend-up">
                        <i data-lucide="trending-up" style="width:14px;"></i>
                        <span>₹{{ number_format($stats['monthly_revenue']) }} target this month</span>
                    </div>
                </div>

                <!-- Active Companies -->
                <div class="stat-card">
                    <i data-lucide="building-2" class="stat-icon"></i>
                    <div class="stat-label">Active Companies</div>
                    <div class="stat-value">{{ $stats['active_companies'] }}/{{ $stats['total_companies'] }}</div>
                    <div class="stat-trend">
                        <span>Across all territories</span>
                    </div>
                </div>

                <!-- Subscriptions -->
                <div class="stat-card plans">
                    <i data-lucide="credit-card" class="stat-icon"></i>
                    <div class="stat-label">Active Subscriptions</div>
                    <div class="stat-value">{{ $stats['active_subscriptions'] }}</div>
                    <div class="stat-trend trend-up">
                        <i data-lucide="activity" style="width:14px;"></i>
                        <span>Live Licenses</span>
                    </div>
                </div>

                <!-- Employees -->
                <div class="stat-card employees">
                    <i data-lucide="users" class="stat-icon"></i>
                    <div class="stat-label">Employees Managed</div>
                    <div class="stat-value">{{ number_format($stats['total_employees']) }}</div>
                    <div class="stat-trend">
                        <i data-lucide="check-circle" style="width:14px; color: #10b981;"></i>
                        <span>Verified Accounts</span>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Double Row -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; align-items: start;">
                <!-- Recent Subscriptions Section -->
                <div class="content-section" style="margin-bottom: 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                        <h2 style="margin:0; font-size:1.25rem;">Recent Active Subscriptions</h2>
                        <a href="{{ route('subscriptions.list') }}" class="btn" style="background: rgba(255,255,255,0.05); color: var(--text-muted); text-decoration:none; font-size: 0.75rem; padding: 0.4rem 0.8rem;">View All</a>
                    </div>
                    
                    <div style="overflow-x: auto;">
                        <table style="font-size: 0.85rem;">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Plan</th>
                                    <th>Billing</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentSubscriptions as $sub)
                                    <tr>
                                        <td>
                                            <div style="font-weight:600;">{{ $sub->company->name ?? 'N/A' }}</div>
                                            <code style="color: var(--primary); font-size: 0.7rem;">{{ $sub->company_id }}</code>
                                        </td>
                                        <td style="color: #60a5fa; font-weight:600;">{{ $sub->plan->plan_name ?? 'N/A' }}</td>
                                        <td>
                                            <div style="font-weight:600;">₹{{ number_format($sub->paid_amount) }}</div>
                                            <div style="font-size:0.7rem; color: #10b981;">₹{{ $sub->employee_per_price }}/Emp</div>
                                        </td>
                                        <td>{{ $sub->created_at->format('d M y') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" style="text-align:center; padding: 2rem;">No subscriptions.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Upgrades Section -->
                <div class="content-section" style="margin-bottom: 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                        <h2 style="margin:0; font-size:1.25rem;">Recent Plan Upgrades</h2>
                        <a href="{{ route('upgrades.list') }}" class="btn" style="background: rgba(255,255,255,0.05); color: var(--text-muted); text-decoration:none; font-size: 0.75rem; padding: 0.4rem 0.8rem;">View All</a>
                    </div>
                    
                    <div style="overflow-x: auto;">
                        <table style="font-size: 0.85rem;">
                            <thead>
                                <tr>
                                    <th>Org Name</th>
                                    <th>New Plan</th>
                                    <th>Fee</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentUpgrades as $upg)
                                    <tr>
                                        <td>
                                            <div style="font-weight:600;">{{ $upg->company->name ?? 'N/A' }}</div>
                                        </td>
                                        <td style="color:#34d399; font-weight:600;">{{ $upg->newPlan->plan_name }}</td>
                                        <td style="font-weight:700; color:#10b981;">₹{{ number_format($upg->new_setup_fee) }}</td>
                                        <td>{{ $upg->created_at->format('d M y') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" style="text-align:center; padding: 2rem;">No upgrades.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Registration Modal -->
    <div id="registerModal" class="modal">
        <div class="modal-content" style="max-width: 700px;">
            <h2>Register New Company</h2>
            <form action="{{ route('company.register') }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" name="name" required placeholder="Acme Solution">
                    </div>
                    <div class="form-group">
                        <label>Corporate Email</label>
                        <input type="email" name="email" required placeholder="admin@acme.com">
                    </div>
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile" placeholder="+91 ...">
                    </div>
                    <div class="form-group">
                        <label>Company Type</label>
                        <input type="text" name="company_type" required placeholder="Private Limited / Startup etc.">
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <input type="text" name="state" required placeholder="e.g. Maharashtra">
                    </div>
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" name="country" required value="India">
                    </div>
                    <div class="form-group">
                        <label>GST No</label>
                        <input type="text" name="gst_no" placeholder="27XXXXX...">
                    </div>
                </div>
                <div class="form-group">
                    <label>Office Address</label>
                    <textarea name="address" rows="2"></textarea>
                </div>
                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="button" class="btn" style="background: #334155;" onclick="closeModal('registerModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Organization</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Subscribe Modal -->
    <div id="subscribeModal" class="modal">
        <div class="modal-content">
            <h2 style="margin-bottom:0.5rem; color: #6366f1;">Subscribe HRM Plan</h2>
            <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 2rem;">Setup license and employee capacity for the organization</p>
            
            <form action="{{ route('plan.subscribe') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Select Company</label>
                    <select name="company_id" required style="background: rgba(0,0,0,0.3); border-color: rgba(255,255,255,0.1); color: white;">
                        <option value="">-- Choose Company --</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->company_id }}">{{ $company->name }} ({{ $company->company_id }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Select HRM Plan</label>
                    <select name="plan_id" id="dash_plan_id" required onchange="calculateDashTotal()" style="background: rgba(0,0,0,0.3); border-color: rgba(255,255,255,0.1); color: white;">
                        <option value="" data-price="0">-- Choose Plan --</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}" data-price="{{ $plan->price }}">{{ $plan->plan_name }} - ₹{{ number_format($plan->price) }} ({{ $plan->employee_capacity }} Users)</option>
                        @endforeach
                    </select>
                </div>

                <!-- Live Billing Breakdown -->
                <div id="dash_fee_display" style="display:none; background: rgba(99, 102, 241, 0.05); border: 1px dashed rgba(99, 102, 241, 0.3); border-radius: 0.8rem; padding: 1.25rem; margin: 1.5rem 0;">
                    <div style="display:flex; justify-content:space-between; margin-bottom: 0.5rem; font-size: 0.9rem;">
                        <span style="color: var(--text-muted);">One-time Setup Fee:</span>
                        <span id="dash_subtotal" style="font-weight: 600; color: white;">₹0</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-bottom: 0.8rem; font-size: 0.9rem;">
                        <span style="color: var(--text-muted);">GST (18%):</span>
                        <span id="dash_gst" style="font-weight: 600; color: white;">₹0</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; padding-top: 0.8rem; border-top: 1px solid rgba(255,255,255,0.1); font-size: 1.1rem;">
                        <span style="font-weight: 700; color: #6366f1;">Grand Total:</span>
                        <span id="dash_total" style="font-weight: 800; color: #6366f1;">₹0</span>
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="button" class="btn" style="background: rgba(255,255,255,0.05); flex:1; border:1px solid rgba(255,255,255,0.1);" onclick="closeModal('subscribeModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="flex:1; justify-content:center; background: #6366f1;">Confirm Subscription</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.sidebar-overlay').classList.toggle('active');
        }

        function confirmLogout() {
            if (confirm("Are you sure you want to securely log out of PASIWARE HRM?")) {
                document.getElementById('logout-form').submit();
            }
        }

        function calculateDashTotal() {
            const select = document.getElementById('dash_plan_id');
            const selectedOpt = select.options[select.selectedIndex];
            
            if(!selectedOpt || selectedOpt.value === "") {
                document.getElementById('dash_fee_display').style.display = 'none';
                return;
            }

            const basePrice = parseFloat(selectedOpt.getAttribute('data-price')) || 0;
            const gst = basePrice * 0.18;
            const total = basePrice + gst;

            document.getElementById('dash_subtotal').innerText = "₹" + basePrice.toLocaleString();
            document.getElementById('dash_gst').innerText = "₹" + gst.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
            document.getElementById('dash_total').innerText = "₹" + Math.round(total).toLocaleString();
            document.getElementById('dash_fee_display').style.display = 'block';
        }
    </script>
</body>
</html>
