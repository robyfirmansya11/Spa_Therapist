<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSpa extends Model
{
    protected $fillable = [
        'nama_spa',
        'harga',
        'durasi',
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
