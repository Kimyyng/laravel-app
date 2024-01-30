<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    public function slot(): BelongsTo
    {
        return $this->belongsTo(\App\Models\slot::class);
    }

    public function waktu(): BelongsTo
    {
        return $this->belongsTo(\App\Models\waktu::class);
    }
}
