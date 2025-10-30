@extends('roles.Layout.partials.app')
@section('title', 'Superadmin Dashboard')

@section('content')
    <div class="container py-4">
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted">Users</h6>
                        <h2 class="display-6">{{ $usersCount ?? 0 }}</h2>
                        <a href="" class="btn btn-sm btn-primary mt-2">Manage Users</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted">Permintaan Barang</h6>
                        <h2 class="display-6">{{ $permintaanCount ?? 0 }}</h2>
                        <a href="{{ route('role.admin') }}" class="btn btn-sm btn-primary mt-2">View Permintaan</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted">Perdin</h6>
                        <h2 class="display-6">{{ $perdinCount ?? 0 }}</h2>
                        <a href="{{ route('role.finance') }}" class="btn btn-sm btn-primary mt-2">View Perdin</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted">Kunjungan</h6>
                        <h2 class="display-6">{{ $kunjunganCount ?? 0 }}</h2>
                        <a href="{{ route('sales.dashboard') }}" class="btn btn-sm btn-primary mt-2">View Kunjungan</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent items -->
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <strong>Recent Users</strong>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentUsers as $i => $u)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $u->name ?? $u->username }}</td>
                                            <td>{{ $u->role }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No users</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <strong>Recent Permintaan</strong>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentPermintaan as $i => $p)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $p->nama }}</td>
                                            <td>{{ $p->jenis_permintaan }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No permintaan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <strong>Recent Perdin</strong>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentPerdin as $i => $pp)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $pp->nama }}</td>
                                            <td>{{ number_format($pp->total ?? 0, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No perdin</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
