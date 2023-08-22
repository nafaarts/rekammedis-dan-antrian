<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class BuatAntrianController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'nomor_pendaftaran' => 'required',
        ]);
        $kunjungan = Kunjungan::where('kode_kunjungan', $request->nomor_pendaftaran)->first();

        $error = false;
        if (!$kunjungan) {
            $error = true;
            $errorMessage = 'Nomor pendaftaran tidak tersedia!';
        }

        if ($kunjungan->status_kunjungan) {
            $error = true;
            $errorMessage = 'Anda sudah melakukan pengunjungan!';
        }

        if ($kunjungan->antrian) {
            $error = true;
            $errorMessage = 'Anda sudah memiliki nomor antrian, silahkan cek nomor antrian anda!';
        }

        if ($error) {
            return back()->with('error', $errorMessage);
        }

        $antrian = Antrian::where('poli_id', $kunjungan->poli_id)->count();

        // buat nomor antrian
        $nomorAntrian = str_pad($antrian + 1, 4, '0', STR_PAD_LEFT);

        $kunjungan->antrian()->create([
            'poli_id' => $kunjungan->poli_id,
            'nomor_antrian' => $nomorAntrian
        ]);

        return back()->with('success', 'Nomor Antrian anda berhasil dibuat dipoli ' . $kunjungan->poli->nama . ' dengan nomor antrian ' . $nomorAntrian);
    }
}
