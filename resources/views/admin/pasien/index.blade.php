@extends('layouts.admin')

@section('title', 'Pasien')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pasien</li>
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
                <form action="{{ route('pasien.index') }}" method="get">
                    <x-text-input type="search" name="search" placeholder="Cari sesuatu..."
                        value="{{ request('search') }}" />
                </form>
                <a href="{{ route('pasien.create') }}" class="btn btn-primary px-2" style="width: 150px">
                    <i class="fa-solid fa-plus"></i> Tambah Data
                </a>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No Pasien</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">NIK</th>
                            <th scope="col">No Telpon</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pasien as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->no_pasien }}</td>
                                <td>{{ $item->user->nama ?? '-' }}</td>
                                <td>{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $item->nik ?? '-' }}</td>
                                <td>{{ $item->user->no_telp ?? '-' }}</td>
                                <td>
                                    <div class="d-flex" style="gap: 5px">
                                        <a href="{{ route('pasien.show', $item) }}" class="btn btn-sm btn-info">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('pasien.edit', $item) }}" class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <form action="{{ route('pasien.destroy', $item) }}" method="post"
                                            onsubmit="return confirm('apakah anda yakin?')">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button class="btn-sm">
                                                <i class="fa-solid fa-trash"></i>
                                            </x-danger-button>
                                        </form>
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
            {{ $pasien->links() }}
        </div>
    </div>
@endsection
