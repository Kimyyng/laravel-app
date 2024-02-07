<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('slot_id')
                    ->relationship("slot", "kode_slot")
                    ->searchable(),
                Forms\Components\Select::make('waktu_id')
                    ->relationship("waktu")
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->durasi} Jam"),
                Forms\Components\TextInput::make('ds')
                    ->label("Nomor kendaraan / DS")
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_booking')->copyable(),
                Tables\Columns\TextColumn::make('slot.kode_slot')
                    ->numeric(),
                Tables\Columns\TextColumn::make('ds')
                    ->label("DS")
                    ->searchable(),
                Tables\Columns\TextColumn::make('waktu.durasi')
                    ->suffix(" Jam"),
                Tables\Columns\IconColumn::make('lunas')
                    ->boolean(),
                Tables\Columns\ToggleColumn::make('selesai')
                    ->disabled(fn ($record) => !$record->lunas)
                    ->beforeStateUpdated(function ($record, $state) {
                        if ($state)
                            return $record->cekout = now();

                        return null;
                    }),
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
