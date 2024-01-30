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
            $table->foreignIdFor(slot::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(waktu::class)->nullable()->constrained()->nullOnDelete();
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
