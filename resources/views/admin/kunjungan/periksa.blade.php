@extends('layouts.admin')

@section('title', 'Pemeriksaan')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pemeriksaan</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body pt-3">
                    <h5 class="fw-bold">Data Kunjungan</h5>
                    <hr>
                    <table>
                        <tr>
                            <th>Kode Kunjungan</th>
                            <td class="px-4">:</td>
                            <td>{{ $kunjungan->kode_kunjungan }}</td>
                        </tr>
                        <tr>
                            <th>Poli Tujuan</th>
                            <td class="px-4">:</td>
                            <td>{{ $kunjungan->poli->nama }}</td>
                        </tr>
                        <tr>
                            <th>Status Kunjungan</th>
                            <td class="px-4">:</td>
                            <td>{{ $kunjungan->status_kunjungan ? 'Sudah dikunjungi' : 'Belum dikunjungi' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Kunjungan</th>
                            <td class="px-4">:</td>
                            <td>{{ $kunjungan->tanggal_kunjungan }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal dibuat</th>
                            <td class="px-4">:</td>
                            <td>{{ $kunjungan->created_at->translatedFormat('d F Y H:i') }}</td>
                        </tr>
                        @if ($kunjungan->asuransi != null)
                            <tr>
                                <th>Asuransi</th>
                                <td class="px-4">:</td>
                                <td>{{ $kunjungan->asuransi }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Asuransi</th>
                                <td class="px-4">:</td>
                                <td>{{ $kunjungan->nomor_asuransi }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Rujukan</th>
                                <td class="px-4">:</td>
                                <td>{{ $kunjungan->nomor_rujukan }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Rujukan</th>
                                <td class="px-4">:</td>
                                <td>{{ $kunjungan->tanggal_rujukan }}</td>
                            </tr>
                        @endif
                    </table>
                    <hr>
                    <table>
                        <tr>
                            <th colspan="3">Keluhan</th>
                        </tr>
                        <tr>
                            <td colspan="3">{{ $kunjungan->keluhan ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body pt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Data Pasien</h5>
                        <a href="{{ route('pasien.show', $kunjungan->pasien) }}">Lihat Detail Pasien <i
                                class="fas fa-fw fa-arrow-right"></i></a>
                    </div>
                    <hr>
                    <table>
                        <tr>
                            <th>Nomor Induk Kependudukan</th>
                            <td class="px-4">:</td>
                            <td>{{ $kunjungan->pasien->nik }}</td>
                        </tr>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td class="px-4">:</td>
                            <td>{{ $kunjungan->pasien->tempat_lahir }},
                                {{ now()->parse($kunjungan->pasien->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td class="px-4">:</td>
                            <td>{{ $kunjungan->pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td class="px-4">:</td>
                            <td>{{ $kunjungan->pasien->agama }}</td>
                        </tr>
                        <tr>
                            <th>Status Perkawinan</th>
                            <td class="px-4">:</td>
                            <td>{{ $kunjungan->pasien->status_perkawinan }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td class="px-4">:</td>
                            <td>{{ $kunjungan->pasien->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Pekerjaan</th>
                            <td class="px-4">:</td>
                            <td>{{ $kunjungan->pasien->pekerjaan }}</td>
                        </tr>
                        <tr>
                            <th>Nama Keluarga Terdekat</th>
                            <td class="px-4">:</td>
                            <td>{{ $kunjungan->pasien->nama_keluarga_terdekat }}</td>
                        </tr>
                        <tr>
                            <th>No telp Keluarga Terdekat</th>
                            <td class="px-4">:</td>
                            <td>{{ $kunjungan->pasien->no_telp_keluarga_terdekat }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body pt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Riwayat Penyakit</h5>
                    </div>
                    <hr>
                    <table>
                        <tr>
                            <th>Riwayat Penyakit</th>
                            <td class="px-4">:</td>
                            <td>{{ $kunjungan->pasien->riwayatPenyakit->riwayat_penyakit }}</td>
                        </tr>
                        <tr>
                            <th>Riwayat Alergi</th>
                            <td class="px-4">:</td>
                            <td>{{ $kunjungan->pasien->riwayatPenyakit->riwayat_alergi }}</td>
                        </tr>
                        <tr>
                            <th>Riwayat Obat</th>
                            <td class="px-4">:</td>
                            <td>{{ $kunjungan->pasien->riwayatPenyakit->riwayat_obat }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card position-sticky">
                <div class="card-body pt-3">
                    <h5 class="fw-bold">Pemeriksaan</h5>
                    <hr>
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <x-input-label for="dokter" value="Dokter" />
                            <select class="form-select" name="dokter">
                                <option @selected(old('dokter') == '') disabled>-- pilih dokter --</option>
                                @foreach ($dokter as $item)
                                    <option @selected(old('dokter', $rekammedis->dokter_id) == $item->id) value="{{ $item->id }}">
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('dokter')" class="mt-2" />
                        </div>
                        @can('is_admin')
                            <div class="mb-3">
                                <x-input-label for="poli" value="Poli" />
                                <select class="form-select" name="poli">
                                    <option @selected(old('poli') == '') disabled>-- pilih poli --</option>
                                    @foreach ($poli as $item)
                                        <option @selected(old('poli', $rekammedis->poli_id) == $item->id) value="{{ $item->id }}">
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('dokter')" class="mt-2" />
                            </div>
                        @endcan
                        <div class="mb-3">
                            <x-input-label for="tanggal_pemeriksaan" value="Tanggal Pemeriksaan" />
                            <x-text-input id="tanggal_pemeriksaan" type="date" name="tanggal_pemeriksaan"
                                :value="old(
                                    'tanggal_pemeriksaan',
                                    $rekammedis->tanggal_pemeriksaan ?? date('Y-m-d'),
                                )" />
                            <x-input-error :messages="$errors->get('tanggal_pemeriksaan')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="diagnosa" value="Diagnosa" />
                            <x-text-input id="diagnosa" type="text" name="diagnosa" :value="old('diagnosa', $rekammedis->diagnosa)"
                                placeholder="Masukan diagnosa" />
                            <x-input-error :messages="$errors->get('diagnosa')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="penanganan" value="Penanganan" />
                            <x-text-input id="penanganan" type="text" name="penanganan" :value="old('penanganan', $rekammedis->penanganan)"
                                placeholder="Masukan penanganan" />
                            <x-input-error :messages="$errors->get('penanganan')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="resep_obat" value="Resep Obat" />
                            <x-text-input id="resep_obat" type="text" name="resep_obat" :value="old('resep_obat', $rekammedis->resep_obat)"
                                placeholder="Masukan resep obat" />
                            <x-input-error :messages="$errors->get('resep_obat')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="catatan" value="Catatan" />
                            <x-text-input id="catatan" type="text" name="catatan" :value="old('catatan', $rekammedis->catatan)"
                                placeholder="Masukan catatan" />
                            <x-input-error :messages="$errors->get('catatan')" class="mt-2" />
                        </div>

                        <div class="d-flex align-items-center justify-content-end mt-4">
                            <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary me-2">
                                Batal
                            </a>
                            <x-primary-button type="submit">
                                Simpan
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
