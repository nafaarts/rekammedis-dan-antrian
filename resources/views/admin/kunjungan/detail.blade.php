@extends('layouts.admin')

@section('title', 'Detail Kunjungan')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('kunjungan.index') }}">Kunjungan</a></li>
            <li class="breadcrumb-item active">{{ $kunjungan->kode_kunjungan }}</li>
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
            <h5 class="fw-bold">Data Kunjungan</h5>
            <hr>
            <table>
                <tr>
                    <th>Kode Kunjungan</th>
                    <td class="px-4">:</td>
                    <td>{{ $kunjungan->kode_kunjungan }}</td>
                </tr>
                <tr>
                    <th>Nama Pasien</th>
                    <td class="px-4">:</td>
                    <td>{{ $kunjungan->pasien->user->nama }}</td>
                </tr>
                <tr>
                    <th>Nomor Pasien</th>
                    <td class="px-4">:</td>
                    <td>{{ $kunjungan->pasien->no_pasien }}</td>
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

    <div class="d-flex align-items-center justify-content-end mt-4">
        <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary me-2">
            Kembali
        </a>
        <a href="{{ route('kunjungan.periksa', $kunjungan) }}" class="btn btn-primary">
            Periksa
        </a>
    </div>
@endsection
