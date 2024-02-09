<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Slot extends Model
{
    use HasFactory;

    protected $appends = ["used"];

    public function booking(): HasMany
    {
        return $this->hasMany(\App\Models\Booking::class);
    }

    public function getUsedAttribute()
    {
        return $this->whereHas("booking", function (Builder $query) {
            $query->where('lunas', true)->where('cekout', '!=', null);
        })->get()->isNotEmpty();
    }
}
