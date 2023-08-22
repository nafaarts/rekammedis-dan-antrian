<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';

    protected $fillable = [
        'poli_id',
        'nama',
        'spesialis',
        'nip',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'no_telp',
        'alamat',
    ];

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }
}
