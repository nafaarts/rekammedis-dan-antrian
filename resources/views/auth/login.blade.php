@extends('layouts.guest')

@section('content')
    <!-- Session Status -->

    <div class="mt-4">
        <h5 class="card-title text-center pb-0 fs-4">Masuk ke Akun anda</h5>
        <p class="text-center small">Masukan email dan password untuk login.</p>
    </div>

    <hr class="my-4">

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="row g-3 needs-validation" novalidate autocomplete="off">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email / No Telp')" />
            <x-text-input id="email" type="text" name="email" :value="old('email')"
                placeholder="Masukan email / No Telp anda" autofocus required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" placeholder="Masukan password anda" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <span class="form-check-label">Ingat saya!</span>
            </label>
        </div>


        <div class="mt-4">
            <small class="text-muted mb-2 d-block">Silahkan checklist konfirmasi bukan robot dibawah ini.</small>
            {!! htmlFormSnippet() !!}
        </div>

        <div class="d-flex align-items-center justify-content-between mt-4">
            @if (Route::has('password.request'))
                <small>
                    <a class="text-muted" href="{{ route('password.request') }}">
                        Lupa password
                    </a>
                </small>
            @endif

            <x-primary-button class="ml-3">
                Masuk <i class="fa-solid fa-arrow-right"></i>
            </x-primary-button>
        </div>
        <hr class="my-4">
        <small class="text-center text-muted">
            Belum punya akun, <a href="{{ route('register') }}">Daftar</a>
        </small>
    </form>
@endsection
