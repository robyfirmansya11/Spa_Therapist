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

    .hotel-page { font-family: 'Jost', sans-serif; color: var(--ink); }

    /* Header */
    .hotel-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 2rem;
        padding-bottom: 1.25rem;
        border-bottom: 1.5px solid var(--line);
    }

    .hotel-header .eyebrow {
        font-size: 0.68rem;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--ink-soft);
        margin-bottom: 0.2rem;
    }

    .hotel-header h2 {
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

    .hotel-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }

    .hotel-table thead th {
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

    .hotel-table thead th:first-child { padding-left: 1.5rem; }
    .hotel-table thead th:last-child  { padding-right: 1.5rem; }

    .hotel-table tbody tr {
        border-bottom: 1px solid var(--line);
        transition: background 0.15s;
    }

    .hotel-table tbody tr:last-child { border-bottom: none; }
    .hotel-table tbody tr:hover { background: var(--parchment); }

    .hotel-table tbody td {
        padding: 0.9rem 1.1rem;
        vertical-align: middle;
    }

    .hotel-table tbody td:first-child { padding-left: 1.5rem; }
    .hotel-table tbody td:last-child  { padding-right: 1.5rem; }

    /* Hotel name */
    .hotel-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.1rem;
        font-weight: 400;
        color: var(--ink);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .hotel-name-icon {
        width: 28px; height: 28px;
        background: var(--gold-pale);
        border-radius: 7px;
        display: flex; align-items: center; justify-content: center;
        color: var(--gold);
        flex-shrink: 0;
    }

    /* Address */
    .addr-text {
        font-size: 0.82rem;
        color: var(--ink-soft);
        max-width: 260px;
        line-height: 1.4;
    }

    /* Phone badge */
    .phone-badge {
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
        .hotel-header { flex-direction: column; align-items: flex-start; }
    }
</style>

<div class="hotel-page">

    <div class="hotel-header">
        <div>
            <div class="eyebrow">Master Data</div>
            <h2>Data Hotel</h2>
        </div>
        <a href="/hotels/create" class="btn-add">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M7 1v12M1 7h12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Tambah Hotel
        </a>
    </div>

    <div class="table-card">
        <div class="table-wrapper">
            <table class="hotel-table">
                <thead>
                    <tr>
                        <th>Nama Hotel</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hotels as $hotel)
                    <tr>
                        <td>
                            <div class="hotel-name">
                                <span class="hotel-name-icon">
                                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                                        <path d="M1.5 12V5.5L6.5 2l5 3.5V12" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
                                        <rect x="4" y="7.5" width="5" height="4.5" rx="0.5" stroke="currentColor" stroke-width="1.2"/>
                                    </svg>
                                </span>
                                {{ $hotel->nama_hotel }}
                            </div>
                        </td>
                        <td><span class="addr-text">{{ $hotel->alamat }}</span></td>
                        <td>
                            <span class="phone-badge">
                                <svg width="11" height="11" viewBox="0 0 11 11" fill="none">
                                    <path d="M2 1.5h2.5l1 2.5-1.5 1a6 6 0 0 0 2.5 2.5l1-1.5 2.5 1V9.5A1.5 1.5 0 0 1 8.5 11 8.5 8.5 0 0 1 0 2.5 1.5 1.5 0 0 1 1.5 1H2Z" stroke="currentColor" stroke-width="1.1" stroke-linejoin="round"/>
                                </svg>
                                {{ $hotel->no_telp }}
                            </span>
                        </td>
                        <td>
                            <div class="action-cell">
                                <a href="/hotels/{{ $hotel->id }}/edit" class="btn-edit">
                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none">
                                        <path d="M7.5 1.5l2 2L3 10H1V8L7.5 1.5z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/>
                                    </svg>
                                    Edit
                                </a>
                                <form action="/hotels/{{ $hotel->id }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete"
                                            onclick="return confirm('Yakin ingin menghapus hotel ini?')">
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
                                    <path d="M4 40V18L22 6l18 12v22" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                    <rect x="14" y="24" width="16" height="16" rx="1.5" stroke="currentColor" stroke-width="2"/>
                                    <path d="M18 32h8M18 28h5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                                <p>Belum ada data hotel.</p>
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
