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
        Schema::create('peserta_didik_rapor', function (Blueprint $table) {
            $table->id();
            $table->foreignId("peserta_didik_id")->nullable()->constrained("peserta_didik")->cascadeOnDelete();
            $table->integer('rapor_matematika_3')->nullable();
            $table->integer('rapor_matematika_4')->nullable();
            $table->integer('rapor_matematika_5')->nullable();
            $table->integer('rapor_ipa_3')->nullable();
            $table->integer('rapor_ipa_4')->nullable();
            $table->integer('rapor_ipa_5')->nullable();
            $table->integer('rapor_indo_3')->nullable();
            $table->integer('rapor_indo_4')->nullable();
            $table->integer('rapor_indo_5')->nullable();
            $table->integer('rapor_inggris_3')->nullable();
            $table->integer('rapor_inggris_4')->nullable();
            $table->integer('rapor_inggris_5')->nullable();
            $table->integer('rapor_islam_3')->nullable();
            $table->integer('rapor_islam_4')->nullable();
            $table->integer('rapor_islam_5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_rapor');
    }
};
