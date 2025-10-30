@extends('roles.Layout.partials.app')
@section('title', 'Finance - Perdin List')
@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Perdin Submissions</span>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($perdins->isEmpty())
                    <div class="alert alert-info">No pending perdin records found.</div>
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
                                            @if ($p->status == 1)
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($p->status == 2)
                                                <span class="badge bg-success">Approved</span>
                                            @elseif($p->status == 3)
                                                <span class="badge bg-danger">Rejected</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $p->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $p->created_at }}</td>
                                        <td class="text-center">
                                            @if ($p->status == 1)
                                                <form action="{{ route('roles.finance.approve', $p->id) }}" method="POST"
                                                    style="display:inline">
                                                    @csrf
                                                    <button class="btn btn-sm btn-success" type="submit">Approve</button>
                                                </form>
                                                <form action="{{ route('roles.finance.reject', $p->id) }}" method="POST"
                                                    style="display:inline">
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger" type="submit">Reject</button>
                                                </form>
                                            @else
                                                <a href="{{ route('roles.finance.pdf', $p->id) }}"
                                                    class="btn btn-sm btn-secondary" target="_blank">PDF</a>
                                            @endif
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
