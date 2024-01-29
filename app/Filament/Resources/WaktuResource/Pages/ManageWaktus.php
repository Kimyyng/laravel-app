<?php

namespace App\Filament\Resources\WaktuResource\Pages;

use App\Filament\Resources\WaktuResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageWaktus extends ManageRecords
{
    protected static string $resource = WaktuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
