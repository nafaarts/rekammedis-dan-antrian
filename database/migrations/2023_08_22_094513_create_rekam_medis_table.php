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
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasien')->cascadeOnDelete();
            $table->foreignId('dokter_id')->nullable()->constrained('dokter')->nullOnDelete();
            $table->foreignId('poli_id')->nullable()->constrained('poli')->nullOnDelete();
            $table->foreignId('kunjungan_id')->nullable()->constrained('kunjungan')->nullOnDelete();
            $table->date('tanggal_pemeriksaan');
            $table->string('diagnosa')->nullable();
            $table->string('penanganan')->nullable();
            $table->string('resep_obat')->nullable();
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
