<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WaktuResource\Pages;
use App\Filament\Resources\WaktuResource\RelationManagers;
use App\Models\Waktu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WaktuResource extends Resource
{
    protected static ?string $model = Waktu::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $pluralLabel = 'Biaya';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('durasi')
                    ->suffix("Jam")
                    ->required()
                    ->numeric()
                    ->maxValue(24)
                    ->minValue(1),
                Forms\Components\TextInput::make('biaya')
                    ->label("Harga")
                    ->prefix("Rp")
                    ->required()
                    ->minValue(0)
                    ->step(1000)
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('durasi')
                    ->suffix(" Jam")
                    ->searchable(),
                Tables\Columns\TextColumn::make('biaya')
                    ->label("Harga")
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageWaktus::route('/'),
        ];
    }
}
