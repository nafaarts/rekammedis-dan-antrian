<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\Pasien;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PendaftaranPasienController extends Controller
{
    public function formulir()
    {
        $pasien = Pasien::where('user_id', auth()->id())->first();
        return view('pendaftaran.formulir', compact('pasien'));
    }

    public function storeFormulir(Request $request)
    {
        $pasien = Pasien::where('user_id', auth()->id())->first();

        $request->validate([
            'nik' => ['required', 'numeric', Rule::unique(Pasien::class)->ignore($pasien)],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'jenis_kelamin' => ['required'],
            'agama' => ['required'],
            'pekerjaan' => 'nullable',
            'status_perkawinan' => ['required'],
            'alamat' => ['required'],
            'nama_keluarga_terdekat' => ['required'],
            'no_telp_keluarga_terdekat' => ['required', 'numeric'],
        ]);

        $nomorpasien = time() . str_pad(Pasien::count() + 1, 5, "0", STR_PAD_LEFT); // generate nomor pasien

        Pasien::updateOrCreate([
            'user_id' => auth()->id(),
        ], [
            'no_pasien' => $nomorpasien,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'status_perkawinan' => $request->status_perkawinan,
            'alamat' => $request->alamat,
            'nama_keluarga_terdekat' => $request->nama_keluarga_terdekat,
            'no_telp_keluarga_terdekat' => $request->no_telp_keluarga_terdekat,
        ]);

        return redirect()->route('pendaftaran.riwayat-penyakit')->with('success', 'Data diri anda berhasil diinput, silakan isi riwayat penyakit anda jika ada!');
    }

    public function riwayatPenyakit()
    {
        $pasien = Pasien::where('user_id', auth()->id())->first();

        if (!$pasien) {
            return redirect()->route('beranda')->with('error', 'Silahkan lanjutkan sebagai pasien baru');
        }

        $riwayatPenyakit = $pasien?->riwayatPenyakit;

        return view('pendaftaran.riwayat-penyakit', compact('riwayatPenyakit'));
    }

    public function storeRiwayatPenyakit(Request $request)
    {
        $pasien = Pasien::where('user_id', auth()->id())->first();

        $validated = $request->validate([
            'riwayat_penyakit' => ['nullable'],
            'riwayat_alergi' => ['nullable'],
            'riwayat_obat' => ['nullable'],
        ]);

        $pasien->riwayatPenyakit()->updateOrCreate([
            'pasien_id' => $pasien->id
        ], $validated);

        return redirect()->route('pendaftaran.jadwal-kunjungan')->with('success', 'Riwayat penyakit anda berhasil diinput, silakan buat jadwal kunjungan anda.');
    }

    public function jadwalKunjungan()
    {
        $poli = Poli::all();
        return view('pendaftaran.jadwal-kunjungan', compact('poli'));
    }

    public function storeJadwalKunjungan(Request $request)
    {
        $pasien = Pasien::where('user_id', auth()->id())->first();

        $request->validate([
            'tanggal_kunjungan' => 'required',
            'poli_tujuan' => 'required',
            'keluhan' => 'required',
            'nomor_asuransi' => ['nullable'],
            'nomor_rujukan' => ['nullable'],
            'tanggal_rujukan' => ['nullable'],
        ]);

        $kodeKunjungan = time() . str_pad(Kunjungan::count() + 1, 5, "0", STR_PAD_LEFT);

        Kunjungan::create([
            'pasien_id' => $pasien->id,
            'poli_id' => $request->poli_tujuan,
            'kode_kunjungan' => $kodeKunjungan,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'keluhan' => $request->keluhan,
            'asuransi' => $request->nomor_asuransi != null ? 'BPJS' : null,
            'nomor_asuransi' => $request->nomor_asuransi ?? null,
            'nomor_rujukan' => $request->nomor_rujukan ?? null,
            'tanggal_rujukan' => $request->tanggal_rujukan ?? null,
        ]);

        return redirect()->route('pendaftaran.bukti')->with('success', 'Pendaftaran pasien berhasil dibuat');
    }

    public function bukti()
    {
        $pasien = Pasien::where('user_id', auth()->id())->first();
        $bukti = Kunjungan::where('pasien_id', $pasien->id)->latest()->first();
        $qrcode = $bukti ? QrCode::size(180)->generate($bukti?->kode_kunjungan) : null;

        return view('pendaftaran.bukti', compact('bukti', 'qrcode'));
    }
}
