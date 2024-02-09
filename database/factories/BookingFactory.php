<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ds = strtoupper('F ' . rand(1000, 9999) . fake()->randomElement(
            [
                ' Q' . fake()->randomLetter(),
                ' U' . fake()->randomLetter() . fake()->randomLetter(),
                ' V' . fake()->randomLetter(),
            ]
        ));

        $slot = \App\Models\Slot::all()->random();
        $waktu = \App\Models\Waktu::all()->random();

        $date = Carbon::parse(fake()->dateTimeThisYear(now()->subDays(2)));

        $cekin = $date;
        $batasWaktu = $date->addHours($waktu->durasi);
        $cekout = $date->addHours(rand(2, 4));

        if ($date->diffInHours($cekout) > $waktu->durasi)
            $denda = $batasWaktu->diffInHours($cekout) * 2000;
        else
            $denda = 0;

        return [
            'ds' => $ds,
            'jenis' => fake()->randomElement(['motor', 'mobil', 'truk']),
            'slot_id' => $slot->id,
            'waktu_id' => $waktu->id,
            'pembayaran' => fake()->randomElement(['ID_DANA', 'ID_LINKAJA', 'CASH']),
            'lunas' => true,
            'cekin' => $cekin,
            'cekout' => $cekout,
            'total' => $waktu->biaya + $denda,
            'created_at' => $cekin,
            'updated_at' => $cekout,
        ];
    }
}
