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
        Schema::create('peserta_didik', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pendaftar')->unique();
            $table->foreignId("tahun_pelajaran_id")->nullable()->constrained("tahun_pelajaran")->cascadeOnDelete();
            $table->string('nama_lengkap')->nullable()->unique();
            $table->string('nisn')->nullable()->unique();
            $table->string('nik')->nullable()->unique();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota_kabupaten')->nullable();
            $table->string('no_whatsapp_telp')->nullable();
            $table->string('sosial_media')->nullable();
            $table->string('smp_derajat')->nullable();
            $table->string('npsn')->nullable();
            $table->foreignId("tahun_lulus_id")->nullable()->constrained("tahun_lulus")->cascadeOnDelete();
            $table->string('anak_ke_sodara')->nullable();
            $table->foreignId("keadaan_orang_tua_id")->nullable()->constrained("keadaan_orang_tua")->cascadeOnDelete();
            $table->foreignId("status_dalam_keluarga_id")->nullable()->constrained("status_dalam_keluarga")->cascadeOnDelete();
            $table->foreignId("tinggal_bersama_status_id")->nullable()->constrained("tinggal_bersama_status")->cascadeOnDelete();
            $table->foreignId("penerimaan_bantuan_sosial_id")->nullable()->constrained("penerimaan_bantuan_sosial")->cascadeOnDelete();
            // rapor
            $table->string('bahasa_asing')->nullable();
            $table->string('jumlah_hafalan_juz')->nullable();
            $table->string('hafalan_juz')->nullable();
            $table->string('riwayat_prestasi_calon_peserta_didik')->nullable();
            $table->string('riwayat_organisasi_sekolah_dan_non_sekolah')->nullable();
            $table->string('hal_hal_khusus')->nullable();
            $table->string('cita_cita')->nullable();
            $table->string('hobi_kegemaran')->nullable();
            $table->string('nama_ayah_kandung')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('pekerjaan_ayah_kandung')->nullable();
            $table->string('penghasilan_pokok_pensiunan_ayah')->nullable();
            $table->string('pendapatan_diluar_penghasilan_perbulan_ayah')->nullable();
            $table->string('domisili_ayah_kandung')->nullable();
            $table->string('no_whatsapp_ayah_kandung')->nullable();
            $table->string('nama_ibu_kandung')->nullable();
            $table->string('pekerjaan_ibu_kandung')->nullable();
            $table->string('penghasilan_pokok_pensiunan_ibu')->nullable();
            $table->string('pendapatan_diluar_penghasilan_perbulan_ibu')->nullable();
            $table->string('domisili_ibu_kandung')->nullable();
            $table->string('no_whatsapp_ibu_kandung')->nullable();
            $table->string('harapan_orang_tua')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('alamat_domisili_wali')->nullable();
            $table->string('hubungan_wali')->nullable();
            $table->string('email_wali')->nullable();
            $table->string('jumlah_tanggungan_dalam_keluarga')->nullable();
            $table->foreignId("sumber_penghasilan_id")->nullable()->constrained("sumber_penghasilan")->cascadeOnDelete();

            //
            // fasilitator

            // fasilitas Keluarga

            // riwayat penyakit


            // upload dokumen

            $table->timestamp('tanggal_terdaftar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_didik');
    }
};
