<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected function ds(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtoupper($value));
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
