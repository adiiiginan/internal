@extends('layouts.app')

@section('title', 'PT JAYA NIAGA SEMESTA')
@section('site_title', 'FORMULIR PENGAJUAN PERDIN')

@section('content')
    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header bg-light">

            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops! Ada beberapa masalah:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="perdinForm" method="POST" action="{{ route('perdin.store') }}">
                    @csrf

                    <div class="row g-4">
                        <!-- Left column: trip & user info -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    value="{{ old('nama') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan" class="form-control"
                                    value="{{ old('jabatan') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="tujuan" class="form-label">Tempat Tujuan</label>
                                <input type="text" name="tujuan" id="tujuan" class="form-control"
                                    value="{{ old('tujuan') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="tgl_keberangkatan" class="form-label">Tanggal Keberangkatan</label>
                                <input type="date" name="tgl_keberangkatan" id="tgl_keberangkatan" class="form-control"
                                    value="{{ old('tgl_keberangkatan') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="tgl_kepulangan" class="form-label">Tanggal Kepulangan</label>
                                <input type="date" name="tgl_kepulangan" id="tgl_kepulangan" class="form-control"
                                    value="{{ old('tgl_kepulangan') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="keperluan" class="form-label">Keperluan</label>
                                <textarea name="keperluan" id="keperluan" rows="3" class="form-control" required>{{ old('keperluan') }}</textarea>
                            </div>


                        </div>

                        <!-- Right column: checkboxes + expenses -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Pengajuan (pilih)</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="jenis_pengajuan_checkbox[]"
                                            value="advance" id="jg_adv"
                                            {{ is_array(old('jenis_pengajuan_checkbox')) && in_array('advance', old('jenis_pengajuan_checkbox')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jg_adv">Advance</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="jenis_pengajuan_checkbox[]"
                                            value="expense" id="jg_exp"
                                            {{ is_array(old('jenis_pengajuan_checkbox')) && in_array('expense', old('jenis_pengajuan_checkbox')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jg_exp">Expense</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Rincian Biaya (pilih)</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="rincian_biaya[]"
                                            value="budget" id="rb_budget"
                                            {{ is_array(old('rincian_biaya')) && in_array('budget', old('rincian_biaya')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="rb_budget">Budget</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="rincian_biaya[]"
                                            value="unbudget" id="rb_unbudget"
                                            {{ is_array(old('rincian_biaya')) && in_array('unbudget', old('rincian_biaya')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="rb_unbudget">Unbudget</label>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <label for="transportasi" class="form-label">Biaya Transportasi (Rp)</label>
                                <input type="number" name="transportasi" id="transportasi" class="form-control"
                                    value="{{ old('transportasi', 0) }}" step="1000">
                            </div>

                            <div class="mb-3">
                                <label for="bbm" class="form-label">Biaya Bahan Bakar (Rp)</label>
                                <input type="number" name="bbm" id="bbm" class="form-control"
                                    value="{{ old('bbm', 0) }}" step="1000">
                            </div>

                            <div class="mb-3">
                                <label for="makan" class="form-label">Tunjangan Makan (Rp)</label>
                                <input type="number" name="makan" id="makan" class="form-control"
                                    value="{{ old('makan', 0) }}" step="1000">
                            </div>

                            <div class="mb-3">
                                <label for="dll" class="form-label">Biaya Lain-lain (Rp)</label>
                                <input type="number" name="dll" id="dll" class="form-control"
                                    value="{{ old('dll', 0) }}" step="1000">
                            </div>

                            <hr>

                            <div class="row g-2">
                                <div class="col-6">
                                    <label for="total" class="form-label">Total (Rp)</label>
                                    <input type="number" name="total" id="total" class="form-control" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="advance" class="form-label">Jumlah Advance (Rp)</label>
                                    <input type="number" name="advance" id="advance" class="form-control"
                                        value="{{ old('advance', 0) }}" step="1000">
                                </div>
                                <div class="col-6">
                                    <label for="expense" class="form-label mt-2">Jumlah Expense (Rp)</label>
                                    <input type="number" name="expense" id="expense" class="form-control bg-light"
                                        readonly>
                                </div>
                                <div class="col-6">
                                    <label for="pengembalian" class="form-label mt-2">Pengembalian/Kekurangan (Rp)</label>
                                    <input type="number" name="pengembalian" id="pengembalian" class="form-control"
                                        readonly>
                                </div>
                            </div>

                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const transportasiInput = document.getElementById('transportasi');
                const bbmInput = document.getElementById('bbm');
                const makanInput = document.getElementById('makan');
                const dllInput = document.getElementById('dll');
                const totalInput = document.getElementById('total');
                const advanceInput = document.getElementById('advance');
                const expenseInput = document.getElementById('expense');

                function calculateTotal() {
                    const transportasi = parseFloat(transportasiInput.value) || 0;
                    const bbm = parseFloat(bbmInput.value) || 0;
                    const makan = parseFloat(makanInput.value) || 0;
                    const dll = parseFloat(dllInput.value) || 0;
                    const total = transportasi + bbm + makan + dll;
                    totalInput.value = total.toFixed(0);
                    calculateExpense();
                }

                function calculateExpense() {
                    const total = parseFloat(totalInput.value) || 0;
                    const advance = parseFloat(advanceInput.value) || 0;
                    const expense = total - advance;
                    expenseInput.value = expense.toFixed(0);
                }

                const inputsToWatch = [transportasiInput, bbmInput, makanInput, dllInput, advanceInput];
                inputsToWatch.forEach(input => {
                    if (input) {
                        input.addEventListener('input', () => {
                            calculateTotal();
                        });
                    }
                });

                // Initial calculation on page load
                calculateTotal();
            });
        </script>
    @endpush
@endsection
