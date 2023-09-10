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
                    <div class="m-auto m-md-0">
                        {{ $qrcode }}
                    </div>
                    <div class="d-flex flex-column flex-md-row align-items-start gap-0 gap-md-5 p-md-0 p-3 table-responsive">
                        <table>
                            <tr>
                                <th scope="row">Tanggal Kunjungan</th>
                            </tr>
                            <tr>
                                <td class="pb-2">{{ $bukti->tanggal_kunjungan }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nama</th>
                            </tr>
                            <tr>
                                <td class="pb-2">{{ $bukti->pasien->user->nama }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Kode Kunjungan</th>
                            </tr>
                            <tr>
                                <td class="pb-2">{{ $bukti->kode_kunjungan }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Poli Tujuan</th>
                            </tr>
                            <tr>
                                <td class="pb-2">{{ $bukti->poli->nama }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Status Kunjungan</th>
                            </tr>
                            <tr>
                                <td class="pb-2">{{ $bukti->status_kunjungan ? 'Sudah dikunjungi' : 'Belum dikunjungi' }}
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <th scope="row">Asuransi</th>
                            </tr>
                            <tr>
                                <td class="pb-2">{{ $bukti->asuransi }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal dibuat</th>
                            </tr>
                            <tr>
                                <td class="pb-2">{{ $bukti->created_at->translatedFormat('d F Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr>
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
