<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    public function index()
    {
        $adminPoli = auth()->user()->adminPoli;

        $antrian = Antrian::where('poli_id', $adminPoli->poli_id)
            ->where('status_antrian', 0)
            ->orWhereHas('kunjungan', function ($query) {
                return $query->where('status_kunjungan', 0);
            })
            ->orderBy('nomor_antrian', 'ASC')
            ->orderBy('status_antrian', 'ASC')
            ->paginate();

        return view('admin.antrian.index', compact('antrian'));
    }

    public function togglePemanggilan(Antrian $antrian)
    {
        $antrian->update([
            'status_antrian' => !$antrian->status_antrian
        ]);

        return back()->with('success', 'Status antrian berhasil diubah');
    }

    public function reset()
    {
        Antrian::truncate();
        return back()->with('success', 'Antrian berhasil direset!');
    }
}
