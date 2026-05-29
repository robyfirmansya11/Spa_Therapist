<?php

namespace App\Http\Controllers;

use App\Models\DataSpa;
use Illuminate\Http\Request;

class DataSpaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSpas = DataSpa::latest()->get();

        return view('data-spas.index', compact('dataSpas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-spas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_spa' => 'required',
            'harga' => 'required|numeric',
            'durasi' => 'required|numeric',
        ]);

        DataSpa::create($request->all());

        return redirect('/data-spas')
            ->with('success', 'Spa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataSpa $dataSpa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataSpa $dataSpa)
    {
        return view('data-spas.edit', compact('dataSpa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataSpa $dataSpa)
    {
        $request->validate([
            'nama_spa' => 'required',
            'harga' => 'required|numeric',
            'durasi' => 'required|numeric',
        ]);

        $dataSpa->update([
            'nama_spa' => $request->nama_spa,
            'harga' => $request->harga,
            'durasi' => $request->durasi,
        ]);

        return redirect('/data-spas')
            ->with('success', 'Spa berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataSpa $dataSpa)
    {
        $dataSpa->delete();

        return redirect('/data-spas')->with('success', 'Spa berhasil dihapus');
    }
}
