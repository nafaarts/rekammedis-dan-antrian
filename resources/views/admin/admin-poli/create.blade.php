@extends('layouts.admin')

@section('title', 'Tambah Admin Poli')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('poli.index') }}">Poli</a></li>
            <li class="breadcrumb-item"><a href="{{ route('poli.admin-poli.index', $poli) }}">Admin Poli
                    {{ $poli->nama }}</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card">
        <div class="card-body pt-3">
            <form action="{{ route('poli.admin-poli.store', $poli) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <x-input-label for="nama" value="Nama" />
                            <x-text-input id="nama" type="text" name="nama" :value="old('nama')"
                                placeholder="Masukan nama lengkap" autofocus required />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" type="text" name="email" :value="old('email')"
                                placeholder="Masukan email" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="nip" value="NIP" />
                            <x-text-input id="nip" type="text" name="nip" :value="old('nip')"
                                placeholder="Masukan Nomor Induk Pegawai" />
                            <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="tempat_lahir" value="Tempat Lahir" />
                            <x-text-input id="tempat_lahir" type="text" name="tempat_lahir" :value="old('tempat_lahir')"
                                placeholder="Masukan tempat lahir" required />
                            <x-input-error :messages="$errors->get('tempat_lahir')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="tanggal_lahir" value="Tanggal Lahir" />
                            <x-text-input id="tanggal_lahir" type="date" name="tanggal_lahir" :value="old('tanggal_lahir')"
                                placeholder="Masukan tanggal lahir" required />
                            <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="jenis_kelamin" value="Jenis Kelamin" />
                            <select class="form-select" name="jenis_kelamin">
                                <option @selected(old('jenis_kelamin') == '') disabled>-- pilih jenis kelamin --</option>
                                <option @selected(old('jenis_kelamin') == 'L') value="L">Laki-laki</option>
                                <option @selected(old('jenis_kelamin') == 'P') value="P">Perempuan</option>
                            </select>
                            <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="agama" value="Agama" />
                            <select class="form-select" name="agama">
                                <option @selected(old('agama') == '') disabled>-- pilih agama --</option>
                                @foreach (['Islam', 'Protestan', 'Katolik', 'Konghucu', 'Budha', 'Hindu'] as $item)
                                    <option @selected(old('agama') == $item) value="{{ $item }}">{{ $item }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('agama')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="no_telp" value="Nomor Telepon" />
                            <x-text-input id="no_telp" type="text" name="no_telp" :value="old('no_telp')"
                                placeholder="Masukan nomor telepon" />
                            <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="alamat" value="Alamat" />
                            <x-text-input id="alamat" type="text" name="alamat" :value="old('alamat')"
                                placeholder="Masukan alamat" />
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="password" value="Password" />
                            <x-text-input id="password" type="password" name="password" :value="old('password')"
                                placeholder="Masukan password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
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
                    <a href="{{ route('poli.admin-poli.index', $poli) }}" class="btn btn-secondary me-2">
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
