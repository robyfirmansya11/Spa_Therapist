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

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--ink);
        color: #fff;
        font-family: 'Jost', sans-serif;
        font-size: 0.84rem;
        font-weight: 500;
        padding: 0.6rem 1.25rem;
        border-radius: 50px;
        text-decoration: none;
        transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(26,20,16,0.15);
        white-space: nowrap;
    }

    .btn-add:hover {
        background: var(--ink-mid);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(26,20,16,0.22);
    }

    /* Table card */
    .table-card {
        background: #fff;
        border: 1.5px solid var(--line);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(26,20,16,0.07);
    }

    .spa-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }

    .spa-table thead th {
        font-size: 0.68rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--ink-soft);
        background: var(--parchment2);
        padding: 0.85rem 1.1rem;
        border-bottom: 1.5px solid var(--line);
        white-space: nowrap;
    }

    .spa-table thead th:first-child { padding-left: 1.5rem; }
    .spa-table thead th:last-child  { padding-right: 1.5rem; }

    .spa-table tbody tr {
        border-bottom: 1px solid var(--line);
        transition: background 0.15s;
    }

    .spa-table tbody tr:last-child { border-bottom: none; }
    .spa-table tbody tr:hover { background: var(--parchment); }

    .spa-table tbody td {
        padding: 0.9rem 1.1rem;
        vertical-align: middle;
    }

    .spa-table tbody td:first-child { padding-left: 1.5rem; }
    .spa-table tbody td:last-child  { padding-right: 1.5rem; }

    /* Spa name */
    .spa-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.1rem;
        font-weight: 400;
        color: var(--ink);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .spa-name-icon {
        width: 28px; height: 28px;
        background: var(--jade-pale);
        border-radius: 7px;
        display: flex; align-items: center; justify-content: center;
        color: var(--jade);
        flex-shrink: 0;
    }

    /* Price badge */
    .price-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: var(--gold-pale);
        border: 1px solid #e8d49a;
        border-radius: 50px;
        padding: 0.2rem 0.65rem;
        font-size: 0.8rem;
        color: var(--gold);
        font-weight: 500;
        white-space: nowrap;
    }

    /* Duration badge */
    .duration-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: var(--parchment2);
        border: 1px solid var(--line);
        border-radius: 50px;
        padding: 0.2rem 0.65rem;
        font-size: 0.8rem;
        color: var(--ink-mid);
        white-space: nowrap;
    }

    /* Actions */
    .action-cell { display: flex; gap: 0.4rem; align-items: center; }

    .btn-edit {
        display: inline-flex; align-items: center; gap: 0.3rem;
        background: var(--amber-pale); color: var(--amber);
        border: 1px solid #f5d9aa;
        font-family: 'Jost', sans-serif; font-size: 0.75rem; font-weight: 500;
        padding: 0.3rem 0.7rem; border-radius: 6px; text-decoration: none;
        transition: background 0.18s, transform 0.15s;
    }
    .btn-edit:hover { background: #f5e0c0; color: var(--amber); transform: translateY(-1px); }

    .btn-delete {
        display: inline-flex; align-items: center; gap: 0.3rem;
        background: var(--rose-pale); color: var(--rose);
        border: 1px solid #f0c4c4;
        font-family: 'Jost', sans-serif; font-size: 0.75rem; font-weight: 500;
        padding: 0.3rem 0.7rem; border-radius: 6px; cursor: pointer;
        transition: background 0.18s, transform 0.15s;
    }
    .btn-delete:hover { background: #f5d0cc; transform: translateY(-1px); }

    /* Empty */
    .empty-state { text-align: center; padding: 4rem 2rem; color: var(--ink-soft); }
    .empty-state svg { opacity: 0.35; margin-bottom: 1rem; }
    .empty-state p { font-size: 0.88rem; }

    .table-wrapper { overflow-x: auto; }

    @media (max-width: 560px) {
        .spa-header { flex-direction: column; align-items: flex-start; }
    }

    .alert-success-custom {
    background: var(--jade-pale);
    color: var(--jade);
    border: 1px solid #b7e4c7;
    padding: 0.9rem 1rem;
    border-radius: var(--radius-sm);
    margin-bottom: 1.5rem;
    font-size: 0.85rem;
    font-weight: 500;
}

    .alert-success-custom .alert-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--jade);
        margin-bottom: 0.5rem;
    }
</style>

<div class="spa-page">

        @if(session('success'))
        <div class="alert-success-custom">
            {{ session('success') }}
        </div>
    @endif

    <div class="spa-header">
        <div>
            <div class="eyebrow">Master Data</div>
            <h2>Data Spa</h2>
        </div>
        <a href="/data-spas/create" class="btn-add">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M7 1v12M1 7h12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Tambah Spa
        </a>
    </div>

    <div class="table-card">
        <div class="table-wrapper">
            <table class="spa-table">
                <thead>
                    <tr>
                        <th>Nama Spa</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataSpas as $dataSpa)
                    <tr>
                        <td>
                            <div class="spa-name">
                                <span class="spa-name-icon">
                                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                                        <path d="M6.5 1C4 1 2 3 2 5.5c0 1.5.7 2.8 1.8 3.7L3.5 12h6l-.3-2.8A4.5 4.5 0 0 0 11 5.5C11 3 9 1 6.5 1Z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/>
                                        <path d="M5 7c.4.6 1 1 1.5 1s1.1-.4 1.5-1" stroke="currentColor" stroke-width="1.1" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                {{ $dataSpa->nama_spa }}
                            </div>
                        </td>
                        <td>
                            <span class="price-badge">
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                                    <circle cx="5" cy="5" r="4" stroke="currentColor" stroke-width="1.1"/>
                                    <path d="M5 2.5v5M3.5 3.5h2a1 1 0 0 1 0 2H3.5" stroke="currentColor" stroke-width="1" stroke-linecap="round"/>
                                </svg>
                                Rp {{ number_format($dataSpa->harga, 0, ',', '.') }}
                            </span>
                        </td>
                        <td>
                            <span class="duration-badge">
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                                    <circle cx="5" cy="5" r="4" stroke="currentColor" stroke-width="1.1"/>
                                    <path d="M5 3v2.5l1.5 1" stroke="currentColor" stroke-width="1.1" stroke-linecap="round"/>
                                </svg>
                                {{ $dataSpa->durasi }} menit
                            </span>
                        </td>
                        <td>
                            <div class="action-cell">
                                <a href="/data-spas/{{ $dataSpa->id }}/edit" class="btn-edit">
                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none">
                                        <path d="M7.5 1.5l2 2L3 10H1V8L7.5 1.5z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/>
                                    </svg>
                                    Edit
                                </a>
                                <form action="/data-spas/{{ $dataSpa->id }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete"
                                            onclick="return confirm('Yakin ingin menghapus spa ini?')">
                                        <svg width="11" height="11" viewBox="0 0 11 11" fill="none">
                                            <path d="M1.5 3h8M4 3V2h3v1M2.5 3l.5 6.5h5L9 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <svg width="44" height="44" viewBox="0 0 44 44" fill="none">
                                    <circle cx="22" cy="18" r="10" stroke="currentColor" stroke-width="2"/>
                                    <path d="M16 28c.8 2 3.2 4 6 4s5.2-2 6-4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M22 8v4M22 24v4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                                <p>Belum ada data spa.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
