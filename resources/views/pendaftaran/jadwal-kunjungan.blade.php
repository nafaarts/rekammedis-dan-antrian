@extends('layouts.user')

@section('title', 'Buat Jadwal Kunjungan')

@section('content')
    <div class="card">
        <div class="text-center py-4">
            <h4 class="m-0">Buat Jadwal Kunjungan</h4>
        </div>
        <hr>
        <div class="card-body pt-3">
            <form action="{{ route('pendaftaran.store-jadwal-kunjungan') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="tanggal_kunjungan" value="Tanggal Kunjungan" />
                            <x-text-input id="tanggal_kunjungan" type="date" name="tanggal_kunjungan" :value="old('tanggal_kunjungan')"
                                placeholder="Masukan tanggal kunjungan anda" autofocus />
                            <x-input-error :messages="$errors->get('tanggal_kunjungan')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="poli_tujuan" value="Poli Tujuan" />
                            <select class="form-select" name="poli_tujuan" id="poli_tujuan">
                                <option selected value="">-- pilih poli --</option>
                                @foreach ($poli as $item)
                                    <option value="{{ $item->id }}" @selected(old('poli_tujuan') == $item->id)>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('poli_tujuan')" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <x-input-label for="keluhan" value="Keluhan" />
                    <x-text-input id="keluhan" type="text" name="keluhan" :value="old('keluhan')"
                        placeholder="Masukan keluhan anda" />
                    <x-input-error :messages="$errors->get('keluhan')" class="mt-2" />
                </div>
                <hr>
                <div class="mb-3">
                    <x-input-label for="nomor_asuransi" value="Nomor BPJS ( jika ada )" />
                    <x-text-input id="nomor_asuransi" type="text" name="nomor_asuransi" :value="old('nomor_asuransi')"
                        placeholder="Masukan nomor bpjs anda jika ada" />
                    <x-input-error :messages="$errors->get('nomor_asuransi')" class="mt-2" />
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="nomor_rujukan" value="Nomor Rujukan ( jika ada )" />
                            <x-text-input id="nomor_rujukan" type="text" name="nomor_rujukan" :value="old('nomor_rujukan')"
                                placeholder="Masukan nomor rujukan anda jika ada" />
                            <x-input-error :messages="$errors->get('nomor_rujukan')" class="mt-2" />

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-input-label for="tanggal_rujukan" value="Tanggal Rujukan ( jika ada )" />
                            <x-text-input id="tanggal_rujukan" type="date" name="tanggal_rujukan" :value="old('tanggal_rujukan')"
                                placeholder="Masukan tanggal rujukan anda jika ada" />
                            <x-input-error :messages="$errors->get('tanggal_rujukan')" class="mt-2" />
                        </div>
                    </div>
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
