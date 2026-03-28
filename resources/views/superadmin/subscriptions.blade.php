<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM Subscriptions | PASIWARE HRM</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.311.0/umd/lucide.min.js"></script>
    <style>
        .table-container {
            max-height: 600px;
            overflow-y: auto;
            border-radius: 0.5rem;
            border: 1px solid var(--glass-border);
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        thead th {
            position: sticky;
            top: 0;
            background: #1e293b;
            z-index: 10;
            border-bottom: 2px solid var(--primary);
        }
        .search-container {
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
            background: var(--card-bg);
            padding: 1rem;
            border-radius: 1rem;
            border: 1px solid var(--glass-border);
        }
        .search-input {
            flex: 1;
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--glass-border);
            padding: 0.8rem 1.2rem;
            border-radius: 0.5rem;
            color: white;
            font-size: 1rem;
        }
        .status-badge {
            padding: 0.3rem 0.8rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-active { background: rgba(16, 185, 129, 0.1); color: #10b981; }
        .status-inactive { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
        
        .sub-details {
            font-size: 0.85rem;
        }
        .sub-details span {
            color: var(--text-muted);
            font-size: 0.75rem;
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

        <main class="main-content">
            <div class="header">
                <div class="header-top">
                    <button class="menu-toggle" onclick="toggleSidebar()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                    </button>
                    <div class="mobile-logo">PASIWARE HRM</div>
                </div>
                <div>
                    <h1>HRM Subscriptions</h1>
                    <p style="color: var(--text-muted)">Monitor active licenses and employee counts</p>
                </div>
            </div>

            <div class="search-container">
                <div class="search-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </div>
                <input type="text" id="search-input" class="search-input" placeholder="Search Organization..." oninput="jsTableSearch()">
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
                                <th>Client / Org</th>
                                <th>Plan Details</th>
                                <th>Billing</th>
                                <th>Capacity</th>
                                <th>Employees</th>
                                <th>Status</th>
                                <th>Subscription Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subscriptions as $sub)
                                <tr>
                                    <td>
                                        <div style="font-weight:600;">{{ $sub->company->name ?? 'Unknown Org' }}</div>
                                        <code style="color: var(--primary); font-size: 0.8rem;">{{ $sub->company_id }}</code>
                                    </td>
                                    <td>
                                        <div style="font-weight:600; color: #60a5fa;">{{ $sub->plan->plan_name ?? 'N/A' }}</div>
                                    </td>
                                    <td>
                                        <div class="sub-details" style="font-weight:600; color: #10b981;">₹{{ number_format($sub->paid_amount) }} <span>(One-time Setup)</span></div>
                                        <div class="sub-details" style="color: #60a5fa; margin-top: 0.3rem;">₹{{ number_format($sub->employee_per_price) }}/Emp <span>(Monthly)</span></div>
                                    </td>
                                    <td>
                                        <div style="font-weight:600;">{{ $sub->employee_capacity }} Users</div>
                                    </td>
                                    <td>
                                        <div class="sub-details">Total: {{ $sub->getTotalEmployees() }}</div>
                                        <div class="sub-details"><span>Active: {{ $sub->getActiveEmployees() }}</span></div>
                                    </td>
                                    <td>
                                        <span class="status-badge {{ $sub->status == 'active' ? 'status-active' : 'status-inactive' }}">
                                            {{ $sub->status }}
                                        </span>
                                    </td>
                                    <td>{{ $sub->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div style="display:flex; gap:0.5rem; align-items:center;">
                                            <form action="{{ route('subscription.update-status', $sub->id) }}" method="POST">
                                                @csrf
                                                <select name="status" onchange="this.form.submit()" style="padding: 0.3rem; font-size: 0.8rem; background: rgba(0,0,0,0.3); color: white; border: 1px solid var(--glass-border); border-radius: 4px;">
                                                    <option value="active" {{ $sub->status == 'active' ? 'selected' : '' }}>Active</option>
                                                    <option value="inactive" {{ $sub->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </form>
                                            @php 
                                                $inv = \App\Models\HrmInvoice::where('billing_type', 'subscription')->where('billing_id', $sub->id)->latest()->first();
                                            @endphp
                                            @if($inv)
                                                <a href="{{ route('invoice.download', $inv->id) }}" class="btn" style="padding: 0.35rem 0.6rem; font-size: 0.75rem; background: rgba(255,255,255,0.05); color: #60a5fa; border: 1px solid rgba(96,165,250,0.3); display:flex; align-items:center;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> Bill
                                                </a>
                                            @endif
                                            <button class="btn btn-primary" style="padding: 0.35rem 0.6rem; font-size: 0.75rem; background: var(--secondary); border: none;" 
                                                onclick="openUpgradeModal('{{ $sub->company_id }}', '{{ $sub->plan->plan_name }}', '{{ $sub->employee_capacity }}', '{{ $sub->paid_amount }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m17 11-5-5-5 5"/><path d="m17 18-5-5-5 5"/></svg> Upgrade
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align:center; padding: 4rem; color: var(--text-muted);">No active subscriptions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Upgrade Modal -->
    <div id="upgradeModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); z-index:1100; backdrop-filter:blur(8px);">
        <div class="modal-content" style="max-width: 600px; padding: 2.5rem; border-radius: 1.5rem; border: 1px solid var(--glass-border); background: var(--bg-dark); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
                <h2 style="margin:0; font-size:1.75rem;">🚀 Upgrade License Plan</h2>
                <button onclick="closeUpgradeModal()" style="background:none; border:none; color:var(--text-muted); cursor:pointer; font-size:1.5rem;">×</button>
            </div>
            
            <div style="background:rgba(99, 102, 241, 0.1); padding:1.25rem; border-radius:1rem; margin-bottom:2rem; border: 1px solid rgba(99,102,241,0.2);">
                <div style="font-size:0.8rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:1px; margin-bottom:0.5rem;">Current Active License</div>
                <div style="font-weight:700; color:var(--primary); font-size:1.2rem;" id="current_plan_name">Basic Plan</div>
                <div style="font-size:0.9rem; color:var(--text-muted);" id="current_capacity">50 Max Users</div>
            </div>

            <form action="{{ route('plan.upgrade') }}" method="POST">
                @csrf
                <input type="hidden" name="company_id" id="upgrade_company_id">
                
                <div class="form-group">
                    <label style="color:var(--text-primary); font-weight:600;">Select New Higher Capacity Plan</label>
                    <select name="new_plan_id" required id="upgrade_select" onchange="calculateUpgradeFee(this)" style="width:100%; padding:1rem; background:rgba(0,0,0,0.3); border:1px solid var(--glass-border); border-radius:0.75rem; color:white; font-size:1rem; margin-top:0.5rem;">
                        <option value="" disabled selected>-- Choose Upgrade Path --</option>
                        @php $allPlans = \App\Models\HrmPlan::where('status', 'active')->orderBy('employee_capacity', 'asc')->get(); @endphp
                        @foreach($allPlans as $p)
                            <option value="{{ $p->id }}" data-capacity="{{ $p->employee_capacity }}" data-price="{{ $p->price }}">
                                {{ $p->plan_name }} ({{ $p->employee_capacity }} Users) - ₹{{ number_format($p->price) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div id="upgrade_fee_display" style="display:none; background:rgba(99, 102, 241, 0.05); border: 1px dashed rgba(99, 102, 241, 0.3); padding:1rem; border-radius:1rem; margin-top:1.5rem;">
                    <div style="display:flex; justify-content:space-between; margin-bottom:0.5rem; font-size:0.9rem;">
                        <span style="color:var(--text-muted);">Upgrade Subtotal:</span>
                        <span style="color:white; font-weight:600;" id="upgrade_subtotal">₹0</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-bottom:0.8rem; font-size:0.9rem;">
                        <span style="color:var(--text-muted);">GST (18%):</span>
                        <span style="color:#fbbf24; font-weight:600;" id="upgrade_gst">₹0</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; padding-top:0.8rem; border-top:1px solid rgba(255,255,255,0.1);">
                        <span style="color:white; font-weight:700;">Grand Total:</span>
                        <span style="color:#10b981; font-weight:800; font-size:1.25rem;" id="final_upgrade_amount">₹0</span>
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 2.5rem;">
                    <button type="button" class="btn" style="background: rgba(255,255,255,0.05); flex:1; justify-content:center;" onclick="closeUpgradeModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="background: var(--secondary); flex:1; justify-content:center;">Confirm Upgrade</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.sidebar-overlay').classList.toggle('active');
        }
        function confirmLogout() { if(confirm('Are you sure you want to logout?')) document.getElementById('logout-form').submit(); }

        function openUpgradeModal(compId, planName, capacity, currentPrice) {
            document.getElementById('upgrade_company_id').value = compId;
            document.getElementById('current_plan_name').innerText = planName;
            document.getElementById('current_capacity').innerText = capacity + " Max Users";
            
            window.currentCapacity = parseInt(capacity);
            window.currentPrice = parseFloat(currentPrice);

            document.getElementById('upgrade_fee_display').style.display = 'none';
            
            const select = document.getElementById('upgrade_select');
            select.value = ""; 
            
            Array.from(select.options).forEach(opt => {
                if(opt.value === "") return;
                const optCap = parseInt(opt.getAttribute('data-capacity'));
                const optPrice = parseFloat(opt.getAttribute('data-price'));
                const planNameStr = opt.innerText.split(' - ')[0]; // Extract "Plan Name (Users)"

                if(optCap <= window.currentCapacity) {
                    opt.style.display = 'none';
                    opt.disabled = true;
                } else {
                    opt.style.display = 'block';
                    opt.disabled = false;
                    const diff = Math.max(0, optPrice - window.currentPrice);
                    opt.innerText = `${planNameStr} - Upgrade Fee: ₹${diff.toLocaleString()}`;
                }
            });

            document.getElementById('upgradeModal').style.display = 'block';
        }

        function calculateUpgradeFee(select) {
            const selectedOpt = select.options[select.selectedIndex];
            if(!selectedOpt || selectedOpt.value === "") return;

            const newPrice = parseFloat(selectedOpt.getAttribute('data-price'));
            const subtotal = Math.max(0, newPrice - window.currentPrice);
            const gst = subtotal * 0.18;
            const total = subtotal + gst;

            document.getElementById('upgrade_subtotal').innerText = "₹" + subtotal.toLocaleString();
            document.getElementById('upgrade_gst').innerText = "₹" + gst.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
            document.getElementById('final_upgrade_amount').innerText = "₹" + Math.round(total).toLocaleString();
            document.getElementById('upgrade_fee_display').style.display = 'block';
        }

        function closeUpgradeModal() {
            document.getElementById('upgradeModal').style.display = 'none';
        }

        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.sidebar-overlay').classList.toggle('active');
        }

        function confirmLogout() {
            if (confirm("Are you sure you want to securely log out?")) {
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
    </script>
</body>
</html>
