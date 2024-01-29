<?php

use App\Models\slot;
use App\Models\waktu;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string("ds");
            $table->enum("jenis",["motor","mobil","truk"]);
            $table->string("kode");
            $table->foreignIdFor(waktu::class)->nullable()->constrained()->nullOnDelete();
            $table->boolean("lunas");
            $table->boolean("selesai");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
