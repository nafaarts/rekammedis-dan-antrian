@extends('layouts.guest')

@section('content')
    <div class="mt-4">
        <h5 class="card-title text-center pb-0 fs-4">Buat Akun baru</h5>
        <p class="text-center small">Masukan data diri anda untuk mendaftar.</p>
    </div>

    <hr class="my-4">

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}" class="row g-3 needs-validation">
        @csrf
        <!-- Email Address -->
        <div>
            <x-input-label for="nama" :value="__('Nama Lengkap')" />
            <x-text-input id="nama" type="text" name="nama" :value="old('nama')"
                placeholder="Masukan nama lengkap anda" required />
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" placeholder="Masukan email anda"
                required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Nomor Telepon -->
        <div class="mt-4">
            <x-input-label for="no_telp" :value="__('Nomor Telepon')" />
            <x-text-input id="no_telp" type="text" name="no_telp" placeholder="Masukan nomor telepon anda" required />
            <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" placeholder="Masukan password anda" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Ulangi Password')" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                placeholder="Ulangi password anda" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <small class="text-muted mb-2 d-block">Silahkan checklist konfirmasi bukan robot dibawah ini.</small>
            {!! htmlFormSnippet() !!}
        </div>

        <div class="d-flex align-items-center justify-content-end mt-4">
            <x-primary-button class="ml-4">
                Daftar <i class="fa-solid fa-arrow-right"></i>
            </x-primary-button>
        </div>

        <hr class="my-4">
        <small class="text-center text-muted">
            Sudah punya akun, <a href="{{ route('login') }}">Login</a>
        </small>
    </form>
@endsection
