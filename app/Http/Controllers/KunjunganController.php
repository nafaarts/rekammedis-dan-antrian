<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index()
    {
        $adminPoli = auth()->user()->adminPoli;

        $kunjungan = Kunjungan::when(request('search'), function ($query) {
            return $query->whereHas('pasien', function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->where('nama', 'like', '%' . request('search') . '%')
                        ->orWhere('email', 'like', '%' . request('search') . '%')
                        ->orWhere('no_telp', 'like', '%' . request('search') . '%');
                });
            })
                ->orWhere('kode_kunjungan', 'like', '%' . request('search') . '%');
        });

        if ($adminPoli) {
            $kunjungan = $kunjungan->where('poli_id', $adminPoli->poli_id);
        }

        $kunjungan = $kunjungan->latest()->orderBy('status_kunjungan');

        $kunjungan = $kunjungan->paginate();



        return view('admin.kunjungan.index', compact('kunjungan'));
    }

    public function detail(Kunjungan $kunjungan)
    {
        return view('admin.kunjungan.detail', compact('kunjungan'));
    }
}
