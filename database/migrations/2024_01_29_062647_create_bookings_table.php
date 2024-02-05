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
            $table->uuid("id")->primary();
            $table->string("ds");
            $table->enum("jenis", ["motor", "mobil", "truk"]);
            $table->foreignIdFor(Slot::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Waktu::class)->nullable()->constrained()->nullOnDelete();
            $table->string('payment_link')->nullable();
            $table->boolean("lunas")->default(false);
            $table->timestamp("cekin")->nullable();
            $table->timestamp("cekout")->nullable();
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
