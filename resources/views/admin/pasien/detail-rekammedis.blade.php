@extends('layouts.admin')

@section('title', 'Detail Rekam Medis')

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
            <li class="breadcrumb-item">
                <a href="{{ route('pasien.show', $pasien) }}">
                    {{ $pasien->user->nama }}
                </a>
            </li>
            <li class="breadcrumb-item
                    active">Rekam Medis</li>
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

    <div class="card">
        <div class="card-body pt-3">
            <h5 class="fw-bold">Detail Rekam Medis</h5>
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
                    <th>Tanggal Pemeriksaan</th>
                    <td class="px-4">:</td>
                    <td>{{ $rekammedis->tanggal_pemeriksaan }}</td>
                </tr>
                <tr>
                    <th>Poli</th>
                    <td class="px-4">:</td>
                    <td>{{ $rekammedis->poli->nama }}</td>
                </tr>
                <tr>
                    <th>Dokter</th>
                    <td class="px-4">:</td>
                    <td>{{ $rekammedis->dokter->nama }}</td>
                </tr>
                <tr>
                    <th>Diagnosa</th>
                    <td class="px-4">:</td>
                    <td>{{ $rekammedis->diagnosa }}</td>
                </tr>
                <tr>
                    <th>Penanganan</th>
                    <td class="px-4">:</td>
                    <td>{{ $rekammedis->penanganan }}</td>
                </tr>
                <tr>
                    <th>Resep Obat</th>
                    <td class="px-4">:</td>
                    <td>{{ $rekammedis->resep_obat }}</td>
                </tr>
                <tr>
                    <th>Catatan</th>
                    <td class="px-4">:</td>
                    <td>{{ $rekammedis->catatan }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body pt-3">
            <h5 class="fw-bold">Data Kunjungan</h5>
            <hr>
            <table>
                <tr>
                    <th>Kode Kunjungan</th>
                    <td class="px-4">:</td>
                    <td>{{ $rekammedis->kunjungan->kode_kunjungan }}</td>
                </tr>
                <tr>
                    <th>Poli Tujuan</th>
                    <td class="px-4">:</td>
                    <td>{{ $rekammedis->kunjungan->poli->nama }}</td>
                </tr>
                <tr>
                    <th>Status Kunjungan</th>
                    <td class="px-4">:</td>
                    <td>{{ $rekammedis->kunjungan->status_kunjungan ? 'Sudah dikunjungi' : 'Belum dikunjungi' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Kunjungan</th>
                    <td class="px-4">:</td>
                    <td>{{ $rekammedis->kunjungan->tanggal_kunjungan }}</td>
                </tr>
                <tr>
                    <th>Tanggal dibuat</th>
                    <td class="px-4">:</td>
                    <td>{{ $rekammedis->kunjungan->created_at->translatedFormat('d F Y H:i') }}</td>
                </tr>
                @if ($rekammedis->kunjungan->asuransi != null)
                    <tr>
                        <th>Asuransi</th>
                        <td class="px-4">:</td>
                        <td>{{ $rekammedis->kunjungan->asuransi }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Asuransi</th>
                        <td class="px-4">:</td>
                        <td>{{ $rekammedis->kunjungan->nomor_asuransi }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Rujukan</th>
                        <td class="px-4">:</td>
                        <td>{{ $rekammedis->kunjungan->nomor_rujukan }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Rujukan</th>
                        <td class="px-4">:</td>
                        <td>{{ $rekammedis->kunjungan->tanggal_rujukan }}</td>
                    </tr>
                @endif
            </table>
            <hr>
            <table>
                <tr>
                    <th colspan="3">Keluhan</th>
                </tr>
                <tr>
                    <td colspan="3">{{ $rekammedis->kunjungan->keluhan ?? '-' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-end mt-4">
        <a href="{{ route('pasien.show', [$pasien, 'back' => request('back')]) }}" class="btn btn-secondary me-2">
            Kembali
        </a>
    </div>

@endsection
