<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;

class Booking extends Model
{
    use HasFactory;
    use HasUuids;

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }

    public function uniqueIds(): array
    {
        return ['kode_booking'];
    }

    protected function ds(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtoupper($value)
        );
    }

    public function getDendaAttribute()
    {
        // $waktu = $this->created_at + $this->with('waktu')->waktu()->durasi;

        // if ($waktu < time()) {
        //     return 2000;
        // }
        return 0;
    }

    public function slot(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Slot::class);
    }

    public function waktu(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Waktu::class);
    }
}
