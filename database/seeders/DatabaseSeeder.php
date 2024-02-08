<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => 'admin1234',
        ]);

        foreach (["A", "B", "C", "D"] as $kode) {
            for ($i = 1; $i <= 6; $i++) {
                \App\Models\slot::create([
                    "kode" => $kode,
                    "baris" => $i,
                ]);
            }
        }

        foreach (["2", "6", "12"] as $jam) {
            \App\Models\waktu::create([
                "durasi" => $jam,
                "biaya" => 2000 * $jam,
            ]);
        }

        \App\Models\Booking::factory(1000)->create();
    }
}
