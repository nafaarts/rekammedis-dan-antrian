<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $table = 'poli';

    protected $fillable = [
        'nama', 'catatan'
    ];

    public function dokter()
    {
        return $this->hasMany(Dokter::class);
    }

    public function admin()
    {
        return $this->hasMany(AdminPoli::class);
    }

    public function antrian()
    {
        return $this->hasMany(Antrian::class);
    }
}
