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
        Schema::create('peserta_didik_upload_dokumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId("peserta_didik_id")->nullable()->constrained("peserta_didik")->cascadeOnDelete();
            $table->string('kartu_keluarga')->nullable();
            $table->string('pas_foto')->nullable();
            $table->string('sktm')->nullable();
            $table->string('upload_surat_rekomendasi')->nullable();
            $table->string('upload_pdf_foto_rumah')->nullable();
            $table->string('essay_karangan')->nullable();
            $table->boolean('rangkaian_tes')->nullable(); //0 = tidak, 1 = ya
            $table->boolean('dokumen_jika_palsu')->nullable(); // 0 = tidak, 1 = ya
            $table->boolean('pelanggaran_keputusan')->nullable(); // 0 = tidak, 1 = ya
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_didik_upload_dokumen');
    }
};
