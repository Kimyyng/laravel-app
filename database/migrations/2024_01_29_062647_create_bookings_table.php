<?php

use App\Models\Slot;
use App\Models\Waktu;
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
            $table->foreignIdFor(Slot::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Waktu::class)->nullable()->constrained()->nullOnDelete();
            $table->boolean("lunas")->default(false);
            $table->boolean("selesai")->default(false);
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
