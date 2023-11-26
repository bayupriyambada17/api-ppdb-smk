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
        Schema::create('peserta_didik_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("peserta_didik_id")->nullable()->constrained("peserta_didik")->cascadeOnDelete();
            $table->foreignId("status_kepemilikan_rumah_id")->nullable()->constrained("status_kepemilikan_rumah")->cascadeOnDelete();
            $table->string('tahun_perolehan_status_kepemilikan')->nullable();
            $table->foreignId("kualitas_rumah_id")->nullable()->constrained("kualitas_rumah")->cascadeOnDelete();
            $table->foreignId("luas_tanah_id")->nullable()->constrained("luas_tanah")->cascadeOnDelete();
            $table->foreignId("mandi_cuci_kakus_id")->nullable()->constrained("mandi_cuci_kakus")->cascadeOnDelete();
            $table->foreignId("sumber_air_id")->nullable()->constrained("sumber_air")->cascadeOnDelete();
            $table->foreignId("daya_listrik_id")->nullable()->constrained("daya_listrik")->cascadeOnDelete();
            $table->foreignId("harta_tidak_bergerak_id")->nullable()->constrained("harta_tidak_bergerak")->cascadeOnDelete();
            $table->foreignId("status_kepemelikan_htb_id")->nullable()->constrained("status_kepemilikan_harta_tidak_bergerak")->cascadeOnDelete(); //status kepemilikan harta tidak bergerak
            $table->foreignId("kepemilikan_kendaraan_id")->nullable()->constrained("kepemilikan_kendaraan")->cascadeOnDelete();
            $table->foreignId("status_kepemilikan_kendaraan_id")->nullable()->constrained("status_kepemilikan_kendaraan")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_didik_fasilitas');
    }
};
