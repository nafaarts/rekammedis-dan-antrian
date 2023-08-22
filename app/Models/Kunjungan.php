<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $table = 'kunjungan';

    protected $fillable = [
        'pasien_id',
        'poli_id',
        'kode_kunjungan',
        'tanggal_kunjungan',
        'asuransi',
        'nomor_asuransi',
        'nomor_rujukan',
        'tanggal_rujukan',
        'keluhan',
        'status_kunjungan',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    public function rekamMedis()
    {
        return $this->hasOne(RekamMedis::class);
    }

    public function antrian()
    {
        return $this->hasOne(Antrian::class);
    }
}
