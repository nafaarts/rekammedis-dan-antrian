<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Kunjungan;
use App\Models\Poli;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
    public function periksa(Kunjungan $kunjungan)
    {
        $dokter = Dokter::where('poli_id', $kunjungan->poli_id)->get();
        $poli = Poli::all();
        $rekammedis = $kunjungan->rekamMedis;

        return view('admin.kunjungan.periksa', compact('kunjungan', 'dokter', 'poli', 'rekammedis'));
    }

    public function storePeriksa(Request $request, Kunjungan $kunjungan)
    {
        $request->validate([
            'dokter' => 'required',
            'tanggal_pemeriksaan' => 'required',
        ]);

        $kunjungan->rekamMedis()->updateOrCreate(
            [
                'kunjungan_id' => $kunjungan->id
            ],
            [
                'pasien_id' => $kunjungan->pasien->id,
                'dokter_id' => $request->dokter,
                'poli_id' => auth()->user()->adminPoli->poli_id ?? $request->poli,
                'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
                'diagnosa' => $request->diagnosa ?? null,
                'penanganan' => $request->penanganan ?? null,
                'resep_obat' => $request->resep_obat ?? null,
                'catatan' => $request->catatan ?? null,
            ]
        );

        $kunjungan->update([
            'status_kunjungan' => true
        ]);

        return redirect()->route('pasien.show', [$kunjungan->pasien, 'back' => 'kunjungan'])->with('success', 'Rekam medis berhasil dibuat!');
    }
}
