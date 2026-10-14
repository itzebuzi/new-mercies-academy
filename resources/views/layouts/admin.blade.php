<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title', 'Administration') | New Mercies Academy</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --blue: #123c80;
            --blue-dark: #0b2857;
            --blue-light: #eaf1fc;
            --white: #fff;
            --background: #f5f7fb;
            --ink: #17243a;
            --muted: #718096;
            --line: #e3e9f2;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--background);
            color: var(--ink);
            font-family: 'DM Sans', sans-serif;
        }

        a { color: inherit; text-decoration: none; }
        button, input, select, textarea { font: inherit; }

        .admin-sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 50;
            display: flex;
            flex-direction: column;
            width: 260px;
            padding: 25px 17px 18px;
            overflow-y: auto;
            background: var(--blue-dark);
            color: var(--white);
            transition: transform .25s ease;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px 25px;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }

        .brand-mark {
            display: grid;
            width: 43px;
            height: 43px;
            flex-shrink: 0;
            place-items: center;
            border: 1px solid #c6d8ff;
            color: #c6d8ff;
            font-family: 'Playfair Display', serif;
            font-size: 24px;
        }

        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 19px;
            letter-spacing: 1.5px;
        }

        .brand-subtitle {
            margin-top: 5px;
            color: #cbd8ef;
            font-size: 9px;
            letter-spacing: 1.3px;
            text-transform: uppercase;
        }

        .nav-label {
            margin: 25px 12px 10px;
            color: #a9bddf;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .admin-nav { display: grid; gap: 5px; }

        .admin-nav a {
            display: flex;
            align-items: center;
            gap: 11px;
            min-height: 44px;
            padding: 10px 12px;
            border-radius: 5px;
            color: #e0e9f8;
            font-size: 13px;
        }

        .admin-nav a:hover,
        .admin-nav a.active {
            background: rgba(255,255,255,.12);
            color: #fff;
        }

        .admin-nav a.active {
            box-shadow: inset 3px 0 #9dc0ff;
        }

        .nav-icon {
            display: inline-grid;
            width: 22px;
            place-items: center;
            color: #b8d0ff;
            font-size: 15px;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 24px;
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 16px 8px;
            border-top: 1px solid rgba(255,255,255,.15);
        }

        .user-avatar {
            display: grid;
            flex-shrink: 0;
            width: 37px;
            height: 37px;
            place-items: center;
            border-radius: 50%;
            background: #dce8ff;
            color: var(--blue-dark);
            font-weight: 700;
        }

        .user-name {
            overflow: hidden;
            color: white;
            font-size: 12px;
            font-weight: 600;
            text-overflow: ellipsis;
        }

        .user-role {
            margin-top: 4px;
            color: #cbd8ef;
            font-size: 10px;
        }

        .sidebar-logout {
            width: 100%;
            padding: 11px;
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 4px;
            background: transparent;
            color: white;
            cursor: pointer;
            text-align: left;
        }

        .admin-main { min-height: 100vh; margin-left: 260px; }

        .admin-topbar {
            position: sticky;
            top: 0;
            z-index: 30;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 82px;
            padding: 16px 32px;
            border-bottom: 1px solid var(--line);
            background: rgba(255,255,255,.96);
        }

        .topbar-left { display: flex; align-items: center; gap: 12px; }

        .page-heading {
            margin: 0;
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 600;
        }

        .page-date { margin-top: 5px; color: var(--muted); font-size: 11px; }
        .topbar-right { display: flex; align-items: center; gap: 14px; }
        .topbar-label { color: var(--muted); font-size: 12px; }

        .topbar-logout {
            padding: 10px 14px;
            border: 1px solid var(--line);
            border-radius: 4px;
            background: white;
            color: var(--blue);
            cursor: pointer;
            font-size: 12px;
        }

        .admin-content { padding: 30px 32px 45px; }

        .alert {
            margin-bottom: 20px;
            padding: 14px 16px;
            border: 1px solid;
            border-radius: 6px;
            font-size: 13px;
        }

        .alert-success {
            border-color: #b7e0c7;
            background: #edf9f1;
            color: #17653a;
        }

        .alert-error {
            border-color: #f1c5c5;
            background: #fff1f1;
            color: #9a2424;
        }

        .mobile-menu-button,
        .sidebar-overlay { display: none; }

        @media (max-width: 900px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.open { transform: translateX(0); }
            .admin-main { margin-left: 0; }

            .sidebar-overlay.open {
                position: fixed;
                inset: 0;
                z-index: 40;
                display: block;
                background: rgba(0,0,0,.4);
            }

            .mobile-menu-button {
                display: inline-grid;
                width: 38px;
                height: 38px;
                place-items: center;
                border: 1px solid var(--line);
                border-radius: 4px;
                background: white;
                color: var(--blue);
                cursor: pointer;
            }

            .admin-topbar { padding: 15px 20px; }
            .admin-content { padding: 24px 20px 35px; }
        }

        @media (max-width: 560px) {
            .page-heading { font-size: 20px; }
            .topbar-label { display: none; }
            .admin-topbar { padding: 13px; }
            .admin-content { padding: 18px 13px 28px; }
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <aside class="admin-sidebar" id="adminSidebar">
        <a href="{{ route('admin.dashboard') }}" class="admin-brand">
            <div class="brand-mark">B</div>
            <div>
                <div class="brand-name">New Mercies Academy</div>
                <div class="brand-subtitle">Academy Administration</div>
            </div>
        </a>

        <div class="nav-label">Main menu</div>

        <nav class="admin-nav">
            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon">⌂</span>
                Dashboard
            </a>

            <a href="{{ route('admin.admissions.index') }}"
               class="{{ request()->routeIs('admin.admissions.*') ? 'active' : '' }}">
                <span class="nav-icon">▤</span>
                Admissions
            </a>
        </nav>

        <div class="nav-label">School management</div>

        <nav class="admin-nav">
            <a href="{{ route('admin.students.index') }}"
               class="{{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                <span class="nav-icon">♙</span>
                Students
            </a>

            <a href="{{ url('/admin/teachers') }}"
               class="{{ request()->is('admin/teachers*') ? 'active' : '' }}">
                <span class="nav-icon">♧</span>
                Teachers
            </a>

            <a href="{{ url('/admin/staff') }}"
               class="{{ request()->is('admin/staff*') ? 'active' : '' }}">
                <span class="nav-icon">☷</span>
                Staff
            </a>

            
<a href="{{ route('admin.classes.index') }}"
   class="{{ request()->routeIs('admin.classes.*') ? 'active' : '' }}">
    <span class="nav-icon">▦</span>
    Classes Management
</a>

<a href="{{ route('admin.subjects.index') }}"
   class="{{ request()->routeIs('admin.subjects.*') ? 'active' : '' }}">
    <span class="nav-icon">▤</span>
    Subjects Management
</a>


            <a href="{{ url('/admin/results') }}"
               class="{{ request()->is('admin/results*') ? 'active' : '' }}">
                <span class="nav-icon">▣</span>
                Results
            </a>
        </nav>

        <div class="sidebar-bottom">
            <div class="sidebar-user">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div style="min-width:0">
                    <div class="user-name">{{ auth()->user()->name ?? 'Administrator' }}</div>
                    <div class="user-role">School Administrator</div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-logout">Sign out</button>
            </form>
        </div>
    </aside>

    <main class="admin-main">
        <header class="admin-topbar">
            <div class="topbar-left">
                <button type="button" class="mobile-menu-button"
                        id="mobileMenuButton" aria-label="Open navigation">
                    ☰
                </button>

                <div>
                    <h1 class="page-heading">@yield('page-title', 'Administration')</h1>
                    <div class="page-date">{{ now()->format('l, d F Y') }}</div>
                </div>
            </div>

            <div class="topbar-right">
                <span class="topbar-label">New Mercies Academy</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="topbar-logout">Sign out</button>
                </form>
            </div>
        </header>

        <section class="admin-content">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <strong>Please correct the following:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </section>
    </main>

    <script>
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const menuButton = document.getElementById('mobileMenuButton');

        menuButton?.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        });

        overlay?.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
        });
    </script>

    @stack('scripts')
</body>
</html>
