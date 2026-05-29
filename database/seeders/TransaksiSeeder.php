<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $hotelIds = [1]; // sesuaikan dengan id hotel
        $userIds = [1, 2]; // therapist/user
        $spaIds = [1, 2, 3]; // data spa

        $services = [
            [
                'menit' => 60,
                'jam' => 1,
                'harga' => 250000,
            ],
            [
                'menit' => 90,
                'jam' => 1.5,
                'harga' => 350000,
            ],
            [
                'menit' => 120,
                'jam' => 2,
                'harga' => 500000,
            ],
        ];

        // 3 bulan ke belakang
        for ($month = 0; $month < 3; $month++) {

            $date = Carbon::now()->subMonths($month);

            $daysInMonth = $date->daysInMonth;

            // loop setiap hari
            for ($day = 1; $day <= $daysInMonth; $day++) {

                // random transaksi per hari
                $totalTransaksi = rand(2, 6);

                for ($i = 1; $i <= $totalTransaksi; $i++) {

                    $service = $services[array_rand($services)];

                    $tanggal = Carbon::create(
                        $date->year,
                        $date->month,
                        $day
                    );

                    Transaksi::create([
                        'no_bill' => 'BILL-'.
                            $tanggal->format('Ymd').
                            '-'.
                            rand(100, 999),

                        'hotel_id' => $hotelIds[array_rand($hotelIds)],

                        'user_id' => $userIds[array_rand($userIds)],

                        'data_spa_id' => $spaIds[array_rand($spaIds)],

                        'tanggal_transaksi' => $tanggal,

                        'menit' => $service['menit'],

                        'jam' => $service['jam'],

                        'total_harga' => $service['harga'],
                    ]);
                }
            }
        }
    }
}
