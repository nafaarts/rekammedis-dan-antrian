<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Beranda') - {{ env('APP_NAME') }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Icon -->
    <link href="{{ asset('assets/img/logo.png') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    @stack('head')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light shadow">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" height="24">
                E-Pasien
            </a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="offcanvas" href="#sidebar" role="button"
                        aria-controls="sidebar">
                        <i class="fas fa-fw fa-bars"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <main>
        <div class="container py-3">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="sidebar"
        aria-labelledby="sidebarLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @auth
                <div class="p-3 bg-primary rounded text-white">
                    <h5 class="fw-bold mb-1">{{ auth()->user()?->nama }}</h5>
                    <small>{{ auth()->user()->email }}</small>
                </div>
                <hr>
            @endauth
            <ul class="nav flex-column gap-2">
                @auth
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('beranda') }}"><i class="fas fa-fw fa-home"></i>
                            Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('pendaftaran.bukti') }}"><i
                                class="fas fa-fw fa-address-card"></i>
                            Bukti
                            Pendaftaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('antrian-saya') }}"><i
                                class="fas fa-fw fa-arrow-down-1-9"></i> Nomor Antrian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="javascript:document.getElementById('form-logout').submit()">
                            <i class="fas fa-fw fa-sign-out"></i>
                            Keluar
                        </a>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link text-dark">
                            <i class="fas fa-fw fa-sign-in"></i>
                            Masuk
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>

    <form action="{{ route('logout') }}" method="post" id="form-logout">
        @csrf
    </form>


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="fas fa-fw fa-arrow-up"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
