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
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('no_pasien');
            $table->string('nik')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->default('L');
            $table->string('agama')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nama_keluarga_terdekat')->nullable();
            $table->string('no_telp_keluarga_terdekat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
