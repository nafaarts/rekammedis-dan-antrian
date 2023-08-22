@extends('layouts.admin')

@section('title', 'Admin Poli')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('poli.index') }}">Poli</a></li>
            <li class="breadcrumb-item active">Admin Poli {{ $poli->nama }}</li>
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
                <form action="{{ route('poli.admin-poli.index', $poli) }}" method="get">
                    <x-text-input type="search" name="search" placeholder="Cari sesuatu..."
                        value="{{ request('search') }}" />
                </form>
                <a href="{{ route('poli.admin-poli.create', $poli) }}" class="btn btn-primary px-2" style="width: 150px">
                    <i class="fa-solid fa-plus"></i> Tambah Data
                </a>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">No Telpon</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($admin as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->user->nama ?? '-' }}</td>
                                <td>{{ $item->user->email ?? '-' }}</td>
                                <td>{{ $item->nip ?? '-' }}</td>
                                <td>{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $item->user->no_telp ?? '-' }}</td>
                                <td>
                                    <div class="d-flex" style="gap: 5px">
                                        <a href="{{ route('poli.admin-poli.edit', [$poli, $item]) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <form action="{{ route('poli.admin-poli.destroy', [$poli, $item]) }}"
                                            method="post" onsubmit="return confirm('apakah anda yakin?')">
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
            {{ $admin->links() }}
        </div>
    </div>
@endsection
