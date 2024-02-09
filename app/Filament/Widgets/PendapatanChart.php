<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class PendapatanChart extends ChartWidget
{
    protected static ?string $heading = 'Pendapatan Tahunan';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $dataSemua = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        Booking::whereYear('cekout', now()->year)
            ->selectRaw('MONTH(cekout) as bulan, SUM(total) as total_biaya')
            ->groupBy('bulan')
            ->get()
            ->each(function ($item) use (&$dataSemua) {
                $dataSemua[$item->bulan - 1] = $item->total_biaya;
            });

        $dataMotor = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        Booking::whereYear('cekout', now()->year)
            ->where('jenis', 'motor')
            ->selectRaw('MONTH(cekout) as bulan, SUM(total) as total_biaya')
            ->groupBy('bulan')
            ->get()
            ->each(function ($item) use (&$dataMotor) {
                $dataMotor[$item->bulan - 1] = $item->total_biaya;
            });

        $dataMobil = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        Booking::whereYear('cekout', now()->year)
            ->where('jenis', 'mobil')
            ->selectRaw('MONTH(cekout) as bulan, SUM(total) as total_biaya')
            ->groupBy('bulan')
            ->get()
            ->each(function ($item) use (&$dataMobil) {
                $dataMobil[$item->bulan - 1] = $item->total_biaya;
            });

        $dataTruk = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        Booking::whereYear('cekout', now()->year)
            ->where('jenis', 'truk')
            ->selectRaw('MONTH(cekout) as bulan, SUM(total) as total_biaya')
            ->groupBy('bulan')
            ->get()
            ->each(function ($item) use (&$dataTruk) {
                $dataTruk[$item->bulan - 1] = $item->total_biaya;
            });

        return [
            'datasets' => [
                [
                    'label' => 'semua',
                    'data' => $dataSemua,
                    'borderColor' => '#D04848',
                ],
                [
                    'label' => 'motor',
                    'data' => $dataMotor,
                    'borderColor' => '#F3B95F',
                ],
                [
                    'label' => 'mobil',
                    'data' => $dataMobil,
                    'borderColor' => '#00DFA2',
                ],
                [
                    'label' => 'truk',
                    'data' => $dataTruk,
                    'borderColor' => '#6895D2',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
