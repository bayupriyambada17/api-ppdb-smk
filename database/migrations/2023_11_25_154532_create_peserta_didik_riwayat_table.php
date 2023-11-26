<?php

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
        Schema::create('peserta_didik_riwayat', function (Blueprint $table) {
            $table->id();
            $table->foreignId("peserta_didik_id")->nullable()->constrained("peserta_didik")->cascadeOnDelete();
            $table->string('tinggi_badan')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('penyakit_di_derita')->nullable();
            $table->string('penyakit_menular')->nullable();
            $table->foreignId("golongan_darah_id")->nullable()->constrained("golongan_darah")->cascadeOnDelete();
            $table->boolean('perokok')->nullable(); // 0 = false, 1 = true
            $table->boolean('buta_warna')->nullable(); // 0 = false, 1 = true
            $table->boolean('asuransi_bpjs_kis')->nullable(); // 0 = false, 1 = true
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_didik_riwayat');
    }
};
