@extends('roles.Layout.partials.app')

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
                        <div class="card-toolbar d-flex justify-content-end gap-5">
                            <a href="{{ route('admin.permintaan.exportExcel') }}" class="btn btn-light-primary">
                                <i class="ki-outline ki-exit-up fs-2"></i>Export Excel
                            </a>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <div class="table-responsive">
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
                                        <th>Status</th>
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
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#gambarModal{{ $item->id }}">

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="gambarModal{{ $item->id }}"
                                                        tabindex="-1" aria-labelledby="gambarModalLabel{{ $item->id }}"
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
                                            <td>
                                                @if ($item->status == 'pending')
                                                    <span class="badge badge-light-warning">Pending</span>
                                                @elseif($item->status == 'on progress')
                                                    <span class="badge badge-light-info">On Progress</span>
                                                @elseif($item->status == 'done')
                                                    <span class="badge badge-light-success">Done</span>
                                                @else
                                                    <span class="badge badge-light-secondary">{{ $item->status }}</span>
                                                @endif
                                            </td>
                                            <th>
                                                <div class="card-toolbar d-flex gap-2">
                                                    <a href="{{ route('admin.permintaan.pdf', $item->id) }}"
                                                        class="btn btn-sm btn-light btn-active-light-primary">
                                                        <i class="ki-outline ki-exit-up fs-4"></i> PDF
                                                    </a>
                                                    <button class="btn btn-sm btn-light btn-active-light-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#statusModal{{ $item->id }}">
                                                        <i class="fas fa-edit"></i> Status
                                                    </button>
                                                    <form action="{{ route('admin.permintaan.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-sm btn-light btn-active-light-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
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
        </div>
        <!--end::Content-->
    </div>

    <!-- Status Update Modals -->
    @foreach ($permintaan as $item)
        <div class="modal fade" id="statusModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="statusModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel{{ $item->id }}">Update Status Permintaan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.permintaan.updateStatus', $item->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="status{{ $item->id }}" class="form-label">Status</label>
                                <select class="form-select" id="status{{ $item->id }}" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="on progress" {{ $item->status == 'on progress' ? 'selected' : '' }}>On
                                        Progress</option>
                                    <option value="done" {{ $item->status == 'done' ? 'selected' : '' }}>Done</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
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
