<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';

    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'poli_id',
        'kunjungan_id',
        'tanggal_pemeriksaan',
        'diagnosa',
        'penanganan',
        'resep_obat',
        'catatan',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }
}
