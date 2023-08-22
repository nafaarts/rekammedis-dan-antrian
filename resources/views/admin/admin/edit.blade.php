@extends('layouts.admin')

@section('title', 'Edit Admin')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Admin</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card">
        <div class="card-body pt-3">
            <form action="{{ route('admin.update', $user) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <x-input-label for="nama" value="Nama" />
                            <x-text-input id="nama" type="text" name="nama" :value="old('nama', $user->nama)"
                                placeholder="Masukan nama lengkap" autofocus required />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" type="text" name="email" :value="old('email', $user->email)"
                                placeholder="Masukan email" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="no_telp" value="Nomor Telepon" />
                            <x-text-input id="no_telp" type="text" name="no_telp" :value="old('no_telp', $user->no_telp)"
                                placeholder="Masukan nomor telepon" />
                            <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="password" value="Password" />
                            <x-text-input id="password" type="password" name="password" :value="old('password')"
                                placeholder="Masukan password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            <small class="text-muted">Kosongkan jika tidak ganti</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="password_confirmation" value="Ulangi Password" />
                            <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                                :value="old('password_confirmation')" placeholder="Masukan password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-end mt-4">
                    <a href="{{ route('admin.index') }}" class="btn btn-secondary me-2">
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
