@extends('layouts.admin')

@section('title', 'Tambah Pasien')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pasien.index') }}">Pasien</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card">
        <div class="card-body pt-3">
            <form action="{{ route('pasien.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <x-input-label for="nama" value="Nama Pasien" />
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
                            <x-input-label for="nik" value="NIK" />
                            <x-text-input id="nik" type="text" name="nik" :value="old('nik')"
                                placeholder="Masukan Nomor Induk Pegawai" required />
                            <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                        </div>
                    </div>
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
                            <x-input-label for="pekerjaan" value="Pekerjaan" />
                            <x-text-input id="pekerjaan" type="text" name="pekerjaan" :value="old('pekerjaan')"
                                placeholder="Masukan pekerjaan" />
                            <x-input-error :messages="$errors->get('pekerjaan')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="status_perkawinan" value="Status Perkawinan" />
                            <select class="form-select" name="status_perkawinan">
                                <option @selected(old('status_perkawinan') == '') disabled>-- pilih status perkawinan --</option>
                                @foreach (['BELUM KAWIN', 'KAWIN', 'CERAI HIDUP', 'CERAI MATI'] as $item)
                                    <option @selected(old('status_perkawinan') == $item) value="{{ $item }}">{{ $item }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('status_perkawinan')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="alamat" value="Alamat Pasien" />
                            <x-text-input id="alamat" type="text" name="alamat" :value="old('alamat')"
                                placeholder="Masukan alamat" />
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="nama_keluarga_terdekat" value="Nama Keluarga Terdekat" />
                            <x-text-input id="nama_keluarga_terdekat" type="text" name="nama_keluarga_terdekat"
                                :value="old('nama_keluarga_terdekat')" placeholder="Masukan nama keluarga terdekat pasien" />
                            <x-input-error :messages="$errors->get('nama_keluarga_terdekat')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="no_telp_keluarga_terdekat" value="Nomor Telepon Keluarga Terdekat" />
                            <x-text-input id="no_telp_keluarga_terdekat" type="text" name="no_telp_keluarga_terdekat"
                                :value="old('no_telp_keluarga_terdekat')" placeholder="Masukan nomor telepon keluarga terdekat" />
                            <x-input-error :messages="$errors->get('no_telp_keluarga_terdekat')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-end mt-4">
                    <a href="{{ route('pasien.index') }}" class="btn btn-secondary me-2">
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
