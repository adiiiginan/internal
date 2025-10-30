@extends('admin.Layout.partials.app')

@section('title', 'Daftar Permintaan Barang')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                            Daftar Permintaan Barang</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">Permintaan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="card card-flush">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                                <input type="text" id="searchInput" class="form-control form-control-solid w-250px ps-12"
                                    placeholder="Cari Permintaan" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="permintaanTable">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Divisi</th>
                                    <th>Jenis Permintaan</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Deskripsi</th>
                                    <th>Supplier</th>
                                    <th>Customer</th>
                                    <th>Deadline</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($permintaan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($item->gambar)
                                                <img src="{{ asset('backend/assets/media/gambar/' . $item->gambar) }}"
                                                    alt="gambar" width="60" height="60"
                                                    style="object-fit: cover; border-radius: 8px; cursor:pointer;"
                                                    data-bs-toggle="modal" data-bs-target="#gambarModal{{ $item->id }}">

                                                <!-- Modal -->
                                                <div class="modal fade" id="gambarModal{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="gambarModalLabel{{ $item->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content bg-transparent border-0 shadow-none">
                                                            <div class="modal-body text-center">
                                                                <img src="{{ asset('backend/assets/media/gambar/' . $item->gambar) }}"
                                                                    class="img-fluid rounded shadow" alt="gambar besar">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-muted">Tidak ada</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->divisi }}</td>
                                        <td>{{ $item->jenis_permintaan }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>{{ $item->supplier }}</td>
                                        <td>{{ $item->customer }}</td>
                                        <td>{{ $item->etd }}</td>
                                        <th>
                                            <div class="card-toolbar">
                                                <a href="{{ route('admin.permintaan.pdf', $item->id) }}" target="_blank"
                                                    class="btn btn-sm btn-light btn-active-light-primary">
                                                    <i class="fas fa-file-pdf text-danger"></i> Generate PDF
                                                </a>

                                            </div>

                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content-->
    </div>
@endsection

@push('styles')
    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
@endpush

@push('scripts')
    {{-- jQuery + DataTables --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#permintaanTable').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });

            // search input custom
            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });

            // filter jenis permintaan (optional kalau ada dropdown filter)
            $('#jenisFilter').on('change', function() {
                var val = this.value;
                if (val) {
                    table.column(4).search(val, true, false).draw();
                } else {
                    table.column(4).search('').draw();
                }
            });
        });
    </script>
@endpush
