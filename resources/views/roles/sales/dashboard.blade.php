@extends('roles.Layout.partials.app')

@section('title', 'Dashboard Kunjungan')

@section('content')
    <div class="container-fluid py-6">

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Card Kunjungan --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="mb-0">Dashboard Kunjungan</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modalCreateKunjungan">
                        + Tambah Kunjungan
                    </button>
                </div>

                {{-- Table Data Kunjungan --}}
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Customer</th>
                                <th>PIC</th>
                                <th>Kontak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kunjungan as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                    <td>{{ $item->customer }}</td>
                                    <td>{{ $item->pic }}</td>
                                    <td>{{ $item->kontak }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#modalDetail{{ $item->id }}">
                                            Detail
                                        </button>
                                        <button class="btn btn-sm btn-warning">Edit</button>
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data kunjungan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Modal Detail (letakkan di luar tabel) --}}
                @foreach ($kunjungan as $item)
                    <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1"
                        aria-labelledby="modalDetailLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalDetailLabel{{ $item->id }}">Detail Kunjungan -
                                        {{ $item->customer }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Prospek</th>
                                                <th>Aksi</th>
                                                <th>Next Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($item->details as $detail)
                                                <tr>
                                                    <td>{{ $detail->prospek }}</td>
                                                    <td>{{ $detail->aksi }}</td>
                                                    <td>{{ $detail->next }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">Tidak ada detail</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <!-- Modal Create Kunjungan -->
    <div class="modal fade" id="modalCreateKunjungan" tabindex="-1" aria-labelledby="modalCreateKunjunganLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('sales.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCreateKunjunganLabel">Tambah Kunjungan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Data Kunjungan -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Kunjungan</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                </div>
                                <div class="mb-3">
                                    <label for="customer" class="form-label">Nama Customer</label>
                                    <input type="text" class="form-control" id="customer" name="customer" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kontak" class="form-label">Kontak Person</label>
                                    <input type="text" class="form-control" id="kontak" name="kontak">
                                </div>
                                <div class="mb-3">
                                    <label for="pic" class="form-label">PIC</label>
                                    <input type="text" class="form-control" id="pic" name="pic">
                                </div>
                            </div>

                            <!-- Data Detail -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prospeK" class="form-label">Prospek</label>
                                    <input type="text" class="form-control" id="prospek" name="prospek">
                                </div>
                                <div class="mb-3">
                                    <label for="aksi" class="form-label">Aksi</label>
                                    <input type="text" class="form-control" id="aksi" name="aksi">
                                </div>
                                <div class="mb-3">
                                    <label for="next" class="form-label">Next Action</label>
                                    <input type="text" class="form-control" id="next" name="next">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
