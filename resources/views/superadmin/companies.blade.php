<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Companies | PASIWARE HRM</title>
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
        
        select.form-control {
            background: rgba(255,255,255,0.05);
            color: white;
            border: 1px solid var(--glass-border);
            width: 100%;
            padding: 0.8rem;
            border-radius: 0.8rem;
            outline: none;
        }
        select.form-control option { background: #1e293b; }
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
                <div>
                    <h1>Company Directory</h1>
                    <p style="color: var(--text-muted)">Manage all registered organizations and subscriptions</p>
                </div>
                <div style="display: flex; gap: 1rem;">
                    <button class="btn btn-primary" onclick="openModal('registerModal')"><i data-lucide="plus"></i> Register Company</button>
                </div>
            </div>

            <div class="search-container">
                <div class="search-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </div>
                <input type="text" id="search-input" class="search-input" placeholder="Search Companies..." oninput="jsTableSearch()">
            </div>

            @if(session('success'))
                <div style="background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem; color: #10b981;">{{ session('success') }}</div>
            @endif

            <div class="content-section" style="padding:0;">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Organization</th>
                                <th>Contact Details</th>
                                <th>Status</th>
                                <th>Active Subscription</th>
                                <th>Location & Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($companies as $company)
                                <tr>
                                    <td><code style="color: var(--primary); font-weight:700; font-size: 0.9rem;">{{ $company->company_id }}</code></td>
                                    <td>
                                        <div style="font-weight:600; font-size: 1rem;">{{ $company->name }}</div>
                                        <div style="font-size: 0.8rem; color: var(--text-muted); font-style: italic;">{{ $company->company_type }}</div>
                                    </td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.4rem; font-size: 0.9rem;">
                                            <i data-lucide="mail" style="width:14px; color: var(--primary);"></i> {{ $company->email }}
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 0.4rem; font-size: 0.85rem; color: var(--text-muted); margin-top: 0.2rem;">
                                            <i data-lucide="phone" style="width:14px;"></i> {{ $company->mobile }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge {{ $company->status == 'active' ? 'status-active' : 'status-inactive' }}">
                                            {{ $company->status }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($company->subscription)
                                            <div style="font-weight:700; color: #60a5fa; font-size: 0.95rem;">{{ $company->subscription->plan->plan_name }}</div>
                                            <div style="font-size:0.75rem; color: var(--text-muted); margin-top: 0.1rem;">Quota: {{ $company->subscription->employee_capacity }} Users</div>
                                        @else
                                            <button class="btn btn-primary" style="padding: 0.3rem 0.7rem; font-size: 0.8rem; background: var(--secondary); border: none;" onclick="openSubscribeModal('{{ $company->company_id }}')">
                                                <i data-lucide="zap" style="width:14px;"></i> Subscribe Now
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="font-weight: 500;">{{ $company->state }}, {{ $company->country }}</div>
                                        <div style="font-size:0.75rem; color: var(--text-muted); max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $company->address }}">
                                            {{ $company->address ?: 'No address specified' }}
                                        </div>
                                    </td>
                                    <td style="padding: 1rem 0.5rem;">
                                        <div style="display:flex; gap:0.5rem; align-items:center;">
                                            <!-- View Button -->
                                            <button class="btn" style="padding:0.4rem; background:rgba(99, 102, 241, 0.15); border: 1px solid rgba(99, 102, 241, 0.3); color: #818cf8; min-width: 36px;" title="View Full Details" onclick="openViewModal({{ json_encode($company) }}, {{ json_encode($company->subscription) }}, {{ json_encode($company->subscription ? $company->subscription->plan : null) }}, {{ $company->subscription ? $company->subscription->getTotalEmployees() : 0 }}, {{ $company->subscription ? $company->subscription->getActiveEmployees() : 0 }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                            </button>
                                            <!-- Edit Button -->
                                            <button class="btn" style="padding:0.4rem; background:rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); color: #34d399; min-width: 36px;" title="Edit Company" onclick="openEditCompanyModal({{ json_encode($company) }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align:center; padding: 4rem; color: var(--text-muted);">No companies found matching your search.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modals -->
    <div id="registerModal" class="modal">
        <div class="modal-content" style="max-width: 700px;">
            <h2>Register New Company</h2>
            <form action="{{ route('company.register') }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group"><label>Company Name</label><input type="text" name="name" required placeholder="Acme Solution"></div>
                    <div class="form-group"><label>Corporate Email</label><input type="email" name="email" required placeholder="admin@acme.com"></div>
                    <div class="form-group"><label>Mobile Number</label><input type="text" name="mobile" placeholder="+91 ..."></div>
                    <div class="form-group"><label>Company Type</label><input type="text" name="company_type" required placeholder="Private Limited / Startup etc."></div>
                    <div class="form-group"><label>State</label><input type="text" name="state" required placeholder="Maharashtra"></div>
                    <div class="form-group"><label>Country</label><input type="text" name="country" required value="India"></div>
                    <div class="form-group"><label>GST No</label><input type="text" name="gst_no" placeholder="27XXXXX..."></div>
                </div>
                <div class="form-group"><label>Office Address</label><textarea name="address" rows="2"></textarea></div>
                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="button" class="btn" style="background: #334155;" onclick="closeModal('registerModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Organization</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editCompanyModal" class="modal">
        <div class="modal-content" style="max-width: 700px;">
            <h2>Edit Company Details</h2>
            <form id="editCompanyForm" action="" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group"><label>Company Name</label><input type="text" name="name" id="edit_comp_name" required></div>
                    <div class="form-group"><label>Corporate Email</label><input type="email" name="email" id="edit_comp_email" required></div>
                    <div class="form-group"><label>Mobile Number</label><input type="text" name="mobile" id="edit_comp_mobile"></div>
                    <div class="form-group"><label>Company Type</label><input type="text" name="company_type" id="edit_comp_type" required></div>
                    <div class="form-group"><label>State</label><input type="text" name="state" id="edit_comp_state" required></div>
                    <div class="form-group"><label>Country</label><input type="text" name="country" id="edit_comp_country" required></div>
                    <div class="form-group"><label>GST No</label><input type="text" name="gst_no" id="edit_comp_gst"></div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="edit_comp_status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="form-group"><label>Office Address</label><textarea name="address" id="edit_comp_address" rows="2"></textarea></div>
                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="button" class="btn" style="background: #334155;" onclick="closeModal('editCompanyModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="background: var(--blue);">Update Details</button>
                </div>
            </form>
        </div>
    </div>

    <div id="subscribeModal" class="modal">
        <div class="modal-content">
            <h2>Activate Subscription</h2>
            <form action="{{ route('plan.subscribe') }}" method="POST">
                @csrf
                <input type="hidden" name="company_id" id="modal_company_id">
                <div class="form-group">
                    <label>Company ID</label>
                    <input type="text" id="display_company_id" disabled style="background: rgba(0,0,0,0.2);">
                </div>
                <div class="form-group">
                    <label>Choose Plan</label>
                    <select name="plan_id" required onchange="calculateSubFee(this)">
                        <option value="" disabled selected>-- Select a Plan --</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}" data-price="{{ $plan->price }}">{{ $plan->plan_name }} - ₹{{ number_format($plan->price) }} ({{ $plan->employee_capacity }} Users)</option>
                        @endforeach
                    </select>
                </div>

                <div id="sub_fee_display" style="display:none; background:rgba(99, 102, 241, 0.05); border: 1px dashed rgba(99, 102, 241, 0.3); padding:1rem; border-radius:1rem; margin-top:1.5rem;">
                    <div style="display:flex; justify-content:space-between; margin-bottom:0.5rem; font-size:0.9rem;">
                        <span style="color:var(--text-muted);">One-time Setup Fee:</span>
                        <span style="color:white; font-weight:600;" id="sub_subtotal">₹0</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-bottom:0.8rem; font-size:0.9rem;">
                        <span style="color:var(--text-muted);">GST (18%):</span>
                        <span style="color:#fbbf24; font-weight:600;" id="sub_gst">₹0</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; padding-top:0.8rem; border-top:1px solid rgba(255,255,255,0.1);">
                        <span style="color:white; font-weight:700;">Grand Total:</span>
                        <span style="color:#10b981; font-weight:800; font-size:1.25rem;" id="sub_total">₹0</span>
                    </div>
                </div>
                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="button" class="btn" style="background: #334155;" onclick="closeModal('subscribeModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="background: var(--secondary);">Confirm Subscription</button>
                </div>
            </form>
        </div>
    </div>

    <!-- View Company Modal -->
    <div id="viewCompanyModal" class="modal">
        <div class="modal-content" style="max-width: 850px; background: #0f172a; border: 1px solid rgba(99, 102, 241, 0.3); border-radius: 1.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 2rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1rem;">
                <div>
                    <h2 id="view_comp_name" style="margin:0; font-size: 1.5rem; color: #f8fafc;">Company Name</h2>
                    <code id="view_comp_id" style="color: var(--primary); font-size: 0.9rem;">ID: PVWCMP000</code>
                </div>
                <button onclick="closeModal('viewCompanyModal')" style="background: rgba(255,255,255,0.05); border: none; color: var(--text-muted); cursor: pointer; padding: 0.5rem; border-radius: 50%; display: flex;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2.5rem;">
                <!-- Left Column: Basic Info -->
                <div>
                    <h3 style="font-size: 0.85rem; text-transform: uppercase; color: var(--text-muted); margin-bottom: 1.5rem; border-left: 3px solid var(--primary); padding-left: 0.5rem; letter-spacing: 1px;">Company Profile</h3>
                    <div style="display: flex; flex-direction: column; gap: 1.2rem; background: rgba(255,255,255,0.02); padding: 1.2rem; border-radius: 1rem;">
                        <div>
                            <label style="display: block; font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase;">Email Address</label>
                            <span id="view_comp_email" style="font-weight: 500; color: #e2e8f0;">-</span>
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase;">Mobile Number</label>
                            <span id="view_comp_mobile" style="font-weight: 500; color: #e2e8f0;">-</span>
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase;">Entity Type</label>
                            <span id="view_comp_type" style="font-weight: 500; color: #e2e8f0;">-</span>
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase;">Tax/GST Number</label>
                            <span id="view_comp_gst" style="font-weight: 500; color: #e2e8f0;">-</span>
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase;">Full Address</label>
                            <p id="view_comp_address" style="font-size: 0.85rem; line-height: 1.5; color: #cbd5e1; margin: 0.2rem 0 0 0;">-</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Subscription & Usage -->
                <div>
                    <h3 style="font-size: 0.85rem; text-transform: uppercase; color: var(--text-muted); margin-bottom: 1.5rem; border-left: 3px solid #10b981; padding-left: 0.5rem; letter-spacing: 1px;">Subscription & Usage</h3>
                    <div style="display: flex; flex-direction: column; gap: 1.2rem; background: rgba(255,255,255,0.02); padding: 1.2rem; border-radius: 1rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <label style="display: block; font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase;">Active Plan</label>
                                <div id="view_comp_plan" style="font-weight: 700; color: #60a5fa; font-size: 1.1rem;">No Active Plan</div>
                            </div>
                            <span id="view_comp_status" class="status-badge" style="font-size: 0.65rem;">-</span>
                        </div>
                        
                        <!-- Billing Component -->
                        <div id="view_comp_billing_row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; padding: 1rem; background: rgba(0,0,0,0.2); border-radius: 0.75rem;">
                            <div>
                                <label style="display: block; font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase;">Setup Fee</label>
                                <span id="view_comp_setup" style="font-weight: 600; color: #10b981;">₹0</span>
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase;">Monthly Per Emp</label>
                                <span id="view_comp_monthly" style="font-weight: 600; color: #60a5fa;">₹0</span>
                            </div>
                        </div>

                        <!-- Usage Component -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div style="padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 0.75rem; border: 1px solid rgba(255,255,255,0.05);">
                                <label style="display: block; font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase;">Total Employees</label>
                                <span id="view_comp_total_emp" style="font-weight: 700; font-size: 1.25rem;">0</span>
                            </div>
                            <div style="padding: 1rem; background: rgba(16, 185, 129, 0.05); border-radius: 0.75rem; border: 1px solid rgba(16, 185, 129, 0.1);">
                                <label style="display: block; font-size: 0.65rem; color: #10b981; text-transform: uppercase;">Active Now</label>
                                <span id="view_comp_active_emp" style="font-weight: 700; font-size: 1.25rem; color: #10b981;">0</span>
                            </div>
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase;">Region</label>
                            <span id="view_comp_location" style="font-weight: 500; color: #e2e8f0;">-</span>
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-top: 2.5rem; display: flex; justify-content: flex-end; gap: 1rem; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1.5rem;">
                <button class="btn" style="background: #334155; padding: 0.6rem 1.5rem;" onclick="closeModal('viewCompanyModal')">Close Details</button>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
        function openModal(id) { document.getElementById(id).style.display = 'block'; }
        function closeModal(id) { document.getElementById(id).style.display = 'none'; }
        
        function openViewModal(company, subscription, plan, totalEmp, activeEmp) {
            document.getElementById('view_comp_name').innerText = company.name;
            document.getElementById('view_comp_id').innerText = "ID: " + company.company_id;
            document.getElementById('view_comp_email').innerText = company.email;
            document.getElementById('view_comp_mobile').innerText = company.mobile || 'N/A';
            document.getElementById('view_comp_type').innerText = company.company_type || 'N/A';
            document.getElementById('view_comp_gst').innerText = company.gst_no || 'N/A';
            document.getElementById('view_comp_location').innerText = company.state + ", " + company.country;
            document.getElementById('view_comp_address').innerText = company.address || 'Address not registered.';
            
            // Usage
            document.getElementById('view_comp_total_emp').innerText = totalEmp;
            document.getElementById('view_comp_active_emp').innerText = activeEmp;

            const statusEl = document.getElementById('view_comp_status');
            statusEl.innerText = company.status.toUpperCase();
            statusEl.className = 'status-badge ' + (company.status === 'active' ? 'status-active' : 'status-inactive');

            const planEl = document.getElementById('view_comp_plan');
            const billingRow = document.getElementById('view_comp_billing_row');
            
            if(subscription && plan) {
                planEl.innerText = plan.plan_name + " (" + subscription.employee_capacity + " Users)";
                planEl.style.color = "#60a5fa";
                billingRow.style.display = 'grid';
                document.getElementById('view_comp_setup').innerText = "₹" + Number(subscription.paid_amount).toLocaleString();
                document.getElementById('view_comp_monthly').innerText = "₹" + Number(subscription.employee_per_price).toLocaleString();
            } else {
                planEl.innerText = "No Active Subscription";
                planEl.style.color = "#ef4444";
                billingRow.style.display = 'none';
            }

            openModal('viewCompanyModal');
        }

        function openEditCompanyModal(company) {
            document.getElementById('editCompanyForm').action = "/company/update/" + company.company_id;
            document.getElementById('edit_comp_name').value = company.name;
            document.getElementById('edit_comp_email').value = company.email;
            document.getElementById('edit_comp_mobile').value = company.mobile || '';
            document.getElementById('edit_comp_type').value = company.company_type || '';
            document.getElementById('edit_comp_state').value = company.state || '';
            document.getElementById('edit_comp_country').value = company.country || 'India';
            document.getElementById('edit_comp_gst').value = company.gst_no || '';
            document.getElementById('edit_comp_address').value = company.address || '';
            document.getElementById('edit_comp_status').value = company.status;
            openModal('editCompanyModal');
        }

        function openSubscribeModal(compId) {
            document.getElementById('modal_company_id').value = compId;
            document.getElementById('display_company_id').value = compId;
            document.getElementById('sub_fee_display').style.display = 'none';
            document.getElementById('subscribeModal').style.display = 'block';
        }

        function calculateSubFee(select) {
            const selectedOpt = select.options[select.selectedIndex];
            if(!selectedOpt || selectedOpt.value === "") return;

            const basePrice = parseFloat(selectedOpt.getAttribute('data-price'));
            const gst = basePrice * 0.18;
            const total = basePrice + gst;

            document.getElementById('sub_subtotal').innerText = "₹" + basePrice.toLocaleString();
            document.getElementById('sub_gst').innerText = "₹" + gst.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
            document.getElementById('sub_total').innerText = "₹" + Math.round(total).toLocaleString();
            document.getElementById('sub_fee_display').style.display = 'block';
        }

        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.sidebar-overlay').classList.toggle('active');
        }
        function confirmLogout() { if(confirm('Are you sure you want to logout?')) document.getElementById('logout-form').submit(); }

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
