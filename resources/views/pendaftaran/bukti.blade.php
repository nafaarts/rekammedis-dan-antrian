@extends('layouts.user')

@section('title', 'Bukti Pendaftaran')

@section('content')

    @if ($bukti)
        <div class="card ">
            <div class="text-center py-4">
                <h4 class="m-0">Bukti Pendaftaran Kunjungan</h4>
            </div>
            <hr>
            <div class="card-body p-3 p-md-5">
                <div class="d-flex flex-column flex-md-row gap-4">
                    <div>
                        {{ $qrcode }}
                    </div>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th>Tanggal Kunjungan</th>
                                <td class="px-4">:</td>
                                <td>{{ $bukti->tanggal_kunjungan }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td class="px-4">:</td>
                                <td>{{ $bukti->pasien->user->nama }}</td>
                            </tr>
                            <tr>
                                <th>Kode Kunjungan</th>
                                <td class="px-4">:</td>
                                <td>{{ $bukti->kode_kunjungan }}</td>
                            </tr>
                            <tr>
                                <th>Poli Tujuan</th>
                                <td class="px-4">:</td>
                                <td>{{ $bukti->poli->nama }}</td>
                            </tr>
                            <tr>
                                <th>Status Kunjungan</th>
                                <td class="px-4">:</td>
                                <td>{{ $bukti->status_kunjungan ? 'Sudah dikunjungi' : 'Belum dikunjungi' }}</td>
                            </tr>
                            <tr>
                                <th>Asuransi</th>
                                <td class="px-4">:</td>
                                <td>{{ $bukti->asuransi }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal dibuat</th>
                                <td class="px-4">:</td>
                                <td>{{ $bukti->created_at->translatedFormat('d F Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-start mt-5">
                    <a href="{{ route('beranda') }}" class="btn btn-secondary me-2">
                        Kembali
                    </a>
                    {{-- <a href="" class="btn btn-primary">
                Download
            </a> --}}
                </div>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body p-md-5 p-3">
                <h4 class="mb-4">Anda belum melakukan pendaftaran</h4>
                <a href="{{ route('beranda') }}">
                    <i class="fas fa-fw fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    @endif
@endsection
