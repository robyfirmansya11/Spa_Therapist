<?php

namespace App\Http\Controllers;

use App\Models\DataSpa;
use App\Models\Hotel;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with('hotel', 'dataSpa', 'user');

        // Jika therapist, tampilkan hanya transaksi miliknya
        if (auth()->user()->role == 'therapist') {
            $query->where('user_id', auth()->id());
        }

        // Filter tanggal
        if ($request->tanggal) {
            $query->whereDate(
                'tanggal_transaksi',
                $request->tanggal
            );
        }

        // Filter no bill
        if ($request->no_bill) {
            $query->where(
                'no_bill',
                'like',
                '%'.$request->no_bill.'%'
            );
        }

        // Filter therapist
        if ($request->name) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where(
                    'name',
                    'like',
                    '%'.$request->name.'%'
                );
            });
        }

        // Filter hotel
        if ($request->hotel) {
            $query->where(
                'hotel_id',
                $request->hotel
            );
        }

        $transaksis = $query->latest()->get();

        $hotels = Hotel::all();

        return view('transaksi.index', compact(
            'transaksis',
            'hotels'
        ));
    }

    public function create()
    {
        $hotels = Hotel::all();
        $spas = DataSpa::all();

        return view('transaksi.create', compact(
            'hotels',
            'spas'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_bill' => 'required',
            'hotel_id' => 'required',
            'data_spa_id' => 'required',
            'tanggal_transaksi' => 'required',
        ]);

        $spa = DataSpa::findOrFail($request->data_spa_id);

        Transaksi::create([

            'no_bill' => $request->no_bill,

            'user_id' => auth()->id(),

            'hotel_id' => $request->hotel_id,

            'data_spa_id' => $request->data_spa_id,

            'tanggal_transaksi' => $request->tanggal_transaksi,

            'menit' => $spa->durasi,

            'jam' => $spa->durasi / 60,

            'total_harga' => $spa->harga,
        ]);

        return redirect('/transaksi')
            ->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $hotels = Hotel::all();

        $spas = DataSpa::all();

        return view('transaksi.edit', compact(
            'transaksi',
            'hotels',
            'spas'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_bill' => 'required',
            'hotel_id' => 'required',
            'data_spa_id' => 'required',
            'tanggal_transaksi' => 'required',
        ]);

        $spa = DataSpa::findOrFail(
            $request->data_spa_id
        );

        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([

            'no_bill' => $request->no_bill,

            'user_id' => auth()->id(),

            'hotel_id' => $request->hotel_id,

            'data_spa_id' => $request->data_spa_id,

            'tanggal_transaksi' => $request->tanggal_transaksi,

            // otomatis ambil dari data spa
            'menit' => $spa->durasi,

            'jam' => $spa->durasi / 60,

            'total_harga' => $spa->harga,
        ]);

        return redirect('/transaksi')
            ->with(
                'success',
                'Data berhasil diupdate'
            );
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->delete();

        return redirect('/transaksi')
            ->with(
                'success',
                'Data berhasil dihapus'
            );
    }
}
