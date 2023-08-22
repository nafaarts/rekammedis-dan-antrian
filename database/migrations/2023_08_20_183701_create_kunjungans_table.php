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
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasien')->cascadeOnDelete();
            $table->foreignId('poli_id')->constrained('poli')->cascadeOnDelete();
            $table->string('kode_kunjungan')->unique();
            $table->date('tanggal_kunjungan');
            $table->string('asuransi')->nullable();
            $table->string('nomor_asuransi')->nullable();
            $table->string('nomor_rujukan')->nullable();
            $table->date('tanggal_rujukan')->nullable();
            $table->boolean('status_kunjungan')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan');
    }
};
