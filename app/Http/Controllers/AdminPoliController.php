<?php

namespace App\Http\Controllers;

use App\Models\AdminPoli;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Poli $poli)
    {
        $admin = $poli->admin()->latest()->paginate();
        return view('admin.admin-poli.index', compact('admin', 'poli'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Poli $poli)
    {
        return view('admin.admin-poli.create', compact('poli'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Poli $poli)
    {
        $request->validate([
            'nama' => ['required'],
            'email' => ['required'],
            'no_telp' => ['required', 'numeric'],
            'nip' => ['nullable', 'numeric'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' =>  ['required'],
            'jenis_kelamin' => ['required'],
            'agama' => ['required'],
            'alamat' => ['required', 'max:255'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // buat user
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'password' => bcrypt($request->password),
            'hak_akses' => 'ADMIN_POLI',
        ]);

        AdminPoli::create([
            'user_id' => $user->id,
            'poli_id' => $poli->id,
            'nip' => $request->nip,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('poli.admin-poli.index', $poli)->with('success', 'Admin poli berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Poli $poli, AdminPoli $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poli $poli, AdminPoli $admin)
    {
        return view('admin.admin-poli.edit', compact('poli', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poli $poli, AdminPoli $admin)
    {
        $request->validate([
            'nama' => ['required'],
            'email' => ['required'],
            'no_telp' => ['required', 'numeric'],
            'nip' => ['nullable', 'numeric'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' =>  ['required'],
            'jenis_kelamin' => ['required'],
            'agama' => ['required'],
            'alamat' => ['required', 'max:255'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        if ($request->password) {
            $password = bcrypt($request->password);
        } else {
            $password = $admin->user->password;
        }

        // buat user
        $admin->user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'password' => $password
        ]);

        $admin->update([
            'nip' => $request->nip,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('poli.admin-poli.index', $poli)->with('success', 'Admin poli berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poli $poli, AdminPoli $admin)
    {
        $admin->user->delete();
        $admin->delete();

        return redirect()->route('poli.admin-poli.index', $poli)->with('success', 'Admin poli berhasil dihapus!');
    }
}
