<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dluwes Hotel Spa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --ink:         #1A1410;
            --ink-mid:     #3D3020;
            --ink-soft:    #7A6A54;
            --parchment:   #F8F4EE;
            --parchment2:  #F0EAE0;
            --line:        #E2D9CE;
            --gold:        #B8912A;
            --gold-dim:    rgba(184,145,42,0.15);
            --gold-glow:   rgba(184,145,42,0.30);
            --sidebar-bg:  #141210;
            --sidebar-w:   260px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Jost', sans-serif;
            background: var(--parchment);
            color: var(--ink);
            display: flex;
            min-height: 100vh;
        }

        /* ════════════════════════════
           SIDEBAR
        ════════════════════════════ */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            padding: 0;
            z-index: 100;
            border-right: 1px solid rgba(184,145,42,0.12);
        }

        /* Brand */
        .sidebar-brand {
            padding: 2rem 1.5rem 1.6rem;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .brand-eyebrow {
            font-size: 0.62rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 0.3rem;
            opacity: 0.85;
        }

        .brand-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.7rem;
            font-weight: 300;
            color: #fff;
            line-height: 1.1;
            letter-spacing: 0.03em;
        }

        .brand-name em {
            font-style: italic;
            color: var(--gold);
        }

        .brand-sub {
            font-size: 0.68rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
            margin-top: 0.35rem;
        }

        /* Nav */
        .sidebar-nav {
            flex: 1;
            padding: 1.2rem 0.85rem;
            overflow-y: auto;
        }

        .nav-section-label {
            font-size: 0.6rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.22);
            padding: 0 0.65rem;
            margin: 0.5rem 0 0.5rem;
        }

        .nav-section-label:first-child { margin-top: 0; }

        .nav-divider {
            height: 1px;
            background: rgba(255,255,255,0.07);
            margin: 0.9rem 0.65rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.62rem 0.75rem;
            border-radius: 8px;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 0.84rem;
            font-weight: 400;
            transition: background 0.18s, color 0.18s;
            margin-bottom: 2px;
            position: relative;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.06);
            color: rgba(255,255,255,0.9);
        }

        .nav-link.active {
            background: var(--gold-dim);
            color: var(--gold);
        }

        .nav-link.active .nav-icon { color: var(--gold); }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0; top: 20%; bottom: 20%;
            width: 3px;
            background: var(--gold);
            border-radius: 0 3px 3px 0;
        }

        .nav-icon {
            width: 30px; height: 30px;
            background: rgba(255,255,255,0.05);
            border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            color: rgba(255,255,255,0.4);
            transition: background 0.18s, color 0.18s;
        }

        .nav-link:hover .nav-icon {
            background: rgba(255,255,255,0.09);
            color: rgba(255,255,255,0.85);
        }

        /* Logout */
        .sidebar-footer {
            padding: 1rem 0.85rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .btn-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            background: transparent;
            border: 1px solid rgba(192,57,43,0.4);
            color: rgba(192,57,43,0.75);
            font-family: 'Jost', sans-serif;
            font-size: 0.8rem;
            font-weight: 500;
            padding: 0.6rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.18s, border-color 0.18s, color 0.18s;
            letter-spacing: 0.04em;
        }

        .btn-logout:hover {
            background: rgba(192,57,43,0.15);
            border-color: rgba(192,57,43,0.7);
            color: #e57373;
        }

        /* ════════════════════════════
           MAIN AREA
        ════════════════════════════ */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Top bar */
        .topbar {
            height: 56px;
            background: #fff;
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-breadcrumb {
            font-size: 0.78rem;
            color: var(--ink-soft);
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .topbar-breadcrumb .sep { opacity: 0.35; }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .topbar-date {
            font-size: 0.75rem;
            color: var(--ink-soft);
            letter-spacing: 0.03em;
        }

        .topbar-avatar {
            width: 30px; height: 30px;
            background: var(--ink-mid);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }

        .topbar-avatar svg { color: rgba(255,255,255,0.7); }

        /* Content */
        .main-content {
            flex: 1;
            padding: 2.5rem 2rem;
        }

        /* Footer */
        .main-footer {
            padding: 1rem 2rem;
            border-top: 1px solid var(--line);
            text-align: center;
            font-size: 0.73rem;
            color: var(--ink-soft);
            letter-spacing: 0.04em;
        }

        .main-footer span { color: var(--gold); }

        /* ════════════════════════════
           RESPONSIVE
        ════════════════════════════ */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.28s ease;
            }
            .sidebar.open { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
            .topbar { padding: 0 1.2rem; }
            .main-content { padding: 1.5rem 1.2rem; }
            .menu-toggle { display: flex !important; }
        }

        .menu-toggle {
            display: none;
            align-items: center;
            justify-content: center;
            background: none;
            border: 1px solid var(--line);
            border-radius: 7px;
            padding: 0.3rem 0.5rem;
            cursor: pointer;
            color: var(--ink-mid);
        }

        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 99;
        }

        .overlay.show { display: block; }
    </style>
</head>
<body>

{{-- ── Overlay (mobile) ── --}}
<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

{{-- ════════════════════════════
     SIDEBAR
════════════════════════════ --}}
<aside class="sidebar" id="sidebar">

    {{-- Brand --}}
    <div class="sidebar-brand">
        <div class="brand-eyebrow">Wellness &amp; Hospitality</div>
        <div class="brand-name">Dluwes <em>Hotel</em></div>
        <div class="brand-sub">Spa Management System</div>
    </div>

    {{-- Navigation --}}
    <nav class="sidebar-nav">

        <div class="nav-section-label">Utama</div>

        <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <rect x="1" y="1" width="5" height="5" rx="1.2" stroke="currentColor" stroke-width="1.3"/>
                    <rect x="8" y="1" width="5" height="5" rx="1.2" stroke="currentColor" stroke-width="1.3"/>
                    <rect x="1" y="8" width="5" height="5" rx="1.2" stroke="currentColor" stroke-width="1.3"/>
                    <rect x="8" y="8" width="5" height="5" rx="1.2" stroke="currentColor" stroke-width="1.3"/>
                </svg>
            </span>
            Dashboard
        </a>

        <div class="nav-divider"></div>
        <div class="nav-section-label">Master Data</div>

        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'manager')

        <a href="/users" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <circle cx="7" cy="4.5" r="2.5" stroke="currentColor" stroke-width="1.3"/>
                    <path d="M1.5 13c0-3.038 2.462-4.5 5.5-4.5s5.5 1.462 5.5 4.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
            </span>
            User
        </a>

        <a href="/hotels" class="nav-link {{ request()->is('hotels*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M2 13V6L7 2l5 4v7" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
                    <rect x="4.5" y="8.5" width="5" height="4.5" rx="0.5" stroke="currentColor" stroke-width="1.2"/>
                </svg>
            </span>
            Hotel
        </a>

        <a href="/data-spas" class="nav-link {{ request()->is('data-spas*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M7 1C4.8 3.2 3 5.2 3 7.5a4 4 0 0 0 8 0C11 5.2 9.2 3.2 7 1Z" stroke="currentColor" stroke-width="1.3"/>
                    <path d="M7 9.5V12" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
            </span>
            Data Spa
        </a>
        @endif

        <a href="/transaksi" class="nav-link {{ request()->is('transaksi*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <rect x="1.5" y="2" width="11" height="10" rx="1.5" stroke="currentColor" stroke-width="1.3"/>
                    <path d="M1.5 5h11" stroke="currentColor" stroke-width="1.3"/>
                    <path d="M5 2V1M9 2V1" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                    <path d="M4 8h6M4 10.5h4" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
                </svg>
            </span>
            Transaksi
        </a>

        <div class="nav-divider"></div>
        <div class="nav-section-label">Analitik</div>

        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'manager')
        <a href="/laporan" class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M1.5 12L4.5 7.5l3 2.5L10 5l2.5 2.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M1.5 2h11" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" opacity=".4"/>
                </svg>
            </span>
            Laporan
        </a>

        <a href="/settings" class="nav-link {{ request()->is('settings*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <circle cx="7" cy="7" r="2" stroke="currentColor" stroke-width="1.3"/>
                    <path d="M7 1v1.5M7 11.5V13M1 7h1.5M11.5 7H13M2.8 2.8l1.1 1.1M10.1 10.1l1.1 1.1M2.8 11.2l1.1-1.1M10.1 3.9l1.1-1.1" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
            </span>
            Pengaturan
        </a>
        @endif

    </nav>

    {{-- Logout --}}
    <div class="sidebar-footer">
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                    <path d="M5 2H2.5A1.5 1.5 0 0 0 1 3.5v6A1.5 1.5 0 0 0 2.5 11H5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                    <path d="M8.5 9.5L12 6.5l-3.5-3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 6.5H5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
                Logout
            </button>
        </form>
    </div>

</aside>

{{-- ════════════════════════════
     MAIN AREA
════════════════════════════ --}}
<div class="main-wrapper">

    {{-- Top bar --}}
    <header class="topbar">
        <div style="display:flex; align-items:center; gap:1rem;">
            <button class="menu-toggle" onclick="toggleSidebar()" aria-label="Toggle menu">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M2 4h12M2 8h12M2 12h12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </button>
            <div class="topbar-breadcrumb">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <rect x="1" y="1" width="4" height="4" rx="0.8" stroke="currentColor" stroke-width="1.2"/>
                    <rect x="7" y="1" width="4" height="4" rx="0.8" stroke="currentColor" stroke-width="1.2"/>
                    <rect x="1" y="7" width="4" height="4" rx="0.8" stroke="currentColor" stroke-width="1.2"/>
                    <rect x="7" y="7" width="4" height="4" rx="0.8" stroke="currentColor" stroke-width="1.2"/>
                </svg>
                <span class="sep">/</span>
                <span>Dluwes Hotel Spa</span>
            </div>
        </div>

        <div class="topbar-right">
            <span class="topbar-date" id="topbar-date"></span>
            <div class="topbar-avatar">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <circle cx="7" cy="4.5" r="2.5" stroke="currentColor" stroke-width="1.3"/>
                    <path d="M1.5 13c0-2.5 2.462-4 5.5-4s5.5 1.5 5.5 4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
    </header>

    {{-- Page content --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="main-footer">
        &copy; {{ date('Y') }} <span>Dluwes Hotel Spa</span> &mdash; All rights reserved.
    </footer>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Live date in topbar
    function updateDate() {
        const el = document.getElementById('topbar-date');
        if (!el) return;
        const now = new Date();
        el.textContent = now.toLocaleDateString('id-ID', {
            weekday: 'short', day: 'numeric', month: 'short', year: 'numeric'
        });
    }
    updateDate();

    // Mobile sidebar
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('overlay').classList.toggle('show');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('overlay').classList.remove('show');
    }
</script>
</body>
</html>
