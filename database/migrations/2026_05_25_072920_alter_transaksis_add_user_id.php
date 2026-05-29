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
        Schema::table('transaksis', function (Blueprint $table) {

            // hapus kolom lama jika ada
            if (Schema::hasColumn('transaksis', 'nama_therapist')) {

                $table->dropColumn('nama_therapist');

            }

            // tambah relasi therapist ke users
            $table->foreignId('user_id')
                ->after('nama_pelanggan')
                ->constrained('users')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {

            $table->dropForeign(['user_id']);

            $table->dropColumn('user_id');

            $table->string('nama_therapist')->nullable();

        });
    }
};
