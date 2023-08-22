<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';

    protected $fillable = [
        'user_id',
        'no_pasien',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'status_perkawinan',
        'alamat',
        'nama_keluarga_terdekat',
        'no_telp_keluarga_terdekat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function riwayatPenyakit()
    {
        return $this->hasOne(RiwayatPenyakit::class);
    }

    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class);
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class);
    }
}
