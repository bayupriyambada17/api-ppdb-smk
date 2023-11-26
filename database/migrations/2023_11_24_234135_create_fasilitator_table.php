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
        Schema::create('peserta_didik_fasilitator', function (Blueprint $table) {
            $table->id();
            $table->foreignId("peserta_didik_id")->constrained("peserta_didik")->cascadeOnDelete();
            $table->string('nama_fasilitator')->nullable();
            $table->string('hubungan_calon_siswa_fasilitator')->nullable();
            $table->string('no_whatsapp_fasilitator')->nullable();
            $table->string('email_fasilitator')->nullable();
            $table->foreignId("informasi_ppdb_id")->nullable()->constrained("informasi_ppdb")->cascadeOnDelete();
            $table->boolean('saudara_beasiswa_di_smk_fasilitator')->default(0)->nullable(); // 0 = tidak, 1= ya
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitator');
    }
};
