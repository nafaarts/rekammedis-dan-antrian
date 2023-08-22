<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokter = Dokter::when(request('search'), function ($query) {
            return $query->where('nama', 'like', '%' . request('search') . '%')
                ->orWhere('spesialis', 'like', '%' . request('search') . '%')
                ->orWhere('nip', 'like', '%' . request('search') . '%')
                ->orWhere('no_telp', 'like', '%' . request('search') . '%');
        })->latest()->paginate();

        return view('admin.dokter.index', compact('dokter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $poli = Poli::all();
        return view('admin.dokter.create', compact('poli'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'poli_id' => 'required',
            'nama' => 'required',
            'spesialis' => 'required',
            'nip' => 'required|numeric',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'no_telp' => 'nullable',
            'alamat' => 'nullable',
        ]);

        Dokter::create($validated);

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dokter $dokter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokter $dokter)
    {
        $poli = Poli::all();
        return view('admin.dokter.edit', compact('dokter', 'poli'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokter $dokter)
    {
        $validated = $request->validate([
            'poli_id' => 'required',
            'nama' => 'required',
            'spesialis' => 'required',
            'nip' => 'required|numeric',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'no_telp' => 'nullable',
            'alamat' => 'nullable',
        ]);

        $dokter->update($validated);

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil dihapus!');
    }
}
