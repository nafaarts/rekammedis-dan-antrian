<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $poli = Poli::when(request('search'), function ($query) {
            return $query->where('nama', 'like', '%' . request('search') . '%');
        })->latest()->paginate();

        return view('admin.poli.index', compact('poli'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.poli.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'catatan' => 'nullable'
        ]);

        Poli::create($validated);

        return redirect()->route('poli.index')->with('success', 'Poli berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Poli $poli)
    // {
    //     return view('admin.poli.edit', compact('poli'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poli $poli)
    {
        return view('admin.poli.edit', compact('poli'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poli $poli)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'catatan' => 'nullable'
        ]);

        $poli->update($validated);

        return redirect()->route('poli.index')->with('success', 'Poli berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poli $poli)
    {
        $poli->delete();

        return redirect()->route('poli.index')->with('success', 'Poli berhasil dihapus!');
    }
}
