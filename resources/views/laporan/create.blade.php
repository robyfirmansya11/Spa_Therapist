@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Jost:wght@300;400;500;600&display=swap');

    :root {
        --ink:        #1A1410;
        --ink-mid:    #4A3F35;
        --ink-soft:   #7A6A54;
        --parchment:  #F8F4EE;
        --parchment2: #F0EAE0;
        --line:       #E2D9CE;
        --gold:       #B8912A;
        --gold-pale:  #F5ECD4;
        --gold-dim:   rgba(184,145,42,0.13);
        --jade:       #2D6A4F;
        --jade-light: #40916C;
        --radius:     14px;
        --radius-sm:  10px;
    }

    .gen-page {
        font-family: 'Jost', sans-serif;
        color: var(--ink);
        max-width: 580px;
    }

    /* Breadcrumb */
    .form-breadcrumb {
        display: flex; align-items: center; gap: 0.5rem;
        font-size: 0.75rem; color: var(--ink-soft); margin-bottom: 1.75rem;
    }
    .form-breadcrumb a { color: var(--ink-soft); text-decoration: none; }
    .form-breadcrumb a:hover { color: var(--gold); }
    .form-breadcrumb .sep { opacity: 0.4; }
    .form-breadcrumb .current { color: var(--ink); font-weight: 500; }

    /* Page title */
    .gen-title {
        margin-bottom: 2rem; padding-bottom: 1.25rem;
        border-bottom: 1.5px solid var(--line);
    }
    .gen-title .eyebrow {
        font-size: 0.68rem; font-weight: 600;
        letter-spacing: 0.14em; text-transform: uppercase;
        color: var(--ink-soft); margin-bottom: 0.2rem;
    }
    .gen-title h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem; font-weight: 400;
        color: var(--ink); margin: 0; line-height: 1.1;
    }

    /* Card */
    .gen-card {
        background: #fff;
        border: 1.5px solid var(--line);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(26,20,16,0.07);
    }

    .gen-card-header {
        background: var(--parchment2);
        border-bottom: 1.5px solid var(--line);
        padding: 1rem 1.5rem;
        display: flex; align-items: center; gap: 0.75rem;
    }

    .gen-card-icon {
        width: 34px; height: 34px;
        background: var(--gold-pale); border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        color: var(--gold); flex-shrink: 0;
    }

    .gen-card-header-text .title { font-size: 0.88rem; font-weight: 600; color: var(--ink); }
    .gen-card-header-text .subtitle { font-size: 0.72rem; color: var(--ink-soft); }

    .gen-card-body { padding: 1.75rem 1.5rem; }

    /* Fields */
    .field-group { margin-bottom: 1.35rem; }

    .field-label {
        display: block; font-size: 0.72rem; font-weight: 600;
        letter-spacing: 0.1em; text-transform: uppercase;
        color: var(--ink-soft); margin-bottom: 0.45rem;
    }

    .field-required { color: var(--gold); margin-left: 2px; }

    .field-input-wrap { position: relative; }

    .field-icon {
        position: absolute; left: 0.85rem; top: 50%;
        transform: translateY(-50%);
        color: var(--ink-soft); pointer-events: none; transition: color 0.2s;
    }

    .field-input,
    .field-select {
        width: 100%;
        font-family: 'Jost', sans-serif;
        font-size: 0.88rem; color: var(--ink);
        background: var(--parchment);
        border: 1.5px solid var(--line);
        border-radius: var(--radius-sm);
        padding: 0.68rem 0.9rem 0.68rem 2.5rem;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        appearance: none;
    }

    .field-input:focus,
    .field-select:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px var(--gold-dim);
        background: #fff;
    }

    .field-input-wrap:focus-within .field-icon { color: var(--gold); }

    /* Select chevron */
    .select-chevron {
        position: absolute; right: 0.85rem; top: 50%;
        transform: translateY(-50%);
        color: var(--ink-soft); pointer-events: none;
    }

    /* Period preview */
    .period-preview {
        display: flex; align-items: center; gap: 0.5rem;
        margin-top: 1.25rem; margin-bottom: 0.25rem;
        padding: 0.8rem 1rem;
        background: var(--parchment);
        border: 1px solid var(--line); border-radius: 10px;
    }

    .period-preview-icon {
        width: 30px; height: 30px;
        background: var(--gold-pale); border-radius: 7px;
        display: flex; align-items: center; justify-content: center;
        color: var(--gold); flex-shrink: 0;
    }

    .period-preview-text {
        font-size: 0.8rem; color: var(--ink-soft); line-height: 1.4;
    }

    .period-preview-text strong { color: var(--ink); font-weight: 600; }

    /* Divider */
    .form-divider { height: 1px; background: var(--line); margin: 0.5rem 0 1.25rem; }

    /* Actions */
    .gen-actions {
        display: flex; align-items: center; gap: 0.75rem;
        padding: 1.25rem 1.5rem;
        background: var(--parchment2);
        border-top: 1.5px solid var(--line);
    }

    .btn-generate {
        display: inline-flex; align-items: center; gap: 0.5rem;
        background: var(--jade); color: #fff;
        font-family: 'Jost', sans-serif;
        font-size: 0.85rem; font-weight: 500;
        padding: 0.65rem 1.4rem; border: none; border-radius: 50px;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(45,106,79,0.18);
        transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
    }
    .btn-generate:hover {
        background: var(--jade-light); transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(45,106,79,0.28);
    }

    .btn-cancel {
        display: inline-flex; align-items: center; gap: 0.4rem;
        background: transparent; color: var(--ink-soft);
        font-family: 'Jost', sans-serif;
        font-size: 0.84rem; font-weight: 400;
        padding: 0.65rem 1.1rem;
        border: 1.5px solid var(--line); border-radius: 50px;
        text-decoration: none;
        transition: border-color 0.2s, color 0.2s, background 0.2s;
    }
    .btn-cancel:hover {
        border-color: var(--ink-soft); color: var(--ink);
        background: var(--parchment2);
    }

    /* Month grid selector */
    .month-grid {
        display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.5rem;
        margin-top: 0.45rem;
    }

    .month-option { display: none; }

    .month-label {
        display: flex; align-items: center; justify-content: center;
        padding: 0.5rem 0.3rem;
        background: var(--parchment);
        border: 1.5px solid var(--line);
        border-radius: 8px;
        font-size: 0.8rem; color: var(--ink-mid);
        cursor: pointer; text-align: center;
        transition: border-color 0.18s, background 0.18s, color 0.18s;
        user-select: none;
    }

    .month-option:checked + .month-label {
        background: var(--gold-pale);
        border-color: var(--gold);
        color: var(--gold);
        font-weight: 600;
    }
</style>

<div class="gen-page">

    {{-- Breadcrumb --}}
    <div class="form-breadcrumb">
        <a href="/dashboard">Dashboard</a>
        <span class="sep">/</span>
        <a href="/laporan">Laporan</a>
        <span class="sep">/</span>
        <span class="current">Generate Laporan</span>
    </div>

    {{-- Title --}}
    <div class="gen-title">
        <div class="eyebrow">D'Luwes Spa</div>
        <h2>Generate Laporan</h2>
    </div>

    <div class="gen-card">

        <div class="gen-card-header">
            <div class="gen-card-icon">
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
                    <rect x="2" y="2.5" width="11" height="10.5" rx="1.5" stroke="currentColor" stroke-width="1.3"/>
                    <path d="M2 6h11" stroke="currentColor" stroke-width="1.3"/>
                    <path d="M5 1v2M10 1v2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                    <path d="M5 9h5M5 11.5h3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
                </svg>
            </div>
            <div class="gen-card-header-text">
                <div class="title">Filter Periode Laporan</div>
                <div class="subtitle">Pilih bulan, tahun, dan hotel untuk menampilkan laporan</div>
            </div>
        </div>

        <form action="/laporan" method="GET">

            <div class="gen-card-body">

                {{-- Month grid --}}
                <div class="field-group">
                    <label class="field-label">
                        Bulan <span class="field-required">*</span>
                    </label>
                    <div class="month-grid">
                        @php
                            $bulanList = ['1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'Mei','6'=>'Jun','7'=>'Jul','8'=>'Ags','9'=>'Sep','10'=>'Okt','11'=>'Nov','12'=>'Des'];
                        @endphp
                        @foreach($bulanList as $val => $label)
                        <input type="radio" name="bulan" id="bulan_{{ $val }}" value="{{ $val }}"
                               class="month-option"
                               {{ request('bulan', date('n')) == $val ? 'checked' : '' }}
                               required>
                        <label for="bulan_{{ $val }}" class="month-label">{{ $label }}</label>
                        @endforeach
                    </div>
                </div>

                <div class="form-divider"></div>

                {{-- Year --}}
                <div class="field-group">
                    <label class="field-label" for="tahun">
                        Tahun <span class="field-required">*</span>
                    </label>
                    <div class="field-input-wrap">
                        <span class="field-icon">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <circle cx="7.5" cy="7.5" r="6" stroke="currentColor" stroke-width="1.3"/>
                                <path d="M7.5 4v4l2.5 1.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <input type="number" id="tahun" name="tahun"
                               class="field-input"
                               value="{{ request('tahun', date('Y')) }}"
                               min="2000" max="2099"
                               required>
                    </div>
                </div>

                {{-- Hotel --}}
                <div class="field-group" style="margin-bottom:0;">
                    <label class="field-label" for="hotel_id">Hotel</label>
                    <div class="field-input-wrap">
                        <span class="field-icon">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <path d="M2 14V6.5L7.5 3l5.5 3.5V14" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
                                <rect x="5" y="9" width="5" height="5" rx="0.5" stroke="currentColor" stroke-width="1.2"/>
                            </svg>
                        </span>
                        <select id="hotel_id" name="hotel_id" class="field-select">
                            <option value="">Semua Hotel</option>
                            @foreach($hotels as $hotel)
                                <option value="{{ $hotel->id }}"
                                    {{ request('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                    {{ $hotel->nama_hotel }}
                                </option>
                            @endforeach
                        </select>
                        <span class="select-chevron">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M3 4.5l3 3 3-3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                </div>

            </div>

            <div class="gen-actions">
                <button type="submit" class="btn-generate">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <circle cx="7" cy="7" r="5.5" stroke="currentColor" stroke-width="1.4"/>
                        <path d="M7 4v3.5l2 1.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Tampilkan Laporan
                </button>
                <a href="/laporan" class="btn-cancel">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M9 3L3 9M3 3l6 6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                    </svg>
                    Batal
                </a>
            </div>

        </form>
    </div>

</div>

@endsection
