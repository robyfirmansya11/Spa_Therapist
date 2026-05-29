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
        --jade:       #2D6A4F;
        --jade-pale:  #D8F3DC;
        --amber:      #C77D2F;
        --amber-pale: #FEF3E2;
        --rose:       #A04545;
        --rose-pale:  #F9ECEC;
        --radius:     14px;
        --radius-sm:  8px;
    }

    .spa-page { font-family: 'Jost', sans-serif; color: var(--ink); }

    /* Header */
    .spa-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 2rem;
        padding-bottom: 1.25rem;
        border-bottom: 1.5px solid var(--line);
    }

    .spa-header .eyebrow {
        font-size: 0.68rem;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--ink-soft);
        margin-bottom: 0.2rem;
    }

    .spa-header h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        font-weight: 400;
        color: var(--ink);
        margin: 0;
        line-height: 1.1;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: transparent;
        color: var(--ink-soft);
        font-family: 'Jost', sans-serif;
        font-size: 0.84rem;
        font-weight: 500;
        padding: 0.6rem 1.1rem;
        border-radius: 50px;
        text-decoration: none;
        border: 1.5px solid var(--line);
        transition: border-color 0.2s, color 0.2s, transform 0.15s;
        white-space: nowrap;
    }

    .btn-back:hover {
        border-color: var(--ink-mid);
        color: var(--ink);
        transform: translateY(-1px);
    }

    /* Form card */
    .form-card {
        background: #fff;
        border: 1.5px solid var(--line);
        border-radius: var(--radius);
        padding: 2rem 2rem 2.5rem;
        box-shadow: 0 4px 16px rgba(26,20,16,0.07);
        max-width: 560px;
    }

    /* Edit notice */
    .edit-notice {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        background: var(--amber-pale);
        border: 1px solid #f5d9aa;
        border-radius: var(--radius-sm);
        padding: 0.6rem 0.9rem;
        font-size: 0.8rem;
        color: var(--amber);
        margin-bottom: 1.6rem;
    }

    .form-group {
        margin-bottom: 1.4rem;
    }

    .form-group label {
        display: block;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--ink-soft);
        margin-bottom: 0.45rem;
    }

    .form-control-custom {
        width: 100%;
        background: var(--parchment);
        border: 1.5px solid var(--line);
        border-radius: var(--radius-sm);
        padding: 0.65rem 0.9rem;
        font-family: 'Jost', sans-serif;
        font-size: 0.9rem;
        color: var(--ink);
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        box-sizing: border-box;
    }

    .form-control-custom:focus {
        border-color: var(--gold);
        background: #fff;
        box-shadow: 0 0 0 3px var(--gold-pale);
    }

    /* Input with prefix/suffix */
    .input-wrapper {
        position: relative;
    }

    .input-prefix {
        position: absolute;
        left: 0.9rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.82rem;
        font-weight: 500;
        color: var(--ink-soft);
        pointer-events: none;
        white-space: nowrap;
    }

    .input-suffix {
        position: absolute;
        right: 0.9rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.82rem;
        color: var(--ink-soft);
        pointer-events: none;
    }

    .has-prefix .form-control-custom { padding-left: 2.6rem; }
    .has-suffix .form-control-custom { padding-right: 3.5rem; }

    /* Form divider */
    .form-divider {
        height: 1px;
        background: var(--line);
        margin: 1.8rem 0;
    }

    /* Submit button */
    .btn-update {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--ink);
        color: #fff;
        font-family: 'Jost', sans-serif;
        font-size: 0.88rem;
        font-weight: 500;
        padding: 0.7rem 1.6rem;
        border-radius: 50px;
        border: none;
        cursor: pointer;
        transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(26,20,16,0.15);
    }

    .btn-update:hover {
        background: var(--ink-mid);
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(26,20,16,0.22);
    }

    @media (max-width: 560px) {
        .spa-header { flex-direction: column; align-items: flex-start; }
        .form-card { padding: 1.4rem 1.2rem 2rem; }
    }
</style>

<div class="spa-page">

    <div class="spa-header">
        <div>
            <div class="eyebrow">Master Data</div>
            <h2>Edit Spa</h2>
        </div>
        <a href="/data-spas" class="btn-back">
            <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                <path d="M8 2L4 6.5 8 11" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="form-card">

        <div class="edit-notice">
            <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                <path d="M9 1.5l2 2L4.5 11H2V8.5L9 1.5z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
            </svg>
            Mengubah data: <strong>{{ $dataSpa->nama_spa }}</strong>
        </div>

        <form action="/data-spas/{{ $dataSpa->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_spa">Nama Spa</label>
                <input type="text"
                       id="nama_spa"
                       name="nama_spa"
                       class="form-control-custom"
                       value="{{ $dataSpa->nama_spa }}"
                       required>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <div class="input-wrapper has-prefix">
                    <span class="input-prefix">Rp</span>
                    <input type="number"
                           id="harga"
                           name="harga"
                           class="form-control-custom"
                           value="{{ $dataSpa->harga }}"
                           min="0"
                           required>
                </div>
            </div>

            <div class="form-group">
                <label for="durasi">Durasi</label>
                <div class="input-wrapper has-suffix">
                    <input type="number"
                           id="durasi"
                           name="durasi"
                           class="form-control-custom"
                           value="{{ $dataSpa->durasi }}"
                           min="1"
                           required>
                    <span class="input-suffix">menit</span>
                </div>
            </div>

            <div class="form-divider"></div>

            <button type="submit" class="btn-update">
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                    <path d="M2 7l3.5 3.5L11 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Update
            </button>
        </form>
    </div>

</div>

@endsection
