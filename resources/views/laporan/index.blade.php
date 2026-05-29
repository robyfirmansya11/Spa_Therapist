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
        --jade-pale:  #D8F3DC;
        --amber:      #C77D2F;
        --amber-pale: #FEF3E2;
        --rose:       #A04545;
        --rose-pale:  #F9ECEC;
        --radius:     14px;
        --radius-sm:  8px;
    }

    .lap-page { font-family: 'Jost', sans-serif; color: var(--ink); }

    /* ── Header ── */
    .lap-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 2rem;
        padding-bottom: 1.25rem;
        border-bottom: 1.5px solid var(--line);
    }

    .lap-header .eyebrow {
        font-size: 0.68rem; font-weight: 600;
        letter-spacing: 0.14em; text-transform: uppercase;
        color: var(--ink-soft); margin-bottom: 0.2rem;
    }

    .lap-header h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem; font-weight: 400;
        color: var(--ink); margin: 0; line-height: 1.1;
    }

    .btn-create {
        display: inline-flex; align-items: center; gap: 0.5rem;
        background: var(--ink); color: #fff;
        font-family: 'Jost', sans-serif;
        font-size: 0.84rem; font-weight: 500;
        padding: 0.6rem 1.25rem; border-radius: 50px;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(26,20,16,0.15);
        transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        white-space: nowrap;
    }
    .btn-create:hover {
        background: var(--ink-mid); color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(26,20,16,0.22);
    }

    /* ── Summary cards ── */
    .summary-strip {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    @media (max-width: 640px) { .summary-strip { grid-template-columns: 1fr; } }

    .summary-card {
        background: #fff;
        border: 1.5px solid var(--line);
        border-radius: var(--radius);
        padding: 1.1rem 1.25rem;
        position: relative;
        overflow: hidden;
    }

    .summary-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px; border-radius: 0 0 var(--radius) var(--radius);
    }

    .summary-card.s-revenue::after { background: var(--jade); }
    .summary-card.s-menit::after   { background: var(--amber); }
    .summary-card.s-jam::after     { background: var(--gold); }

    .summary-label {
        font-size: 0.67rem; font-weight: 600;
        letter-spacing: 0.11em; text-transform: uppercase;
        color: var(--ink-soft); margin-bottom: 0.3rem;
    }

    .summary-value {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.75rem; font-weight: 400;
        color: var(--ink); line-height: 1;
    }

    .summary-card.s-revenue .summary-value { color: var(--jade); }

    /* ── Table card ── */
    .table-card {
        background: #fff;
        border: 1.5px solid var(--line);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(26,20,16,0.07);
    }

    .table-wrapper { overflow-x: auto; }

    .lap-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.855rem;
    }

    .lap-table thead th {
        font-size: 0.67rem; font-weight: 600;
        letter-spacing: 0.1em; text-transform: uppercase;
        color: var(--ink-soft); background: var(--parchment2);
        padding: 0.85rem 1rem;
        border-bottom: 1.5px solid var(--line);
        white-space: nowrap;
    }

    .lap-table thead th:first-child { padding-left: 1.4rem; }
    .lap-table thead th:last-child  { padding-right: 1.4rem; }

    .lap-table tbody tr {
        border-bottom: 1px solid var(--line);
        transition: background 0.14s;
    }
    .lap-table tbody tr:last-child { border-bottom: none; }
    .lap-table tbody tr:hover { background: var(--parchment); }

    .lap-table tbody td {
        padding: 0.8rem 1rem;
        vertical-align: middle;
        color: var(--ink);
    }
    .lap-table tbody td:first-child { padding-left: 1.4rem; }
    .lap-table tbody td:last-child  { padding-right: 1.4rem; }

    /* Row number */
    .row-num {
        display: inline-flex; align-items: center; justify-content: center;
        width: 24px; height: 24px;
        background: var(--parchment2);
        border: 1px solid var(--line);
        border-radius: 50%;
        font-size: 0.72rem; font-weight: 600; color: var(--ink-soft);
    }

    /* Date */
    .date-text {
        display: inline-flex; align-items: center; gap: 0.3rem;
        font-size: 0.82rem; color: var(--ink-soft);
    }

    /* Bill badge */
    .bill-badge {
        font-size: 0.78rem; background: var(--parchment2);
        border: 1px solid var(--line); border-radius: 4px;
        padding: 0.18rem 0.5rem; color: var(--ink-mid);
        white-space: nowrap;
    }

    /* Spa name */
    .spa-name { font-size: 0.82rem; color: var(--ink-soft); font-style: italic; }

    /* Duration */
    .dur-cell { font-size: 0.82rem; color: var(--ink-mid); text-align: center; }

    /* Revenue */
    .revenue { font-weight: 600; color: var(--jade); white-space: nowrap; }

    /* Subtotal row */
    .row-subtotal td {
        background: var(--parchment2) !important;
        font-size: 0.8rem; font-weight: 600;
        color: var(--ink-mid);
        border-top: 1px dashed var(--line);
        border-bottom: 1.5px solid var(--line);
    }
    .row-subtotal:hover { background: var(--parchment2) !important; }
    .row-subtotal .subtotal-label {
        text-align: right; font-size: 0.72rem;
        letter-spacing: 0.05em; text-transform: uppercase;
        color: var(--ink-soft);
    }
    .row-subtotal .subtotal-val { color: var(--jade); }

    /* Footer row */
    .lap-table tfoot td {
        background: var(--ink) !important;
        color: #fff;
        font-size: 0.8rem; font-weight: 600;
        padding: 1rem;
        letter-spacing: 0.04em;
    }
    .lap-table tfoot td:first-child { padding-left: 1.4rem; }
    .lap-table tfoot td:last-child  { padding-right: 1.4rem; }
    .lap-table tfoot .total-label {
        font-size: 0.68rem; letter-spacing: 0.13em;
        text-transform: uppercase; color: rgba(255,255,255,0.5);
    }
    .lap-table tfoot .total-val {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.25rem; font-weight: 400;
        color: #fff; line-height: 1;
    }
    .lap-table tfoot .total-val.gold { color: #E8C96A; }

    /* Empty */
    .empty-state { text-align: center; padding: 4rem 2rem; color: var(--ink-soft); }
    .empty-state svg { opacity: 0.3; margin-bottom: 1rem; }
    .empty-state p { font-size: 0.88rem; }

    @media (max-width: 560px) {
        .lap-header { flex-direction: column; align-items: flex-start; }
    }
</style>

<div class="lap-page">

    {{-- Header --}}
    <div class="lap-header">
        <div>
            <div class="eyebrow">D'Luwes Spa</div>
            <h2>Laporan Bulanan</h2>
        </div>
        <a href="/laporan/create" class="btn-create">
            <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                <path d="M6.5 1v11M1 6.5h11" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Buat Laporan
        </a>
    </div>

    <div class="table-card" style="margin-bottom:1.5rem;">
    <div style="padding:1.2rem 1.4rem;">
        <form method="GET" action="{{ route('laporan.index') }}">

            <div style="
                display:grid;
                grid-template-columns: 1fr 1fr 1fr auto;
                gap:1rem;
                align-items:end;
            ">

                <div>
                    <label style="font-size:.75rem;font-weight:600;">Bulan</label>

                    <select name="bulan" class="form-control"
                        style="width:100%;padding:.7rem;border:1px solid var(--line);border-radius:8px;">
                        @for($i=1; $i<=12; $i++)
                            <option value="{{ $i }}"
                                {{ request('bulan', date('m')) == $i ? 'selected' : '' }}>
                                {{ date('F', mktime(0,0,0,$i,1)) }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label style="font-size:.75rem;font-weight:600;">Tahun</label>

                    <input type="number"
                        name="tahun"
                        value="{{ request('tahun', date('Y')) }}"
                        class="form-control"
                        style="width:100%;padding:.7rem;border:1px solid var(--line);border-radius:8px;">
                </div>

                <div>
                    <label style="font-size:.75rem;font-weight:600;">Hotel</label>

                    <select name="hotel_id"
                        style="width:100%;padding:.7rem;border:1px solid var(--line);border-radius:8px;">

                        <option value="">Semua Hotel</option>

                        @foreach($hotels as $hotel)
                            <option value="{{ $hotel->id }}"
                                {{ request('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                {{ $hotel->nama_hotel }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div style="display:flex;gap:.5rem;">
                    <button type="submit"
                        style="
                            background:var(--ink);
                            color:white;
                            border:none;
                            padding:.75rem 1.2rem;
                            border-radius:8px;
                            cursor:pointer;
                        ">
                        Filter
                    </button>

                    <a href="{{ route('laporan.index') }}"
                        style="
                            background:#eee;
                            color:#333;
                            padding:.75rem 1rem;
                            border-radius:8px;
                            text-decoration:none;
                        ">
                        Reset
                    </a>
                </div>

            </div>

        </form>
    </div>
</div>

    {{-- Summary strip --}}
    <div class="summary-strip">
        <div class="summary-card s-revenue">
            <div class="summary-label">Total Revenue</div>
            <div class="summary-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        </div>
        <div class="summary-card s-menit">
            <div class="summary-label">Total Menit</div>
            <div class="summary-value">{{ number_format($totalMenit, 0, ',', '.') }} <span style="font-size:1rem;color:var(--ink-soft)">min</span></div>
        </div>
        <div class="summary-card s-jam">
            <div class="summary-label">Total Jam</div>
            <div class="summary-value">{{ number_format($totalJam, 2, ',', '.') }} <span style="font-size:1rem;color:var(--ink-soft)">jam</span></div>
        </div>
    </div>

    <div style="
    display:flex;
    justify-content:flex-end;
    gap:.75rem;
    margin-bottom:1rem;
">

    <a href="{{ route('laporan.export.excel', [
        'bulan' => request('bulan', date('m')),
        'tahun' => request('tahun', date('Y')),
        'hotel_id' => request('hotel_id')
    ]) }}"
    style="
        background:#2E7D32;
        color:white;
        text-decoration:none;
        padding:.65rem 1rem;
        border-radius:8px;
        font-size:.8rem;
    ">
        Export Excel
    </a>

    <a href="{{ route('laporan.export.pdf', [
        'bulan' => request('bulan', date('m')),
        'tahun' => request('tahun', date('Y')),
        'hotel_id' => request('hotel_id')
    ]) }}"
    target="_blank"
    style="
        background:#C0392B;
        color:white;
        text-decoration:none;
        padding:.65rem 1rem;
        border-radius:8px;
        font-size:.8rem;
    ">
        Export PDF
    </a>

</div>

    {{-- Table --}}
    <div class="table-card">
        <div class="table-wrapper">
            <table class="lap-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>No Bill</th>
                        <th>Therapist</th>
                        <th>Layanan</th>
                        <th style="text-align:center">Menit</th>
                        <th style="text-align:center">Jam</th>
                        <th>Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($grouped as $tanggal => $items)
                        @php $totalPerHari = $items->sum('total_harga'); @endphp

                        @foreach($items as $trx)
                        <tr>
                            <td><span class="row-num">{{ $loop->iteration }}</span></td>
                            <td>
                                <span class="date-text">
                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none">
                                        <rect x="1" y="1.5" width="9" height="8.5" rx="1.2" stroke="currentColor" stroke-width="1.1"/>
                                        <path d="M1 4.5h9M3.5 1v1.5M7.5 1v1.5" stroke="currentColor" stroke-width="1.1" stroke-linecap="round"/>
                                    </svg>
                                    {{ date('d M Y', strtotime($trx->tanggal_transaksi)) }}
                                </span>
                            </td>
                            <td><span class="bill-badge">{{ $trx->no_bill }}</span></td>
                            <td style="font-weight:500">{{ $trx->user->name ?? '-' }}</td>
                            <td><span class="spa-name">{{ $trx->dataSpa->nama_spa ?? '-' }}</span></td>
                            <td class="dur-cell">{{ $trx->menit }}<span style="font-size:0.7rem;color:var(--ink-soft)"> min</span></td>
                            <td class="dur-cell">{{ number_format($trx->jam, 2) }}<span style="font-size:0.7rem;color:var(--ink-soft)"> h</span></td>
                            <td><span class="revenue">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</span></td>
                        </tr>
                        @endforeach

                        {{-- Subtotal per hari --}}
                        <tr class="row-subtotal">
                            <td colspan="7" class="subtotal-label">
                                Subtotal {{ date('d M Y', strtotime($tanggal)) }}
                            </td>
                            <td class="subtotal-val">
                                Rp {{ number_format($totalPerHari, 0, ',', '.') }}
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <svg width="44" height="44" viewBox="0 0 44 44" fill="none">
                                        <rect x="6" y="8" width="32" height="30" rx="3" stroke="currentColor" stroke-width="2"/>
                                        <path d="M14 20h16M14 27h10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                        <path d="M14 8V5M30 8V5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    <p>Data laporan tidak ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <div class="total-label">Total Bulanan</div>
                        </td>
                        <td colspan="2">
                            <div class="total-label">Durasi</div>
                            <div class="total-val">{{ $totalMenit }} <span style="font-size:0.85rem;opacity:.6">min</span> / {{ number_format($totalJam, 2) }} <span style="font-size:0.85rem;opacity:.6">jam</span></div>
                        </td>
                        <td></td>
                        <td>
                            <div class="total-label">Revenue</div>
                            <div class="total-val gold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

@endsection
