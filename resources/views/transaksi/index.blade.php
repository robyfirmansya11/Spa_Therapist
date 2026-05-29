@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap');

    :root {
        --cream: #FAF7F2;
        --warm-white: #FFFEFB;
        --stone-100: #F5F0E8;
        --stone-200: #E8E0D0;
        --stone-400: #B8A990;
        --stone-600: #7A6A54;
        --stone-800: #3D3020;
        --jade: #2D6A4F;
        --jade-light: #40916C;
        --jade-pale: #D8F3DC;
        --amber: #C77D2F;
        --amber-pale: #FEF3E2;
        --rose: #C0392B;
        --rose-pale: #FDECEA;
        --shadow-sm: 0 1px 3px rgba(61,48,32,0.08);
        --shadow-md: 0 4px 16px rgba(61,48,32,0.10);
        --shadow-lg: 0 8px 32px rgba(61,48,32,0.13);
        --radius: 14px;
        --radius-sm: 8px;
    }

    body, .spa-page {
        font-family: 'DM Sans', sans-serif;
        background: var(--cream);
        color: var(--stone-800);
    }

    /* ─── Page Header ─── */
.spa-table thead th {
    position: sticky;
    top: 0;
    z-index: 2;
}
.spa-table tbody tr {
    transition: all 0.2s ease;
}
.revenue {
    display: block;
    text-align: right;
}

    .spa-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 2rem;
        padding-bottom: 1.25rem;
        border-bottom: 1.5px solid var(--stone-200);
    }

    .spa-header-left .eyebrow {
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--stone-400);
        margin-bottom: 0.2rem;
    }

    .spa-header-left h2 {
        font-family: 'DM Serif Display', serif;
        font-size: 2rem;
        font-weight: 400;
        color: var(--stone-800);
        margin: 0;
        line-height: 1.15;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--jade);
        color: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.88rem;
        font-weight: 500;
        padding: 0.6rem 1.25rem;
        border-radius: 50px;
        text-decoration: none;
        transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
        box-shadow: 0 2px 8px rgba(45,106,79,0.18);
        white-space: nowrap;
    }

    .btn-add:hover {
        background: var(--jade-light);
        color: #fff;
        box-shadow: 0 4px 14px rgba(45,106,79,0.28);
        transform: translateY(-1px);
    }

    .btn-add svg { flex-shrink: 0; }

    /* ─── Filter Card ─── */
    .filter-card {
        background: var(--warm-white);
        border: 1.5px solid var(--stone-200);
        border-radius: var(--radius);
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
    }

    .filter-card .filter-label {
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--stone-400);
        margin-bottom: 0.85rem;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: 160px 1fr 1fr 1.5fr auto auto;
        gap: 0.65rem;
        align-items: end;
    }

    @media (max-width: 900px) {
        .filter-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 560px) {
        .filter-grid { grid-template-columns: 1fr; }
        .spa-header { flex-direction: column; align-items: flex-start; }
    }

    .filter-group label {
        display: block;
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--stone-600);
        margin-bottom: 0.3rem;
    }

    .filter-group input,
    .filter-group select {
        width: 100%;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.85rem;
        color: var(--stone-800);
        background: var(--cream);
        border: 1.5px solid var(--stone-200);
        border-radius: var(--radius-sm);
        padding: 0.45rem 0.75rem;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .filter-group input:focus,
    .filter-group select:focus {
        border-color: var(--jade);
        box-shadow: 0 0 0 3px rgba(45,106,79,0.10);
    }

    .btn-filter {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: var(--jade);
        color: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.83rem;
        font-weight: 500;
        padding: 0.48rem 1.1rem;
        border: none;
        border-radius: var(--radius-sm);
        cursor: pointer;
        transition: background 0.2s, transform 0.15s;
        white-space: nowrap;
    }

    .btn-filter:hover { background: var(--jade-light); transform: translateY(-1px); }

    .btn-reset {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: var(--stone-100);
        color: var(--stone-600);
        font-family: 'DM Sans', sans-serif;
        font-size: 0.83rem;
        font-weight: 500;
        padding: 0.48rem 1.1rem;
        border: 1.5px solid var(--stone-200);
        border-radius: var(--radius-sm);
        text-decoration: none;
        transition: background 0.2s;
        white-space: nowrap;
    }

    .btn-reset:hover { background: var(--stone-200); color: var(--stone-800); }

    /* ─── Table Card ─── */
    .table-card {
        background: var(--warm-white);
        border: 1.5px solid var(--stone-200);
        border-radius: var(--radius);
        box-shadow: var(--shadow-md);
        overflow: hidden;
    }

    .spa-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }

    .spa-table thead th {
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.09em;
        text-transform: uppercase;
        color: var(--stone-600);
        background: var(--stone-100);
        padding: 0.85rem 1rem;
        border-bottom: 1.5px solid var(--stone-200);
        white-space: nowrap;
    }

    .spa-table thead th:first-child { border-radius: 0; padding-left: 1.25rem; }
    .spa-table thead th:last-child  { padding-right: 1.25rem; }

    .spa-table tbody tr {
        border-bottom: 1px solid var(--stone-200);
        transition: background 0.15s;
    }

    .spa-table tbody tr:last-child { border-bottom: none; }
    .spa-table tbody tr:hover { background: var(--stone-100); }

    .spa-table tbody td {
        padding: 0.85rem 1rem;
        color: var(--stone-800);
        vertical-align: middle;
    }

    .spa-table tbody td:first-child { padding-left: 1.25rem; }
    .spa-table tbody td:last-child  { padding-right: 1.25rem; }

    /* Row number */
    .row-num {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 26px; height: 26px;
        background: var(--stone-100);
        border: 1px solid var(--stone-200);
        border-radius: 50%;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--stone-600);
    }

    /* Date badge */
    .date-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.82rem;
        color: var(--stone-600);
    }

    /* Bill number */
    .bill-num {
        font-family: 'DM Mono', monospace;
        font-size: 0.8rem;
        background: var(--stone-100);
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
        border: 1px solid var(--stone-200);
        color: var(--stone-600);
        white-space: nowrap;
    }

    /* Customer name */
    .name_user {
        font-weight: 500;
        color: var(--stone-800);
    }

    /* Hotel badge */
    .hotel-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: var(--jade-pale);
        color: var(--jade);
        font-size: 0.75rem;
        font-weight: 500;
        padding: 0.2rem 0.6rem;
        border-radius: 50px;
        white-space: nowrap;
    }

    /* Service name */
    .service-name {
        font-size: 0.83rem;
        color: var(--stone-600);
        font-style: italic;
    }

    /* Duration */
    .duration-cell {
        text-align: center;
        font-size: 0.82rem;
        color: var(--stone-600);
    }

    /* Revenue */
    .revenue {
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--jade);
        white-space: nowrap;
    }

    /* Action buttons */
    .action-cell {
        display: flex;
        gap: 0.4rem;
        align-items: center;
    }

    .btn-edit {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: var(--amber-pale);
        color: var(--amber);
        border: 1px solid #f5d9aa;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.75rem;
        font-weight: 500;
        padding: 0.32rem 0.7rem;
        border-radius: 6px;
        text-decoration: none;
        transition: background 0.18s, transform 0.15s;
        white-space: nowrap;
    }

    .btn-edit:hover {
        background: #f5e0c0;
        color: var(--amber);
        transform: translateY(-1px);
    }

    .btn-delete {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: var(--rose-pale);
        color: var(--rose);
        border: 1px solid #f5c6c2;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.75rem;
        font-weight: 500;
        padding: 0.32rem 0.7rem;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.18s, transform 0.15s;
        white-space: nowrap;
    }

    .btn-delete:hover {
        background: #f5d0cc;
        transform: translateY(-1px);
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--stone-400);
    }

    .empty-state svg {
        margin-bottom: 1rem;
        opacity: 0.4;
    }

    .empty-state p {
        font-size: 0.9rem;
        margin: 0;
    }

    /* Scrollable on small screens */
    .table-wrapper { overflow-x: auto; }
</style>

<div class="spa-page">

    {{-- ─── Header ─── --}}
    <div class="spa-header">
        <div class="spa-header-left">
            <div class="eyebrow">D'Luwes Spa</div>
            <h2>Data Transaksi Spa</h2>
        </div>
        <a href="/transaksi/create" class="btn-add">
            <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
                <path d="M7.5 1v13M1 7.5h13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Tambah Transaksi
        </a>
    </div>

    {{-- ─── Filter Card ─── --}}
    <div class="filter-card">
        <div class="filter-label">Filter Data</div>
        <form method="GET" action="/transaksi">
            <div class="filter-grid">

                <div class="filter-group">
                    <label>Tanggal</label>
                    <input type="date"
                           name="tanggal"
                           value="{{ request('tanggal') }}">
                </div>

                <div class="filter-group">
                    <label>No. Bill</label>
                    <input type="text"
                           name="no_bill"
                           placeholder="Cari no bill…"
                           value="{{ request('no_bill') }}">
                </div>

                <div class="filter-group">
                    <label>Nama Therapist</label>
                    <input type="text"
                           name="name"
                           placeholder="Nama therapist…"
                           value="{{ request('name') }}">
                </div>

                <div class="filter-group">
                    <label>Hotel</label>
                    <select name="hotel">
                        <option value="">Semua Hotel</option>
                        @foreach($hotels as $hotel)
                            <option value="{{ $hotel->id }}"
                                {{ request('hotel') == $hotel->id ? 'selected' : '' }}>
                                {{ $hotel->nama_hotel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group" style="display:flex;align-items:flex-end;">
                    <button type="submit" class="btn-filter">
                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                            <circle cx="5.5" cy="5.5" r="4.5" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M9.5 9.5L12 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        Filter
                    </button>
                </div>

                <div class="filter-group" style="display:flex;align-items:flex-end;">
                    <a href="/transaksi" class="btn-reset">
                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                            <path d="M2 6.5A4.5 4.5 0 1 0 6.5 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M2 2v4.5h4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Reset
                    </a>
                </div>

            </div>
        </form>
    </div>

    {{-- ─── Table ─── --}}
    <div class="table-card">
        <div class="table-wrapper">
            <table class="spa-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>No Bill</th>
                        <th>Nama Therapist</th>
                        {{-- <th>Hotel</th> --}}
                        <th>Service</th>
                        <th style="text-align:center">Menit</th>
                        <th style="text-align:center">Jam</th>
                        <th style="text-align:right">Revenue</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $transaksi)
                    <tr>
                        <td><span class="row-num">{{ $loop->iteration }}</span></td>

                        <td>
                            <span class="date-badge">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <rect x="1" y="2" width="10" height="9" rx="1.5" stroke="currentColor" stroke-width="1.2"/>
                                    <path d="M1 5h10M4 1v2M8 1v2" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
                                </svg>
                                {{ date('d M Y', strtotime($transaksi->tanggal_transaksi)) }}
                            </span>
                        </td>

                        <td><span class="bill-num">{{ $transaksi->no_bill }}</span></td>

                        <td>
    <span class="nama_user">
        {{ $transaksi->user->name ?? '-' }}
    </span>
</td>

  {{--                       <td>
                            <span class="hotel-badge">
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                                    <path d="M1 9V4l4-3 4 3v5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <rect x="3.5" y="6" width="3" height="3" rx="0.5" stroke="currentColor" stroke-width="1.1"/>
                                </svg>
                                {{ $transaksi->hotel->nama_hotel }}
                            </span>
                        </td> --}}

                        <td><span class="service-name">{{ $transaksi->dataSpa->nama_spa }}</span></td>

                        <td class="duration-cell">{{ $transaksi->menit }}<span style="font-size:0.7rem;color:var(--stone-400)"> min</span></td>

                        <td class="duration-cell">{{ $transaksi->jam }}<span style="font-size:0.7rem;color:var(--stone-400)"> h</span></td>

                        <td>
                            <span class="revenue">
                                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </span>
                        </td>

                        <td>
                            <div class="action-cell">
                                <a href="/transaksi/{{ $transaksi->id }}/edit" class="btn-edit">
                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none">
                                        <path d="M7.5 1.5l2 2L3 10H1V8L7.5 1.5z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/>
                                    </svg>
                                    Edit
                                </a>

                                <form action="/transaksi/{{ $transaksi->id }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn-delete"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
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
                        <td colspan="10">
                            <div class="empty-state">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                    <rect x="8" y="10" width="32" height="30" rx="3" stroke="currentColor" stroke-width="2"/>
                                    <path d="M16 10V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3" stroke="currentColor" stroke-width="2"/>
                                    <path d="M18 22h12M18 29h8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                                <p>Belum ada data transaksi.</p>
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
