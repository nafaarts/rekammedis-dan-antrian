@extends('layouts.admin')

@section('title', 'Detail Pasien')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">
                @can('is_admin')
                    <a href="{{ route('pasien.index') }}">Pasien</a>
                @else
                    Pasien
                @endcan
            </li>
            <li class="breadcrumb-item active">{{ $pasien->user->nama }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body pt-3">
                    <h5 class="fw-bold">Data Pasien</h5>
                    <hr>
                    <table>
                        <tr>
                            <th>Nama Pasien</th>
                            <td class="px-4">:</td>
                            <td>{{ $pasien->user->nama }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Pasien</th>
                            <td class="px-4">:</td>
                            <td>{{ $pasien->no_pasien }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Induk Kependudukan</th>
                            <td class="px-4">:</td>
                            <td>{{ $pasien->nik }}</td>
                        </tr>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td class="px-4">:</td>
                            <td>{{ $pasien->tempat_lahir }},
                                {{ now()->parse($pasien->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td class="px-4">:</td>
                            <td>{{ $pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td class="px-4">:</td>
                            <td>{{ $pasien->agama }}</td>
                        </tr>
                        <tr>
                            <th>Status Perkawinan</th>
                            <td class="px-4">:</td>
                            <td>{{ $pasien->status_perkawinan }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td class="px-4">:</td>
                            <td>{{ $pasien->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Pekerjaan</th>
                            <td class="px-4">:</td>
                            <td>{{ $pasien->pekerjaan }}</td>
                        </tr>
                        <tr>
                            <th>Nama Keluarga Terdekat</th>
                            <td class="px-4">:</td>
                            <td>{{ $pasien->nama_keluarga_terdekat }}</td>
                        </tr>
                        <tr>
                            <th>No telp Keluarga Terdekat</th>
                            <td class="px-4">:</td>
                            <td>{{ $pasien->no_telp_keluarga_terdekat }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body pt-3">
                    <h5 class="fw-bold">Jumlah Kunjungan</h5>
                    <hr>
                    <h2>
                        {{ $pasien->kunjungan->count() }}
                    </h2>
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
                            <td>{{ $pasien?->riwayatPenyakit?->riwayat_penyakit ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Riwayat Alergi</th>
                            <td class="px-4">:</td>
                            <td>{{ $pasien?->riwayatPenyakit?->riwayat_alergi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Riwayat Obat</th>
                            <td class="px-4">:</td>
                            <td>{{ $pasien?->riwayatPenyakit?->riwayat_obat ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body pb-0 pt-4">
            <h5 class="fw-bold">Rekam Medis</h5>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nomor Kunjungan</th>
                            <th scope="col">Tanggal Pemeriksaan</th>
                            <th scope="col">Nama Dokter</th>
                            <th scope="col">Poli</th>
                            <th scope="col">Diagnosa</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rekammedis as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->kunjungan->kode_kunjungan }}</td>
                                <td>{{ $item->tanggal_pemeriksaan ?? '-' }}</td>
                                <td>{{ $item->dokter->nama }}</td>
                                <td>{{ $item->poli->nama }}</td>
                                <td><span class="text-truncate">{{ $item->diagnosa }}</span></td>
                                <td>
                                    <div class="d-flex" style="gap: 5px">
                                        <a href="{{ route('pasien.detail-rekammedis', [$pasien, $item, 'back' => request('back')]) }}"
                                            class="btn btn-sm btn-info">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <span>Tidak ada data</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $rekammedis->links() }}
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-end mt-4">
        <a href="{{ route(request('back') == 'kunjungan' ? 'kunjungan.index' : 'pasien.index') }}"
            class="btn btn-secondary me-2">
            Kembali
        </a>
    </div>
@endsection
