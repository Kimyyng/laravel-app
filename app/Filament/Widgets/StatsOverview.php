<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make(
                'Total Pendapatan',
                'Rp. ' . number_format(Booking::whereMonth('cekout', now()->month)
                    ->sum('total'))
            )->description('/bulan'),

            Stat::make(
                'Pendapatan Sekarang',
                'Rp. ' . number_format(Booking::whereDate('cekout', now())
                    ->sum('total'))
            )->description('/hari'),

            Stat::make(
                'Total Pengunjung',
                number_format(Booking::whereDate('cekin', today())
                    ->count())
            )->description('/hari'),
        ];
    }
}
