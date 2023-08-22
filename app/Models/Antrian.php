<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $table = 'antrian';

    protected $fillable = [
        'kunjungan_id',
        'poli_id',
        'nomor_antrian',
        'status_antrian',
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }
}
