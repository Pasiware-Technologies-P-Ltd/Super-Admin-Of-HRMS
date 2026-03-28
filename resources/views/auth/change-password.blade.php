<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password | Pasiware HRM</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.311.0/umd/lucide.min.js"></script>
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">PASIWARE HRM</div>
            <ul class="nav-links">
                <li><a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"><i data-lucide="layout-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ route('companies.list') }}" class="nav-item {{ request()->routeIs('companies.list') ? 'active' : '' }}"><i data-lucide="building"></i> Companies</a></li>
                <li><a href="{{ route('plans.list') }}" class="nav-item {{ request()->routeIs('plans.list') ? 'active' : '' }}"><i data-lucide="briefcase"></i> HRM Plans</a></li>
                <li><a href="{{ route('subscriptions.list') }}" class="nav-item {{ request()->routeIs('subscriptions.list') ? 'active' : '' }}"><i data-lucide="shield-check"></i> Subscriptions</a></li>
                <li><a href="{{ route('upgrades.list') }}" class="nav-item {{ request()->routeIs('upgrades.list') ? 'active' : '' }}"><i data-lucide="trending-up"></i> Plan Upgrades</a></li>
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
                    <h1 class="desktop-title" style="margin-bottom: 0;">Security Settings</h1>
                    <p style="color: var(--text-muted); margin-top: 0.2rem;">Update your superadmin password</p>
                </div>

                <div style="display: flex; gap: 1rem; align-items: center; justify-content: flex-end;">
                    <a href="{{ route('dashboard') }}" class="btn" style="background: rgba(255, 255, 255, 0.05); color: var(--text-muted); text-decoration: none;">
                        <i data-lucide="arrow-left"></i> Back
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div style="background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem; color: #10b981;">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div style="background: rgba(239, 68, 68, 0.2); border: 1px solid #ef4444; padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem; color: #ef4444;">
                    <ul style="margin-left: 1.5rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="content-section" style="max-width: 600px; margin: 0 auto;">
                <h2 style="margin-bottom: 1.5rem;">Change Password</h2>
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" name="current_password" required placeholder="Enter current password" style="background: var(--bg-dark);">
                    </div>
                    
                    <div class="form-group">
                        <label>New Password <span style="font-size: 0.8rem; color: var(--text-muted);">(min 8 characters)</span></label>
                        <input type="password" name="new_password" required placeholder="Enter new password" style="background: var(--bg-dark);">
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 2rem;">
                        <label>Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" required placeholder="Confirm new password" style="background: var(--bg-dark);">
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; font-size: 1rem;">
                        <i data-lucide="shield-check"></i> Update Password
                    </button>
                </form>
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
            if(confirm('Are you sure you want to securely log out of PASIWARE HRM?')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
</body>
</html>
