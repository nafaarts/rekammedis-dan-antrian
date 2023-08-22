@extends('layouts.admin')

@section('title', 'Antrian')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Antrian</li>
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
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No Antrian</th>
                            <th scope="col">Nomor Pendaftaran</th>
                            <th scope="col">Poli</th>
                            <th scope="col">Status Antrian</th>
                            <th scope="col">Status Kunjungan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($antrian as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->nomor_antrian }}</td>
                                <td><a
                                        href="{{ route('kunjungan.detail', $item->kunjungan) }}">{{ $item->kunjungan->kode_kunjungan }}</a>
                                </td>
                                <td>{{ $item->poli->nama }}</td>
                                <td>{{ $item->status_antrian ? 'sudah dipanggil' : 'belum dipanggil' }}</td>
                                <td>{{ $item->kunjungan->status_kunjungan ? 'sudah' : 'belum' }}</td>
                                <td>
                                    <div class="d-flex" style="gap: 5px">
                                        <a href="{{ route('antrian.update', $item) }}" @class([
                                            'btn btn-sm',
                                            'btn-success' => !$item->status_antrian,
                                            'btn-secondary' => $item->status_antrian,
                                        ])>
                                            <i class="fa-solid fa-check"></i> Konfirmasi Panggilan
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
            {{ $antrian->links() }}
        </div>
    </div>

    @can('is_admin')
        <div class="card">
            <div class="card-body pt-3">
                <h5 class="mb-3">Reset Antrian :</h5>
                <form action="{{ route('antrian.reset') }}" method="post"
                    onsubmit="return confirm('Apakah anda yakin untuk mereset antrian?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-fw fa-trash"></i> RESET ANTRIAN
                    </button>
                </form>
            </div>
        </div>
    @endcan

@endsection
