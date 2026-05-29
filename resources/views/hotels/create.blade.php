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
        --jade-pale:  #D8F3DC;
        --radius:     14px;
        --radius-sm:  10px;
    }

    .form-page { font-family: 'Jost', sans-serif; color: var(--ink); max-width: 640px; }

    /* Breadcrumb */
    .form-breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.75rem;
        color: var(--ink-soft);
        margin-bottom: 1.75rem;
    }
    .form-breadcrumb a { color: var(--ink-soft); text-decoration: none; }
    .form-breadcrumb a:hover { color: var(--gold); }
    .form-breadcrumb .sep { opacity: 0.4; }
    .form-breadcrumb .current { color: var(--ink); font-weight: 500; }

    /* Page title */
    .form-page-title {
        margin-bottom: 2rem;
        padding-bottom: 1.25rem;
        border-bottom: 1.5px solid var(--line);
    }
    .form-page-title .eyebrow {
        font-size: 0.68rem; font-weight: 600;
        letter-spacing: 0.14em; text-transform: uppercase;
        color: var(--ink-soft); margin-bottom: 0.2rem;
    }
    .form-page-title h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem; font-weight: 400;
        color: var(--ink); margin: 0; line-height: 1.1;
    }

    /* Card */
    .form-card {
        background: #fff;
        border: 1.5px solid var(--line);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(26,20,16,0.07);
    }

    .form-card-header {
        background: var(--parchment2);
        border-bottom: 1.5px solid var(--line);
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .form-card-icon {
        width: 34px; height: 34px;
        background: var(--gold-pale);
        border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        color: var(--gold);
        flex-shrink: 0;
    }

    .form-card-header-text .title {
        font-size: 0.88rem; font-weight: 600; color: var(--ink);
    }
    .form-card-header-text .subtitle {
        font-size: 0.72rem; color: var(--ink-soft);
    }

    .form-card-body { padding: 1.75rem 1.5rem; }

    /* Fields */
    .field-group { margin-bottom: 1.35rem; }

    .field-label {
        display: block;
        font-size: 0.72rem; font-weight: 600;
        letter-spacing: 0.1em; text-transform: uppercase;
        color: var(--ink-soft); margin-bottom: 0.45rem;
    }

    .field-required { color: var(--gold); margin-left: 2px; }

    .field-input-wrap { position: relative; }

    .field-icon {
        position: absolute; left: 0.85rem; top: 50%;
        transform: translateY(-50%);
        color: var(--ink-soft); pointer-events: none;
        transition: color 0.2s;
    }

    .field-icon.top { top: 0.85rem; transform: none; }

    .field-input,
    .field-textarea {
        width: 100%;
        font-family: 'Jost', sans-serif;
        font-size: 0.88rem; color: var(--ink);
        background: var(--parchment);
        border: 1.5px solid var(--line);
        border-radius: var(--radius-sm);
        padding: 0.68rem 0.9rem 0.68rem 2.5rem;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }

    .field-textarea {
        resize: vertical;
        min-height: 90px;
        padding-top: 0.68rem;
    }

    .field-input:focus,
    .field-textarea:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px var(--gold-dim);
        background: #fff;
    }

    .field-input-wrap:focus-within .field-icon { color: var(--gold); }

    .field-hint {
        font-size: 0.72rem; color: var(--ink-soft);
        margin-top: 0.35rem; display: flex; align-items: center; gap: 0.3rem;
    }

    /* Divider */
    .form-divider {
        height: 1px; background: var(--line);
        margin: 1.5rem 0;
    }

    /* Actions */
    .form-actions {
        display: flex; align-items: center; gap: 0.75rem;
        padding: 1.25rem 1.5rem;
        background: var(--parchment2);
        border-top: 1.5px solid var(--line);
    }

    .btn-submit {
        display: inline-flex; align-items: center; gap: 0.5rem;
        background: var(--jade); color: #fff;
        font-family: 'Jost', sans-serif;
        font-size: 0.85rem; font-weight: 500;
        padding: 0.65rem 1.4rem;
        border: none; border-radius: 50px; cursor: pointer;
        transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(45,106,79,0.18);
    }
    .btn-submit:hover {
        background: #40916C; transform: translateY(-1px);
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
</style>

<div class="form-page">

    {{-- Breadcrumb --}}
    <div class="form-breadcrumb">
        <a href="/dashboard">Dashboard</a>
        <span class="sep">/</span>
        <a href="/hotels">Data Hotel</a>
        <span class="sep">/</span>
        <span class="current">Tambah Hotel</span>
    </div>

    {{-- Title --}}
    <div class="form-page-title">
        <div class="eyebrow">Master Data</div>
        <h2>Tambah Hotel</h2>
    </div>

    {{-- Form card --}}
    <div class="form-card">

        <div class="form-card-header">
            <div class="form-card-icon">
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
                    <path d="M2 14V6.5L7.5 3l5.5 3.5V14" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                    <rect x="5" y="9" width="5" height="5" rx="0.6" stroke="currentColor" stroke-width="1.3"/>
                </svg>
            </div>
            <div class="form-card-header-text">
                <div class="title">Informasi Hotel</div>
                <div class="subtitle">Isi seluruh data hotel dengan benar</div>
            </div>
        </div>

        <form action="/hotels" method="POST">
            @csrf

            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label" for="nama_hotel">
                        Nama Hotel <span class="field-required">*</span>
                    </label>
                    <div class="field-input-wrap">
                        <span class="field-icon">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <path d="M2 14V6.5L7.5 3l5.5 3.5V14" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
                                <rect x="5" y="9" width="5" height="5" rx="0.5" stroke="currentColor" stroke-width="1.2"/>
                            </svg>
                        </span>
                        <input type="text" id="nama_hotel" name="nama_hotel"
                               class="field-input"
                               placeholder="Masukkan nama hotel…"
                               value="{{ old('nama_hotel') }}"
                               required>
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="alamat">
                        Alamat <span class="field-required">*</span>
                    </label>
                    <div class="field-input-wrap">
                        <span class="field-icon top">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <path d="M7.5 1.5a5 5 0 0 1 5 5c0 3.5-5 8-5 8s-5-4.5-5-8a5 5 0 0 1 5-5Z" stroke="currentColor" stroke-width="1.3"/>
                                <circle cx="7.5" cy="6.5" r="1.5" stroke="currentColor" stroke-width="1.2"/>
                            </svg>
                        </span>
                        <textarea id="alamat" name="alamat"
                                  class="field-textarea"
                                  placeholder="Jl. Contoh No. 1, Kota…"
                                  required>{{ old('alamat') }}</textarea>
                    </div>
                </div>

                <div class="field-group" style="margin-bottom:0;">
                    <label class="field-label" for="no_telp">
                        No. Telepon <span class="field-required">*</span>
                    </label>
                    <div class="field-input-wrap">
                        <span class="field-icon">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <path d="M3 2h3l1.5 3.5L5.5 7A9 9 0 0 0 8 9.5l1.5-2L13 9v3a1.5 1.5 0 0 1-1.5 1.5A12 12 0 0 1 1.5 3.5 1.5 1.5 0 0 1 3 2Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <input type="text" id="no_telp" name="no_telp"
                               class="field-input"
                               placeholder="08xxxxxxxxxx"
                               value="{{ old('no_telp') }}"
                               required>
                    </div>
                    <p class="field-hint">
                        <svg width="11" height="11" viewBox="0 0 11 11" fill="none">
                            <circle cx="5.5" cy="5.5" r="4.5" stroke="currentColor" stroke-width="1.1"/>
                            <path d="M5.5 3.5v3M5.5 8v.5" stroke="currentColor" stroke-width="1.1" stroke-linecap="round"/>
                        </svg>
                        Gunakan format nomor telepon aktif yang dapat dihubungi.
                    </p>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M2 7l3.5 3.5L12 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Simpan Hotel
                </button>
                <a href="/hotels" class="btn-cancel">
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
