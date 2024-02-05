<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Booking extends Model
{
    use HasFactory;
    use HasUuids;

    protected function ds(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtoupper($value)
        );
    }

    protected function cekin(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)
        );
    }

    protected function cekout(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)
        );
    }

    public function getSisaWaktuAttribute()
    {
        return now()->diff($this->batasWaktu)->format('%h jam, %i menit, %s detik');
    }

    public function getBatasWaktuAttribute()
    {
        return $this->created_at->addHours($this->waktu->durasi);
    }

    public function getSelesaiAttribute()
    {
        if (is_null($this->cekout))
            return false;

        return true;
    }

    public function getWaktuTambahanAttribute()
    {
        $timeSpend =  $this->created_at->diffInHours(now());

        if ($this->selesai) {
            if ($this->created_at->diffInHours($this->selesai_at) > $this->waktu->durasi)
                return $this->batasWaktu->diffInHours($this->selesai_at);
        } else {
            if ($timeSpend > $this->waktu->durasi)
                return  $timeSpend;
        }

        return 0;
    }

    public function getDendaAttribute()
    {
        return $this->waktu_tambahan * 2000;
    }

    public function getQrAttribute()
    {
        return QrCode::size(150)->generate($this->id);
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
