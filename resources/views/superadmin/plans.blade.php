<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage HRM Plans | PASIWARE HRM</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.311.0/umd/lucide.min.js"></script>
    <style>
        .plan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        .plan-card {
            background: var(--card-bg);
            border: 1px solid var(--glass-border);
            border-radius: 1.5rem;
            padding: 2rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .plan-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
            box-shadow: 0 10px 30px -10px rgba(99, 102, 241, 0.3);
        }
        .plan-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.3rem 0.8rem;
            border-radius: 1rem;
            font-size: 0.8rem;
        }
        .badge-active { background: rgba(16, 185, 129, 0.1); color: #10b981; }
        .badge-inactive { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
        
        .plan-price {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 1.5rem 0;
            color: white;
        }
        .plan-price span {
            font-size: 1rem;
            color: var(--text-muted);
            font-weight: 400;
        }
        select.form-control {
            background: rgba(255,255,255,0.05);
            color: white;
            border: 1px solid var(--glass-border);
            width: 100%;
            padding: 0.8rem;
            border-radius: 0.8rem;
            outline: none;
        }
        select.form-control option {
            background: #1e293b;
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
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'Admin', 0, 1)) }}</div>
                <div class="user-info">
                    <h4>{{ auth()->user()->name ?? 'Super Admin' }}</h4>
                    <p>{{ auth()->user()->name ?? 'Super Admin' }}</p>
                </div>
                <div class="user-actions">
                    <a href="{{ route('password.change') }}" title="Settings"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3L15.5 7.5z"/></svg></a>
                    <a href="#" class="logout" onclick="event.preventDefault(); confirmLogout();" title="Logout"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"/><line x1="12" y1="2" x2="12" y2="12"/></svg></a>
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
                <div style="flex:1;">
                    <h1>HRM Subscription Plans</h1>
                    <p style="color: var(--text-muted)">Create and manage your service offerings</p>
                </div>
                <button class="btn btn-primary" onclick="openModal('addPlanModal')"><i data-lucide="plus"></i> Add New Plan</button>
            </div>

            @if(session('success'))
                <div style="background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem; color: #10b981;">{{ session('success') }}</div>
            @endif

            <div class="plan-grid">
                @foreach($plans as $plan)
                <div class="plan-card">
                    <span class="plan-badge {{ $plan->status == 'active' ? 'badge-active' : 'badge-inactive' }}">
                        {{ ucfirst($plan->status) }}
                    </span>
                    <h3 style="color: var(--primary); font-size: 1.5rem;">{{ $plan->plan_name }}</h3>
                    <div class="plan-price" style="margin-bottom: 0.5rem;">₹{{ number_format($plan->price) }} <span>(One-time Setup)</span></div>
                    <div style="font-weight:700; color: #10b981; font-size: 1.1rem; margin-bottom: 1.5rem;">
                        ₹{{ number_format($plan->employee_per_price ?: 0) }} <span style="font-size: 0.8rem; font-weight: 400; color: var(--text-muted);">/ employee per month</span>
                    </div>
                    
                    <ul style="list-style: none; padding: 0; margin: 1.5rem 0; display: flex; flex-direction: column; gap: 0.8rem;">
                        <li style="display: flex; align-items: center; gap: 0.8rem; color: var(--text-muted);">
                            <i data-lucide="users" style="width:18px; color: #10b981;"></i> Base Capacity: {{ $plan->employee_capacity }} Employees
                        </li>
                        <li style="display: flex; align-items: center; gap: 0.8rem; color: var(--text-muted);">
                            <i data-lucide="calendar" style="width:18px; color: #6366f1;"></i> Monthly Billing Cycle
                        </li>
                        <li style="display: flex; align-items: center; gap: 0.8rem; color: var(--text-muted);">
                            <i data-lucide="check-circle" style="width:18px; color: #10b981;"></i> {{ $plan->description ?: 'Premium HRM Access' }}
                        </li>
                    </ul>

                    <div style="display: flex; gap: 1rem; border-top: 1px solid var(--glass-border); pt: 1.5rem; margin-top: 1.5rem; padding-top: 1.5rem;">
                        <button class="btn" style="flex: 1; background: rgba(255,255,255,0.05);" onclick="openEditModal({{ json_encode($plan) }})">
                            <i data-lucide="edit-2" style="width:16px;"></i> Edit Structure / Status
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </main>
    </div>

    <!-- Modals -->
    <div id="addPlanModal" class="modal">
        <div class="modal-content">
            <h2>Create New HRM Plan</h2>
            <form action="{{ route('plan.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Plan Name</label>
                    <input type="text" name="plan_name" required placeholder="e.g. Professional Suite">
                </div>
                <div class="form-group">
                    <label>Setup Charge (One-time, non-recurring)</label>
                    <input type="number" name="price" required placeholder="5000">
                </div>
                <div class="form-group">
                    <label>Monthly Charge (Per Employee/Month)</label>
                    <input type="number" name="employee_per_price" required placeholder="100">
                </div>
                <div class="form-group">
                    <label>Included Base Employees</label>
                    <input type="number" name="employee_capacity" required placeholder="50">
                </div>
                <div class="form-group">
                    <label>Plan Description (Features)</label>
                    <textarea name="description" rows="2"></textarea>
                </div>
                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="button" class="btn" style="background: #334155;" onclick="closeModal('addPlanModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Publish Plan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editPlanModal" class="modal">
        <div class="modal-content">
            <h2>Edit HRM Plan Structure</h2>
            <form id="editForm" action="" method="POST">
                @csrf
                <div class="form-group"><label>Plan Name</label><input type="text" name="plan_name" id="edit_name" required></div>
                <div class="form-group"><label>Setup Charge (One-time)</label><input type="number" name="price" id="edit_price" required></div>
                <div class="form-group"><label>Monthly Rate (Per Employee)</label><input type="number" name="employee_per_price" id="edit_per_price" required></div>
                <div class="form-group"><label>Included Capacity</label><input type="number" name="employee_capacity" id="edit_capacity" required></div>
                <div class="form-group"><label>Description</label><textarea name="description" id="edit_description" rows="2"></textarea></div>
                <div class="form-group">
                    <label>Plan Status</label>
                    <select name="status" id="edit_status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="button" class="btn" style="background: #334155;" onclick="closeModal('editPlanModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Plan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();
        function openModal(id) { document.getElementById(id).style.display = 'block'; }
        function closeModal(id) { document.getElementById(id).style.display = 'none'; }
        function toggleSidebar() { document.querySelector('.sidebar').classList.toggle('active'); }
        
        function openEditModal(plan) {
            document.getElementById('editForm').action = "/plans/update/" + plan.id;
            document.getElementById('edit_name').value = plan.plan_name;
            document.getElementById('edit_price').value = plan.price;
            document.getElementById('edit_capacity').value = plan.employee_capacity;
            document.getElementById('edit_per_price').value = plan.employee_per_price;
            document.getElementById('edit_description').value = plan.description;
            document.getElementById('edit_status').value = plan.status;
            openModal('editPlanModal');
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
    </script>
</body>
</html>
