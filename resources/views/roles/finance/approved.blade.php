@extends('roles.Layout.partials.app')
@section('title', 'Finance - Approved Perdin List')
@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Approved Perdin Submissions</span>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($perdins->isEmpty())
                    <div class="alert alert-info">No approved perdin records found.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Tujuan</th>
                                    <th>Total</th>
                                    <th>Advance</th>
                                    <th>Expense</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($perdins as $i => $p)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $p->nama }}</td>
                                        <td>{{ $p->jabatan }}</td>
                                        <td>{{ $p->tujuan }}</td>
                                        <td>{{ number_format($p->total, 2) }}</td>
                                        <td>{{ number_format($p->advance, 2) }}</td>
                                        <td>{{ number_format($p->expense, 2) }}</td>
                                        <td>
                                            <span class="badge bg-success">Approved</span>
                                        </td>
                                        <td>{{ $p->created_at }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('roles.finance.pdf', $p->id) }}"
                                                class="btn btn-sm btn-secondary" target="_blank">PDF</a>
                                            <form action="{{ route('roles.finance.destroy', $p->id) }}" method="POST"
                                                style="display:inline"
                                                onsubmit="return confirm('Are you sure you want to delete this perdin?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
