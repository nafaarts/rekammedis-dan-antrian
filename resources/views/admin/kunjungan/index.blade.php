@extends('layouts.admin')

@section('title', 'Kunjungan')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Kunjungan</li>
        </ol>
    </nav>
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body pb-0 pt-4">
            <div class="d-flex align-items-center justify-content-between" style="gap: 10px;">
                <form action="{{ route('kunjungan.index') }}" method="get">
                    <x-text-input type="search" name="search" placeholder="Cari sesuatu..."
                        value="{{ request('search') }}" />
                </form>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No Kunjungan</th>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">Poli</th>
                            <th scope="col">Tanggal Kunjungan</th>
                            <th scope="col">Asuransi</th>
                            <th scope="col">Status Kunjungan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kunjungan as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->kode_kunjungan }}</td>
                                <td>{{ $item->pasien->user->nama ?? '-' }}</td>
                                <td>{{ $item->poli->nama }}</td>
                                <td>{{ $item->tanggal_kunjungan }}</td>
                                <td>{{ $item->asuransi ?? '-' }}</td>
                                <td>{{ $item->status_kunjungan ? 'sudah' : 'belum' }}</td>
                                <td>
                                    <div class="d-flex" style="gap: 5px">
                                        <a href="{{ route('kunjungan.detail', $item) }}" class="btn btn-sm btn-info">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <span>Tidak ada data</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $kunjungan->links() }}
        </div>
    </div>
@endsection
