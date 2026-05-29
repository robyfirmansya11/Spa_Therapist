<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanExport implements FromCollection
{
    protected $bulan;

    protected $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        return Transaksi::whereMonth('tanggal_transaksi', $this->bulan)
            ->whereYear('tanggal_transaksi', $this->tahun)
            ->get();
    }
}
