<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    public function index()
    {
        $adminPoli = auth()->user()->adminPoli;

        $antrian = Antrian::orderBy('status_antrian', 'ASC')->orderBy('nomor_antrian', 'ASC');
        if ($adminPoli) {
            $antrian = $antrian->where('poli_id', $adminPoli->poli_id);
        }
        $antrian = $antrian->paginate();

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
