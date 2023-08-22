<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPoli extends Model
{
    use HasFactory;

    protected $table = 'admin_poli';

    protected $fillable = [
        'user_id',
        'poli_id',
        'nip',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }
}
