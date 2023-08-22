@extends('layouts.admin')

@section('title', 'Tambah Dokter')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dokter.index') }}">Dokter</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card">
        <div class="card-body pt-3">
            <form action="{{ route('dokter.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="nama" value="Nama Dokter" />
                            <x-text-input id="nama" type="text" name="nama" :value="old('nama')"
                                placeholder="Masukan nama" autofocus required />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="poli" value="Poli" />
                            <select class="form-select" name="poli_id">
                                <option selected>-- pilih poli --</option>
                                @foreach ($poli as $item)
                                    <option value="{{ $item->id }}" @selected(old('poli_id') == $item->id)>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('poli_id')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="spesialis" value="Spesialis" />
                            <x-text-input id="spesialis" type="text" name="spesialis" :value="old('spesialis')"
                                placeholder="Masukan spesialis" />
                            <x-input-error :messages="$errors->get('spesialis')" class="mt-2" />
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
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="tempat_lahir" value="Tempat Lahir" />
                            <x-text-input id="tempat_lahir" type="text" name="tempat_lahir" :value="old('tempat_lahir')"
                                placeholder="Masukan tempat lahir" />
                            <x-input-error :messages="$errors->get('tempat_lahir')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="tanggal_lahir" value="Tanggal Lahir" />
                            <x-text-input id="tanggal_lahir" type="date" name="tanggal_lahir" :value="old('tanggal_lahir')"
                                placeholder="Masukan tanggal lahir" />
                            <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="row">
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
                                    <option @selected(old('agama') == 'L') value="L">{{ $item }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('agama')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="no_telp" value="Nomor Telepon" />
                            <x-text-input id="no_telp" type="text" name="no_telp" :value="old('no_telp')"
                                placeholder="Masukan no telepon" />
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
                </div>

                <div class="d-flex align-items-center justify-content-end mt-4">
                    <a href="{{ route('dokter.index') }}" class="btn btn-secondary me-2">
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
