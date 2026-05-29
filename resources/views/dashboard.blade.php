@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Jost:wght@300;400;500;600&display=swap');

    :root {
        --ink:        #1A1410;
        --ink-mid:    #4A3F35;
        --ink-soft:   #8C7B6E;
        --parchment:  #F8F4EE;
        --parchment2: #F0EAE0;
        --line:       #E2D9CE;
        --gold:       #B8912A;
        --gold-pale:  #F5ECD4;
        --gold-glow:  rgba(184,145,42,0.18);
        --teal:       #2A6B6B;
        --teal-pale:  #D4ECEC;
        --rose:       #A04545;
        --rose-pale:  #F5DEDE;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    .db-wrap {
        font-family: 'Jost', sans-serif;
        background: var(--parchment);
        color: var(--ink);
        min-height: 100vh;
        padding: 2.5rem 2rem 4rem;
        max-width: 1100px;
        margin: 0 auto;
    }

    /* ── Decorative top rule ── */
    .db-rule {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2.5rem;
        opacity: 0;
        animation: fadeUp 0.6s 0.1s ease forwards;
    }
    .db-rule-line { flex: 1; height: 1px; background: linear-gradient(to right, transparent, var(--gold), transparent); }
    .db-rule-diamond {
        width: 8px; height: 8px;
        background: var(--gold);
        transform: rotate(45deg);
        flex-shrink: 0;
    }

    /* ── Hero header ── */
    .db-hero {
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: start;
        gap: 2rem;
        margin-bottom: 3rem;
        opacity: 0;
        animation: fadeUp 0.65s 0.2s ease forwards;
    }

    .db-hotel-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(2.4rem, 5vw, 3.8rem);
        font-weight: 300;
        line-height: 1.1;
        color: var(--ink);
        letter-spacing: 0.02em;
    }

    .db-hotel-name em {
        font-style: italic;
        color: var(--gold);
    }

    .db-subtitle {
        font-size: 0.78rem;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: var(--ink-soft);
        margin-top: 0.5rem;
        font-weight: 400;
    }

    /* ── User card ── */
    .db-user-card {
        background: var(--ink);
        color: var(--parchment);
        border-radius: 14px;
        padding: 1.2rem 1.5rem;
        min-width: 200px;
        position: relative;
        overflow: hidden;
    }

    .db-user-card::before {
        content: '';
        position: absolute;
        top: -30px; right: -30px;
        width: 100px; height: 100px;
        background: var(--gold-glow);
        border-radius: 50%;
        filter: blur(20px);
    }

    .db-user-greeting {
        font-size: 0.7rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--ink-soft);
        margin-bottom: 0.3rem;
    }

    .db-user-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.35rem;
        font-weight: 400;
        color: #fff;
        line-height: 1.2;
    }

    .db-user-meta {
        font-size: 0.72rem;
        color: var(--ink-soft);
        margin-top: 0.6rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .db-user-dot {
        width: 6px; height: 6px;
        background: var(--gold);
        border-radius: 50%;
        flex-shrink: 0;
    }

    /* ── Stat cards ── */
    .db-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 2.5rem;
    }

    @media (max-width: 680px) {
        .db-stats { grid-template-columns: 1fr; }
        .db-hero { grid-template-columns: 1fr; }
        .db-user-card { min-width: unset; }
    }

    .stat-card {
        background: var(--parchment2);
        border: 1px solid var(--line);
        border-radius: 14px;
        padding: 1.4rem 1.5rem;
        position: relative;
        overflow: hidden;
        opacity: 0;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:nth-child(1) { animation: fadeUp 0.6s 0.35s ease forwards; }
    .stat-card:nth-child(2) { animation: fadeUp 0.6s 0.45s ease forwards; }
    .stat-card:nth-child(3) { animation: fadeUp 0.6s 0.55s ease forwards; }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 28px rgba(26,20,16,0.09);
    }

    .stat-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        border-radius: 0 0 14px 14px;
    }

    .stat-card.gold::after  { background: var(--gold); }
    .stat-card.teal::after  { background: var(--teal); }
    .stat-card.rose::after  { background: var(--rose); }

    .stat-icon {
        width: 36px; height: 36px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 0.9rem;
    }

    .stat-card.gold .stat-icon { background: var(--gold-pale); color: var(--gold); }
    .stat-card.teal .stat-icon { background: var(--teal-pale); color: var(--teal); }
    .stat-card.rose .stat-icon { background: var(--rose-pale); color: var(--rose); }

    .stat-label {
        font-size: 0.7rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--ink-soft);
        margin-bottom: 0.25rem;
    }

    .stat-value {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.1rem;
        font-weight: 400;
        line-height: 1;
        color: var(--ink);
    }

    .stat-sub {
        font-size: 0.75rem;
        color: var(--ink-soft);
        margin-top: 0.3rem;
    }

    /* ── Quick nav ── */
    .db-nav-label {
        font-size: 0.7rem;
        letter-spacing: 0.13em;
        text-transform: uppercase;
        color: var(--ink-soft);
        margin-bottom: 0.9rem;
        opacity: 0;
        animation: fadeUp 0.6s 0.6s ease forwards;
    }

    .db-nav {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.75rem;
        margin-bottom: 3rem;
        opacity: 0;
        animation: fadeUp 0.6s 0.7s ease forwards;
    }

    @media (max-width: 680px) { .db-nav { grid-template-columns: repeat(2, 1fr); } }

    .nav-tile {
        background: var(--parchment2);
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 1.1rem 1rem;
        text-decoration: none;
        color: var(--ink);
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        transition: background 0.2s, border-color 0.2s, transform 0.18s;
    }

    .nav-tile:hover {
        background: var(--ink);
        color: var(--parchment);
        border-color: var(--ink);
        transform: translateY(-2px);
    }

    .nav-tile:hover .nav-tile-icon { background: rgba(255,255,255,0.08); color: var(--gold); }

    .nav-tile-icon {
        width: 34px; height: 34px;
        background: var(--parchment);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: var(--ink-mid);
        transition: background 0.2s, color 0.2s;
    }

    .nav-tile-name {
        font-size: 0.82rem;
        font-weight: 500;
    }

    .nav-tile-desc {
        font-size: 0.7rem;
        color: var(--ink-soft);
        line-height: 1.3;
        transition: color 0.2s;
    }

    .nav-tile:hover .nav-tile-desc { color: rgba(240,234,224,0.6); }

    /* ── Bottom bar ── */
    .db-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 2rem;
        border-top: 1px solid var(--line);
        opacity: 0;
        animation: fadeUp 0.6s 0.85s ease forwards;
    }

    .db-brand {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.1rem;
        font-weight: 300;
        color: var(--ink-soft);
        letter-spacing: 0.06em;
    }

    .db-brand span { color: var(--gold); font-style: italic; }

    .btn-logout {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: transparent;
        border: 1.5px solid var(--line);
        color: var(--ink-soft);
        font-family: 'Jost', sans-serif;
        font-size: 0.8rem;
        font-weight: 500;
        letter-spacing: 0.05em;
        padding: 0.55rem 1.1rem;
        border-radius: 50px;
        cursor: pointer;
        transition: border-color 0.2s, color 0.2s, background 0.2s;
    }

    .btn-logout:hover {
        border-color: var(--rose);
        color: var(--rose);
        background: var(--rose-pale);
    }

    /* ── Animations ── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="db-wrap">

    {{-- Decorative rule --}}
    <div class="db-rule">
        <div class="db-rule-line"></div>
        <div class="db-rule-diamond"></div>
        <div class="db-rule-line"></div>
    </div>

    {{-- Hero --}}
    <div class="db-hero">
        <div>
            <h1 class="db-hotel-name">Dluwes <em>Hotel</em><br>Dashboard</h1>
            <p class="db-subtitle">Spa &amp; Wellness Management System</p>
        </div>

        <div class="db-user-card">
            <div class="db-user-greeting">Selamat datang</div>
            <div class="db-user-name">{{ auth()->user()->name }}</div>
            <div class="db-user-meta">
                <span class="db-user-dot"></span>
                <span>{{ ucfirst(auth()->user()->role ?? 'Administrator') }}</span>
            </div>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="db-stats">
        <div class="stat-card gold">
            <div class="stat-icon">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M9 1L11.5 6.5H17L12.5 10L14.5 16L9 12.5L3.5 16L5.5 10L1 6.5H6.5L9 1Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="stat-label">Total Transaksi</div>
            <div class="stat-value">—</div>
            <div class="stat-sub">Bulan ini</div>
        </div>

        <div class="stat-card teal">
            <div class="stat-icon">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <circle cx="9" cy="9" r="7.5" stroke="currentColor" stroke-width="1.4"/>
                    <path d="M9 5v4.5l3 2" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                </svg>
            </div>
            <div class="stat-label">Sesi Hari Ini</div>
            <div class="stat-value">—</div>
            <div class="stat-sub">Terjadwal</div>
        </div>

        <div class="stat-card rose">
            <div class="stat-icon">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M2 13L6.5 8.5L9.5 11.5L13 7L16 9.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 4h14" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" opacity=".35"/>
                    <path d="M2 16h14" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" opacity=".35"/>
                </svg>
            </div>
            <div class="stat-label">Revenue</div>
            <div class="stat-value">—</div>
            <div class="stat-sub">Pendapatan bulan ini</div>
        </div>
    </div>

    {{-- Quick Navigation --}}

    <div class="db-nav-label">Menu Utama</div>
    <div class="db-nav">

        <a href="/transaksi" class="nav-tile">
            <div class="nav-tile-icon">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <rect x="1.5" y="2" width="13" height="12" rx="2" stroke="currentColor" stroke-width="1.3"/>
                    <path d="M5 6h6M5 9h4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
            </div>
            <div class="nav-tile-name">Transaksi</div>
            <div class="nav-tile-desc">Data transaksi spa</div>
        </a>
 @if(auth()->user()->role == 'admin' || auth()->user()->role == 'manager')
        <a href="/pelanggan" class="nav-tile">
            <div class="nav-tile-icon">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <circle cx="8" cy="5.5" r="2.5" stroke="currentColor" stroke-width="1.3"/>
                    <path d="M2.5 14c0-3.038 2.462-5.5 5.5-5.5s5.5 2.462 5.5 5.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
            </div>
            <div class="nav-tile-name">Pelanggan</div>
            <div class="nav-tile-desc">Data tamu &amp; member</div>
        </a>

        <a href="/hotel" class="nav-tile">
            <div class="nav-tile-icon">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M2 14V6.5L8 2l6 4.5V14" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
                    <rect x="5.5" y="9" width="5" height="5" rx="0.5" stroke="currentColor" stroke-width="1.2"/>
                </svg>
            </div>
            <div class="nav-tile-name">Hotel</div>
            <div class="nav-tile-desc">Manajemen properti</div>
        </a>

        <a href="/spa" class="nav-tile">
            <div class="nav-tile-icon">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8 2C5.8 4.2 4 6.2 4 8.5a4 4 0 0 0 8 0C12 6.2 10.2 4.2 8 2Z" stroke="currentColor" stroke-width="1.3"/>
                    <path d="M8 10.5V13" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
            </div>
            <div class="nav-tile-name">Layanan Spa</div>
            <div class="nav-tile-desc">Paket &amp; treatment</div>
        </a>
@endif
    </div>

    {{-- Bottom bar --}}
    <div class="db-bottom">
        <div class="db-brand">Dluwes <span>Hotel</span></div>

        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M5 2H2.5A1.5 1.5 0 0 0 1 3.5v7A1.5 1.5 0 0 0 2.5 12H5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                    <path d="M9.5 10L13 7l-3.5-3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M13 7H5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
                Logout
            </button>
        </form>
    </div>

</div>

@endsection
