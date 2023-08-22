@extends('layouts.user')

@section('title', 'Buat Antrian')

@push('head')
    <script src="https://unpkg.com/html5-qrcode"></script>
@endpush

@section('content')
    <div class="card ">
        <div class="text-center py-4">
            <h4 class="m-0">Buat Antrian</h4>
        </div>
        <hr>
        <div class="card-body p-3 p-md-5">
            <div class="row">
                <div class="col-md-6 mb-3 mx-auto">
                    <div id="qr-reader" class="w-100"></div>
                    <div id="qr-reader-results"></div>
                    <div class="mt-4">
                        <form action="{{ route('buat-antrian') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <x-input-label for="nomor_pendaftaran" value="Nomor Pendaftaran" />
                                <x-text-input id="nomor_pendaftaran" type="text" name="nomor_pendaftaran"
                                    :value="old('nomor_pendaftaran')" placeholder="Masukan nomor pendaftaran" required />
                                <x-input-error :messages="$errors->get('nomor_pendaftaran')" class="mt-2" />
                            </div>

                            <div class="d-flex gap-2 justify-content-end">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary">Buat Antrian <i
                                        class="fas fa-fw fa-arrow-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script defer>
        let resultContainer = document.getElementById('qr-reader-results');
        let lastResult, countResults = 0;
        let inputNomorPendaftaran = document.getElementById('nomor_pendaftaran')
        let audio = new Audio("{{ asset('scan-sound.mp3') }}");


        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                inputNomorPendaftaran.value = decodedText;
                audio.play();
            }
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10,
                qrbox: 250,
                rememberLastUsedCamera: false,
            });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
@endsection
