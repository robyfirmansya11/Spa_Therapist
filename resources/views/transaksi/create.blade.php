@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap');

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
        --rose: #C0392B;

        --radius: 16px;

        --shadow-sm: 0 1px 3px rgba(61,48,32,0.08);
        --shadow-md: 0 8px 30px rgba(61,48,32,0.10);
    }

    body {
        background: var(--cream);
        font-family: 'DM Sans', sans-serif;
    }

    .page-header {
        margin-bottom: 2rem;
    }

    .page-header small {
        text-transform: uppercase;
        letter-spacing: .12em;
        color: var(--stone-400);
        font-weight: 600;
        font-size: .72rem;
    }

    .page-header h2 {
        font-family: 'DM Serif Display', serif;
        color: var(--stone-800);
        font-size: 2rem;
        margin-top: .2rem;
    }

    .form-card {
        background: var(--warm-white);
        border-radius: var(--radius);
        padding: 2rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--stone-200);
        max-width: 850px;
    }

    .form-label {
        font-size: .82rem;
        font-weight: 600;
        color: var(--stone-600);
        margin-bottom: .45rem;
    }

    .form-control,
    .form-select {
        border-radius: 12px;
        border: 1.5px solid var(--stone-200);
        background: var(--cream);
        padding: .75rem 1rem;
        font-size: .9rem;
        color: var(--stone-800);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--jade);
        box-shadow: 0 0 0 4px rgba(45,106,79,0.10);
    }

    .btn-save {
        background: var(--jade);
        color: white;
        border: none;
        border-radius: 12px;
        padding: .8rem 1.5rem;
        font-weight: 500;
        transition: .2s;
    }

    .btn-save:hover {
        background: var(--jade-light);
        transform: translateY(-1px);
    }

    .btn-back {
        background: white;
        border: 1.5px solid var(--stone-200);
        color: var(--stone-600);
        border-radius: 12px;
        padding: .8rem 1.5rem;
        text-decoration: none;
        transition: .2s;
    }

    .btn-back:hover {
        background: var(--stone-100);
    }

    .button-group {
        display: flex;
        gap: .75rem;
        margin-top: 2rem;
    }

    .price-info {
        margin-top: .5rem;
        font-size: .82rem;
        color: var(--stone-400);
    }
</style>

<div class="page-header">
    <small>D'Luwes Spa</small>
    <h2>Tambah Transaksi Spa</h2>
</div>

<div class="form-card">

    <form action="/transaksi" method="POST">

        @csrf

        <div class="row">

            <div class="col-md-6 mb-4">
                <label class="form-label">No Bill</label>

                <input type="text"
                    name="no_bill"
                    class="form-control"
                    placeholder="Contoh: BILL-0001">
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Tanggal Transaksi</label>

                <input type="date"
                    name="tanggal_transaksi"
                    class="form-control">
            </div>

        </div>

<div class="mb-4">
    <label class="form-label">Therapist</label>

    <input type="text"
        class="form-control"
        value="{{ auth()->user()->name }}"
        readonly>
</div>

<div class="mb-4">
    <label class="form-label">Hotel</label>

    <select name="hotel_id" class="form-select">

        <option value="" selected disabled>
            -- Pilih Hotel --
        </option>

        @foreach($hotels as $hotel)

            <option value="{{ $hotel->id }}">
                {{ $hotel->nama_hotel }}
            </option>

        @endforeach

    </select>
</div>

<div class="mb-4">

    <label class="form-label">
        Service Spa
    </label>

    <select
        name="data_spa_id"
        id="data_spa_id"
        class="form-select">

        <option value="" selected disabled>
            -- Pilih Service Spa --
        </option>

        @foreach($spas as $spa)

            <option
                value="{{ $spa->id }}"
                data-harga="{{ $spa->harga }}"
                data-durasi="{{ $spa->durasi }}">

                {{ $spa->nama_spa }}
                —
                Rp {{ number_format($spa->harga,0,',','.') }}

            </option>

        @endforeach

    </select>

    <div class="price-info">
        Pilih layanan spa sesuai treatment customer.
    </div>

</div>
        <div class="row">

            <div class="col-md-6 mb-4">
                <label class="form-label">Menit</label>

                <input type="number"
                    name="menit"
                    id="menit"
                    readonly
                    class="form-control"
                    placeholder="Contoh: 90">
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label">Jam</label>

                <input type="number"
                    step="0.1"
                    readonly
                    name="jam"
                    id="jam"
                    class="form-control"
                    placeholder="Contoh: 1.5">
            </div>

        </div>

        <div class="mb-4">

    <label class="form-label">
        Total Harga
    </label>

    <div id="totalHargaBox"
        style="
            background: var(--stone-100);
            border: 1.5px solid var(--stone-200);
            border-radius: 14px;
            padding: 1rem 1.2rem;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--jade);
        ">

        Rp 0

    </div>

</div>

        <div class="button-group">

            <button type="submit" class="btn-save">
                Simpan Transaksi
            </button>

            <a href="/transaksi" class="btn-back">
                Kembali
            </a>

        </div>

    </form>

</div>
<script>

    const serviceSelect =
        document.getElementById('data_spa_id');

    const menitInput =
        document.getElementById('menit');

    const jamInput =
        document.getElementById('jam');

    const totalHargaBox =
        document.getElementById('totalHargaBox');

    serviceSelect.addEventListener('change', function () {

        const selected =
            this.options[this.selectedIndex];

        const harga =
            parseInt(selected.dataset.harga);

        const durasi =
            parseInt(selected.dataset.durasi);

        const jam =
            durasi / 60;

        menitInput.value = durasi;

        jamInput.value = jam.toFixed(1);

        totalHargaBox.innerHTML =
            'Rp ' + harga.toLocaleString('id-ID');

    });

</script>

@endsection

