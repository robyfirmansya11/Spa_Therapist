<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\Hotel;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    /**
     * Halaman daftar laporan
     */
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        $query = Transaksi::with(['user', 'hotel', 'dataSpa'])
            ->whereMonth('tanggal_transaksi', $bulan)
            ->whereYear('tanggal_transaksi', $tahun);

        // filter hotel jika dipilih
        if ($request->hotel_id) {
            $query->where('hotel_id', $request->hotel_id);
        }

        $transaksis = $query
            ->orderBy('tanggal_transaksi')
            ->orderBy('no_bill')
            ->get();

        /**
         * Group per tanggal
         */
        $grouped = $transaksis->groupBy(function ($item) {
            return date('Y-m-d', strtotime($item->tanggal_transaksi));
        });

        /**
         * Total keseluruhan
         */
        $totalMenit = $transaksis->sum('menit');
        $totalJam = $transaksis->sum('jam');
        $totalRevenue = $transaksis->sum('total_harga');

        /**
         * Data hotel untuk filter
         */
        $hotels = Hotel::orderBy('nama_hotel')->get();

        return view('laporan.index', compact(
            'grouped',
            'totalMenit',
            'totalJam',
            'totalRevenue',
            'bulan',
            'tahun',
            'hotels'
        ));
    }

    /**
     * Form filter laporan
     */
    public function create()
    {
        $hotels = Hotel::orderBy('nama_hotel')->get();

        return view('laporan.create', compact('hotels'));
    }

    /**
     * Detail laporan
     */
    public function show($bulan, $tahun)
    {
        $transaksis = Transaksi::with(['user', 'hotel', 'dataSpa'])
            ->whereMonth('tanggal_transaksi', $bulan)
            ->whereYear('tanggal_transaksi', $tahun)
            ->orderBy('tanggal_transaksi')
            ->get();

        $grouped = $transaksis->groupBy(function ($item) {
            return date('Y-m-d', strtotime($item->tanggal_transaksi));
        });

        $totalMenit = $transaksis->sum('menit');
        $totalJam = $transaksis->sum('jam');
        $totalRevenue = $transaksis->sum('total_harga');

        return view('laporan.show', compact(
            'grouped',
            'bulan',
            'tahun',
            'totalMenit',
            'totalJam',
            'totalRevenue'
        ));
    }

    /**
     * Export Excel
     */
    public function exportExcel(Request $request)
    {
        return Excel::download(new LaporanExport($request->bulan, $request->tahun), 'laporan-spa.xlsx');
    }

    /**
     * Export PDF
     */
    public function exportPdf(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $query = Transaksi::with(['user', 'hotel', 'dataSpa'])
            ->whereMonth('tanggal_transaksi', $bulan)
            ->whereYear('tanggal_transaksi', $tahun);

        if ($request->hotel_id) {
            $query->where('hotel_id', $request->hotel_id);
        }

        $transaksis = $query->get();

        $grouped = $transaksis->groupBy('tanggal_transaksi');

        $totalRevenue = $transaksis->sum('total_harga');
        $totalMenit = $transaksis->sum('menit');
        $totalJam = $transaksis->sum('jam');

        $pdf = Pdf::loadView('laporan.pdf', compact(
            'grouped',
            'bulan',
            'tahun',
            'totalRevenue',
            'totalMenit',
            'totalJam'
        ));

        return $pdf->stream('laporan-spa.pdf');
    }
}
