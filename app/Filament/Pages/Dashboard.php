<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected function getHeaderActions(): array
    {
        return [
            Action::make('scan_cekin')->url(route('scan', ['cekin']))->openUrlInNewTab(),
            Action::make('scan_cekout')->url(route('scan', ['cekout']))->openUrlInNewTab(),
        ];
    }
}
