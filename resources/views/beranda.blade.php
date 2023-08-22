@extends('layouts.user')

@section('title', 'Beranda')

@section('content')
    <div class="card py-5 px-2 text-center bg-primary text-white">
        <h3>Selamat Datang di Pendaftaran Pasien Online RSTAS</h3>
    </div>

    @if (session()->has('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Mohon maaf!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex flex-column flex-md-row gap-md-4">
        <div class="card text-center p-3 p-md-5 w-100">
            <small class="text-muted">
                Pasien yang sudah pernah berobat di RSTAS dan sudah memiliki nomor Rekam Medis (RM)
            </small>
            <hr>
            <a href="{{ route('pendaftaran.riwayat-penyakit') }}" class="btn btn-primary">Pendaftaran Pasien Lama <i
                    class="fas fa-fw fa-arrow-right"></i></a>
        </div>
        <div class="card text-center p-3 p-md-5 w-100">
            <small class="text-muted">
                Pasien yang belum pernah berobat di RSTAS dan belum memiliki nomor Rekam Medis (RM)
            </small>
            <hr>
            <a href="{{ route('pendaftaran.formulir') }}" class="btn btn-primary">Pendaftaran Pasien Baru <i
                    class="fas fa-fw fa-arrow-right"></i></a>
        </div>
    </div>

    <div class="card p-3 p-md-5">
        <h6 class="mb-3">Syarat dan Ketentuan</h6>
        <ol style="font-size: 14px" class="p-0 ps-3 mb-0">
            <li class="mb-2">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt, fugiat aspernatur ratione
                pariatur veniam, suscipit veritatis nisi eum, sunt deserunt consequuntur commodi modi?
            </li>
            <li class="mb-2">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt, fugiat aspernatur ratione
                pariatur veniam, suscipit veritatis nisi eum, sunt deserunt consequuntur commodi modi?
            </li>
            <li class="mb-2">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt, fugiat aspernatur ratione
                pariatur veniam, suscipit veritatis nisi eum, sunt deserunt consequuntur commodi modi?
            </li>
            <li>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt, fugiat aspernatur ratione
                pariatur veniam, suscipit veritatis nisi eum, sunt deserunt consequuntur commodi modi?
            </li>
        </ol>
    </div>

    <div class="card p-3 p-md-5">
        <iframe title="Maps"
            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d4610.25062387358!2d95.97412671640612!3d5.280397757315165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNcKwMTYnNTEuMSJOIDk1wrA1OCcyNy42IkU!5e1!3m2!1sid!2sid!4v1692525065233!5m2!1sid!2sid"
            height="450" style="border:0;" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
@endsection
