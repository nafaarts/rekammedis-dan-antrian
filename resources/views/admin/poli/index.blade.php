@extends('layouts.admin')

@section('title', 'Poli')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Poli</li>
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
                <form action="{{ route('poli.index') }}" method="get">
                    <x-text-input type="search" name="search" placeholder="Cari sesuatu..."
                        value="{{ request('search') }}" />
                </form>
                <a href="{{ route('poli.create') }}" class="btn btn-primary px-2" style="width: 150px">
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
                            <th scope="col">Admin</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($poli as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->admin->count() }} orang</td>
                                <td>{{ $item->catatan ?? '-' }}</td>
                                <td>
                                    <div class="d-flex" style="gap: 5px">
                                        <a href="{{ route('poli.admin-poli.index', $item) }}" class="btn btn-sm btn-info">
                                            <i class="fa-solid fa-user-tie"></i>
                                        </a>
                                        <a href="{{ route('poli.edit', $item) }}" class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <form action="{{ route('poli.destroy', $item) }}" method="post"
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
                                <td colspan="4" class="text-center py-5">
                                    <span>Tidak ada data</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $poli->links() }}
        </div>
    </div>
@endsection
