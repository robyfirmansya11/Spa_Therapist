<!DOCTYPE html>
<html>
<head>
    <title>Laporan Spa</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Source+Sans+3:wght@300;400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Source Sans 3', 'Segoe UI', sans-serif;
            font-size: 11px;
            color: #2c2c2c;
            background: #fff;
            padding: 28px 32px;
        }

        /* ── Header ── */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding-bottom: 14px;
            border-bottom: 3px solid #1a3c34;
            margin-bottom: 20px;
        }

                .header-left img.logo {
            height: 72px;
            width: auto;
            object-fit: contain;
        }

                .header-left .brand-text .brand-name {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 22px;
            font-weight: 700;
            color: #1a3c34;
            letter-spacing: 0.5px;
        }

        .header-left .brand-text .brand-sub {
            font-size: 9.5px;
            color: #7a8c88;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 2px;
        }


        .header-left .brand {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 26px;
            font-weight: 700;
            color: #1a3c34;
            letter-spacing: 0.5px;
        }

        .header-left .subtitle {
            font-size: 10px;
            color: #7a8c88;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .header-right {
            text-align: right;
        }

        .header-right .period-label {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #7a8c88;
        }

        .header-right .period-value {
            font-size: 16px;
            font-weight: 600;
            color: #1a3c34;
            margin-top: 2px;
        }

        .generated-at {
            font-size: 9px;
            color: #aab;
            margin-top: 2px;
        }

        /* ── Table ── */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }

        thead tr th {
            background: #1a3c34;
            color: #e8f0ee;
            font-size: 9.5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 9px 8px;
            text-align: left;
            border: none;
        }

        thead tr th.text-right {
            text-align: right;
        }

        thead tr th.text-center {
            text-align: center;
        }

        tbody tr td {
            padding: 7px 8px;
            border-bottom: 1px solid #e8edec;
            vertical-align: middle;
            color: #333;
        }

        tbody tr td.text-right {
            text-align: right;
        }

        tbody tr td.text-center {
            text-align: center;
        }

        /* Zebra rows */
        tbody tr:nth-child(even) td {
            background: #f5f9f8;
        }

        /* First row of a date group gets a subtle top accent */
        tr.group-first td {
            border-top: 2px solid #b0ccc7;
        }

        /* Date cell styling */
        .date-cell {
            font-weight: 600;
            color: #1a3c34;
            white-space: nowrap;
        }

        .nobill-cell {
            font-family: 'Courier New', monospace;
            font-size: 10px;
            color: #556;
        }

        .therapist-cell {
            color: #2c4a44;
            font-weight: 600;
        }

        .service-cell {
            color: #445;
            font-style: italic;
        }

        .menit-cell, .jam-cell {
            text-align: center;
            color: #556;
        }

        .revenue-cell {
            text-align: right;
            font-weight: 600;
            color: #1a3c34;
            white-space: nowrap;
        }

        /* ── Subtotal row (per day) ── */
        tr.subtotal td {
            background: #dff0ec !important;
            border-top: 1.5px solid #8bbdb5;
            border-bottom: 2px solid #8bbdb5;
            font-weight: 700;
            font-size: 10.5px;
            color: #1a3c34;
        }

        tr.subtotal .subtotal-label {
            text-align: right;
            font-style: italic;
            padding-right: 6px;
            color: #2d6b5e;
        }

        tr.subtotal .subtotal-amount {
            text-align: right;
            color: #1a3c34;
            white-space: nowrap;
        }

        tr.subtotal .subtotal-total {
            text-align: right;
            color: #1a3c34;
            font-weight: 700;
            white-space: nowrap;
        }

        /* ── Footer total ── */
        .total-section {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .total-box {
            background: #1a3c34;
            color: #fff;
            border-radius: 6px;
            padding: 14px 22px;
            min-width: 260px;
        }

        .total-box .total-label {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #8bbdb5;
            margin-bottom: 4px;
        }

        .total-box .total-amount {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.5px;
        }

        .total-box .total-count {
            font-size: 9px;
            color: #8bbdb5;
            margin-top: 4px;
        }

        /* ── Footer note ── */
        .footer-note {
            margin-top: 24px;
            border-top: 1px solid #dde;
            padding-top: 10px;
            font-size: 9px;
            color: #aab;
            display: flex;
            justify-content: space-between;
        }

        /* Print tweaks */
        @media print {
            body { padding: 16px 20px; }
            .header { margin-bottom: 14px; }
        }
    </style>
</head>
<body>

{{-- ── HEADER ── --}}
<div class="header">
    <div class="header-left">
            <img class="logo"
     src="{{ public_path('images/logo.png') }}" alt="D' Luwes Spa Logo">
        <div class="brand-text">
            <div class="brand-name">D'LUWES FAMILY SPA</div>
            <div class="brand-sub">MASSAGE DAILY REPORT</div>
        </div>
    </div>
    <div class="header-right">
        <div class="period-label">Periode</div>
        <div class="period-value">
            {{ \Carbon\Carbon::create($tahun, $bulan, 1)->translatedFormat('F Y') }}
        </div>
        <div class="generated-at">Dicetak: {{ now()->format('d/m/Y H:i') }}</div>
    </div>
</div>

{{-- ── TABLE ── --}}
<table>
    <thead>
        <tr>
            <th style="width:70px">Tanggal</th>
            <th style="width:80px">No Bill</th>
            <th>Therapist</th>
            <th>Service</th>
            <th class="text-center" style="width:44px">Menit</th>
            <th class="text-center" style="width:40px">Jam</th>
            <th class="text-right" style="width:90px">Revenue</th>
            <th class="text-right" style="width:100px">Total / Hari</th>
        </tr>
    </thead>

    <tbody>

    @php $grandTotal = 0; $transactionCount = 0; @endphp

    @foreach($grouped as $tanggal => $items)
        @php
            $dailyTotal = $items->sum('total_harga');
            $grandTotal += $dailyTotal;
            $transactionCount += $items->count();
        @endphp

        @foreach($items as $i => $trx)
        <tr class="{{ $i === 0 ? 'group-first' : '' }}">
            <td class="date-cell">
                @if($i === 0)
                    {{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->format('d/m/Y') }}
                @endif
            </td>
            <td class="nobill-cell">{{ $trx->no_bill }}</td>
            <td class="therapist-cell">{{ $trx->user->name ?? '-' }}</td>
            <td class="service-cell">{{ $trx->dataSpa->nama_spa ?? '-' }}</td>
            <td class="menit-cell">{{ $trx->menit }}</td>
            <td class="jam-cell">{{ $trx->jam }}</td>
            <td class="revenue-cell">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
            <td></td>{{-- Total/Hari diisi di baris subtotal --}}
        </tr>
        @endforeach

        {{-- Subtotal baris per hari --}}
        <tr class="subtotal">
            <td colspan="5"></td>
            <td class="subtotal-label">Sub-total ({{ $items->count() }} trx)</td>
            <td class="subtotal-amount"></td>
            <td class="subtotal-total">Rp {{ number_format($dailyTotal, 0, ',', '.') }}</td>
        </tr>

    @endforeach

    </tbody>
</table>

{{-- ── GRAND TOTAL ── --}}
<div class="total-section">
    <div class="total-box">
        <div class="total-label">Total Revenue Bulan Ini</div>
        <div class="total-amount">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        <div class="total-count">{{ $transactionCount }} transaksi &nbsp;|&nbsp; {{ $grouped->count() }} hari aktif</div>
    </div>
</div>

{{-- ── FOOTER ── --}}
<div class="footer-note">
    <span>* Dokumen ini digenerate secara otomatis oleh sistem.</span>
    <span>Halaman 1 / 1</span>
</div>

</body>
</html>
