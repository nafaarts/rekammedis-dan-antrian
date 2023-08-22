@extends('layouts.user')

@section('title', 'Riwayat penyakit')

@section('content')
    <div class="card">
        <div class="text-center py-4">
            <h4 class="m-0">Riwayat Penyakit Anda</h4>
        </div>
        <hr>
        <div class="card-body pt-3">
            <form action="{{ route('pendaftaran.store-riwayat-penyakit') }}" method="post">
                @csrf
                <div class="mb-3">
                    <x-input-label for="riwayat_penyakit" value="Riwayat Penyakit ( jika ada )" />
                    <x-text-input id="riwayat_penyakit" type="text" name="riwayat_penyakit" :value="old('riwayat_penyakit', $riwayatPenyakit?->riwayat_penyakit)"
                        placeholder="Masukan riwayat penyakit anda jika ada" autofocus />
                </div>
                <div class="mb-3">
                    <x-input-label for="riwayat_alergi" value="Riwayat Alergi ( jika ada )" />
                    <x-text-input id="riwayat_alergi" type="text" name="riwayat_alergi" :value="old('riwayat_alergi', $riwayatPenyakit?->riwayat_alergi)"
                        placeholder="Masukan riwayat alergi anda jika ada" autofocus />
                </div>
                <div class="mb-3">
                    <x-input-label for="riwayat_obat" value="Riwayat Obat ( jika ada )" />
                    <x-text-input id="riwayat_obat" type="text" name="riwayat_obat" :value="old('riwayat_obat', $riwayatPenyakit?->riwayat_obat)"
                        placeholder="Masukan riwayat obat anda jika ada" autofocus />
                </div>

                <div class="d-flex align-items-center justify-content-end mt-4">
                    <a href="{{ route('beranda') }}" class="btn btn-secondary me-2">
                        Batal
                    </a>
                    <x-primary-button type="submit">
                        Lanjutkan
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
@endsection
