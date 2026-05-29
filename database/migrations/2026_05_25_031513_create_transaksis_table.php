<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {

            $table->id();

            $table->string('no_bill');

            $table->string('nama_pelanggan');

            $table->foreignId('hotel_id')
                ->constrained('hotels')
                ->onDelete('cascade');

            $table->foreignId('data_spa_id')
                ->constrained('data_spas')
                ->onDelete('cascade');

            $table->date('tanggal_transaksi');

            $table->integer('menit');

            $table->decimal('jam', 5, 2);

            $table->decimal('total_harga', 12, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
