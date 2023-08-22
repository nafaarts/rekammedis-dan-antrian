<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasien = Pasien::when(request('search'), function ($query) {
            return $query->whereHas('user', function ($query) {
                $query->where('nama', 'like', '%' . request('search') . '%')
                    ->orWhere('email', 'like', '%' . request('search') . '%')
                    ->orWhere('no_telp', 'like', '%' . request('search') . '%');
            })
                ->orWhere('no_pasien', 'like', '%' . request('search') . '%')
                ->orWhere('nik', 'like', '%' . request('search') . '%')
                ->orWhere('no_telp_keluarga_terdekat', 'like', '%' . request('search') . '%')
                ->orWhere('alamat', 'like', '%' . request('search') . '%')
                ->orWhere('nama_keluarga_terdekat', 'like', '%' . request('search') . '%');
        })->latest()->paginate();
        return view('admin.pasien.index', compact('pasien'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required'],
            'email' => ['required'],
            'nik' => ['required', 'numeric', 'unique:' . Pasien::class],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'jenis_kelamin' => ['required'],
            'agama' => ['required'],
            'no_telp' => ['required', 'numeric'],
            'pekerjaan' => 'nullable',
            'status_perkawinan' => ['required'],
            'alamat' => ['required'],
            'nama_keluarga_terdekat' => ['required'],
            'no_telp_keluarga_terdekat' => ['required', 'numeric'],
        ]);

        // create user
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'password' => bcrypt(str()->random(10)),
            'hak_akses' => 'PASIEN',
        ]);

        $nomorpasien = time() . str_pad(Pasien::count() + 1, 5, "0", STR_PAD_LEFT); // generate nomor pasien

        Pasien::create([
            'user_id' => $user->id,
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

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pasien $pasien)
    {
        $rekammedis = $pasien->rekamMedis()->latest()->paginate();
        return view('admin.pasien.detail', compact('pasien', 'rekammedis'));
    }

    public function detailRekamMedis(Pasien $pasien, RekamMedis $rekammedis)
    {
        return view('admin.pasien.detail-rekammedis', compact('pasien', 'rekammedis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pasien $pasien)
    {
        return view('admin.pasien.edit', compact('pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => ['required'],
            'email' => ['required'],
            'nik' => ['required', 'numeric', Rule::unique(Pasien::class)->ignore($pasien)],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'jenis_kelamin' => ['required'],
            'agama' => ['required'],
            'no_telp' => ['required', 'numeric'],
            'pekerjaan' => 'nullable',
            'status_perkawinan' => ['required'],
            'alamat' => ['required'],
            'nama_keluarga_terdekat' => ['required'],
            'no_telp_keluarga_terdekat' => ['required', 'numeric'],
        ]);

        $pasien->user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
        ]);

        $pasien->update([
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

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasien $pasien)
    {
        $user = $pasien->user;

        $user->delete();
        $pasien->delete();

        return redirect()->route('pasien.index', ['back' => 'kunjungan'])->with('success', 'Pasien berhasil dihapus!');
    }
}
