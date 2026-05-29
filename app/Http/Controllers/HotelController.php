<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::latest()->get();

        return view('hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('hotels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_hotel' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        Hotel::create($request->all());

        return redirect('/hotels')
            ->with('success', 'Hotel berhasil ditambahkan');
    }

    public function edit(Hotel $hotel)
    {
        return view('hotels.edit', compact('hotel'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'nama_hotel' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        $hotel->update([
            'nama_hotel' => $request->nama_hotel,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        return redirect('/hotels')
            ->with('success', 'Hotel berhasil diupdate');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return redirect('/hotels')->with('success', 'Hotel berhasil dihapus');
    }
}
