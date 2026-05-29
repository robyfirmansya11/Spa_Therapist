<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'nama_hotel',
        'alamat',
        'no_telp',
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
