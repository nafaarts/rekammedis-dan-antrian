@extends('layouts.admin')

@section('title', 'Edit Poli')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('poli.index') }}">Poli</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card">
        <div class="card-body pt-3">
            <form action="{{ route('poli.update', $poli) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <x-input-label for="nama" value="Nama Poli" />
                    <x-text-input id="nama" type="text" name="nama" :value="old('nama', $poli->nama)"
                        placeholder="Masukan nama poli" autofocus required />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <x-input-label for="catatan" value="Catatan" />
                    <x-text-input id="catatan" type="text" name="catatan" :value="old('catatan', $poli->catatan)"
                        placeholder="Masukan catatan (jika ada)" />
                    <x-input-error :messages="$errors->get('catatan')" class="mt-2" />
                </div>

                <div class="d-flex align-items-center justify-content-end mt-4">
                    <a href="{{ route('poli.index') }}" class="btn btn-secondary me-2">
                        Batal
                    </a>
                    <x-primary-button type="submit">
                        Simpan
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
@endsection
