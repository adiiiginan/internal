@extends('roles.Layout.partials.app')

@section('title', 'Barang Masuk')

@section('content')
    <div class="container-fluid py-6">

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Card Barang Masuk --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="mb-0">Data Barang Masuk</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modalCreateBarang">
                        + Tambah Barang Masuk
                    </button>
                </div>

                {{-- Table Data Barang --}}
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>AWB</th>
                                <th>Pengirim</th>
                                <th>Forward</th>

                                <th>User Check</th>
                                <th>Penerima</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($barangMasuk as $index => $bm)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $bm->awb }}</td>
                                    <td>{{ $bm->pengirim }}</td>
                                    <td>{{ $bm->forward }}</td>

                                    <td>{{ $bm->iduser }}</td>
                                    <td>{{ $bm->check }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#modalDetail{{ $bm->id }}">
                                            Detail
                                        </button>
                                        <button class="btn btn-sm btn-warning">Edit</button>
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data barang masuk</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Modal Detail untuk barang_details --}}
                @foreach ($barangMasuk as $bm)
                    <div class="modal fade" id="modalDetail{{ $bm->id }}" tabindex="-1"
                        aria-labelledby="modalDetailLabel{{ $bm->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalDetailLabel{{ $bm->id }}">Detail Barang - AWB:
                                        {{ $bm->awb }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Barang</th>
                                                <th>Qty</th>
                                                <th>Dimensi (P x L x T)</th>
                                                <th>Keterangan</th>
                                                <th>Gambar</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($bm->details as $detail)
                                                <tr>
                                                    <td>{{ $detail->barang }}</td>
                                                    <td>{{ $detail->qty }}</td>
                                                    <td>{{ $detail->panjang }} x {{ $detail->lebar }} x
                                                        {{ $detail->tinggi }}</td>
                                                    <td>{{ $detail->ket }}</td>

                                                    <td>
                                                        @if ($detail->gambar)
                                                            <img src="{{ asset('backend/assets/media/barang/' . $detail->gambar) }}"
                                                                alt="gambar" width="80">
                                                        @else
                                                            <span class="text-muted">Tidak ada</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">Tidak ada detail barang</td>
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

    <!-- Modal Create Barang -->
    <div class="modal fade" id="modalCreateBarang" tabindex="-1" aria-labelledby="modalCreateBarangLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('gudang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCreateBarangLabel">Tambah Barang Masuk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Data Barang Masuk -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="awb" class="form-label">AWB</label>
                                    <input type="text" class="form-control" id="awb" name="awb" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pengirim" class="form-label">Pengirim</label>
                                    <input type="text" class="form-control" id="pengirim" name="pengirim" required>
                                </div>
                                <div class="mb-3">
                                    <label for="forward" class="form-label">Forwarder</label>
                                    <input type="text" class="form-control" id="forward" name="forward">
                                </div>

                                <div class="mb-3">
                                    <label for="kode_penerimaan" class="form-label">Penerima</label>
                                    <input type="text" class="form-control" id="check" name="check">
                                </div>
                                <div class="mb-3">
                                    <label for="kode_penerimaan" class="form-label">User Check</label>
                                    <input type="text" class="form-control" id="iduser" name="iduser">
                                </div>
                            </div>

                            <!-- Data Barang Detail -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="barang" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="barang" name="barang">
                                </div>
                                <div class="mb-3">
                                    <label for="qty" class="form-label">Qty</label>
                                    <input type="number" class="form-control" id="qty" name="qty">
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="panjang" class="form-label">Panjang</label>
                                        <input type="number" class="form-control" id="panjang" name="panjang"
                                            oninput="hitungDimensi()">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="lebar" class="form-label">Lebar</label>
                                        <input type="number" class="form-control" id="lebar" name="lebar"
                                            oninput="hitungDimensi()">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="tinggi" class="form-label">Tinggi</label>
                                        <input type="number" class="form-control" id="tinggi" name="tinggi"
                                            oninput="hitungDimensi()">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="dimensi" class="form-label">Dimensi (Volume cm³)</label>
                                    <input type="number" class="form-control" id="dimensi" name="dimensi" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="ket" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="ket" name="ket"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Upload Gambar</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar"
                                        accept="image/*">
                                    <img id="preview" src="" alt="Preview"
                                        style="max-width:100px; margin-top:10px; display:none;">
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

    {{-- Script Preview Gambar & Hitung Dimensi --}}
    <script>
        document.getElementById("gambar").addEventListener("change", function(e) {
            let reader = new FileReader();
            reader.onload = function(e) {
                let preview = document.getElementById("preview");
                preview.src = e.target.result;
                preview.style.display = "block";
            };
            reader.readAsDataURL(this.files[0]);
        });

        function hitungDimensi() {
            let p = parseFloat(document.getElementById("panjang").value) || 0;
            let l = parseFloat(document.getElementById("lebar").value) || 0;
            let t = parseFloat(document.getElementById("tinggi").value) || 0;
            let dimensi = p * l * t / 5000;
            document.getElementById("dimensi").value = dimensi;
        }
    </script>
@endsection
