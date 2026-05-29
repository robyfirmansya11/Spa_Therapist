<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'no_bill',
        'hotel_id',
        'user_id',
        'data_spa_id',
        'tanggal_transaksi',
        'menit',
        'jam',
        'total_harga',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function dataSpa()
    {
        return $this->belongsTo(DataSpa::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
