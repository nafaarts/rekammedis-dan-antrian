<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = User::where('hak_akses', 'ADMIN')->latest()->paginate();
        return view('admin.admin.index', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required'],
            'email' => ['required', 'email'],
            'no_telp' => ['required', 'numeric'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $validated['password'] = bcrypt($request->password);
        $validated['hak_akses'] = 'ADMIN';

        User::create($validated);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(User $user)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nama' => ['required'],
            'email' => ['required', 'email'],
            'no_telp' => ['required', 'numeric'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        if ($validated['password']) {
            $validated['password'] = bcrypt($request->password);
        } else {
            $validated['password'] = $user->password;
        }

        $user->update($validated);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus!');
    }
}
