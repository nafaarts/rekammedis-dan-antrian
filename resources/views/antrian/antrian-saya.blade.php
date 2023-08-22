@extends('layouts.user')

@section('title', 'Nomor Antrian')

@section('content')

    @if ($antrian)
        <div class="card ">
            <div class="text-center py-4">
                <h4 class="m-0">Nomor Antrian</h4>
            </div>
            <hr>
            <div class="card-body p-3 p-md-5 text-center d-flex flex-column justify-content-center align-items-center">
                <h5 class="text-uppercase">POLI {{ $antrian->poli->nama }}</h5>
                <h6 class="mb-3">Nomor Pendaftaran: <strong>{{ $antrian->kunjungan->kode_kunjungan }}</strong></h6>
                <small class="text-muted">Nomor antrian anda :</small>
                <div class="border p-4 my-5" style="width: fit-content">
                    <h3 class="m-0 fw-bold">{{ $antrian->nomor_antrian }}</h3>
                </div>
                <p class="text-muted fw-light">Silahkan menunggu nomor antrian anda dipanggil, nomor antrian ini hanya
                    berlaku selama
                    1 hari</p>
                <hr>
                <a href="{{ route('beranda') }}">
                    <i class="fas fa-fw fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body p-md-5 p-3">
                <h4 class="mb-4">Anda tidak memiliki nomor antrian</h4>
                <a href="{{ route('beranda') }}">
                    <i class="fas fa-fw fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    @endif


@endsection
