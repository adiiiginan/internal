<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">App</a>
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-sm btn-outline-light">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h4>Welcome, {{ $user->name }}</h4>
                <p>Your role: <strong>{{ $user->role }}</strong></p>

                <hr>

                <h5>Available actions</h5>
                <ul>
                    @if ($user->isSuperadmin() || $user->isAdmin())
                        <li>Manage users</li>
                    @endif

                    @if ($user->isSales())
                        <li>View leads</li>
                    @endif

                    @if ($user->isFinance())
                        <li>View reports</li>
                    @endif

                    @if ($user->isGudang())
                        <li>Manage inventory</li>
                    @endif
                </ul>

                <hr>

                <h5>Quick links</h5>
                <div class="d-flex gap-2 flex-wrap">
                    @if ($user->isSuperadmin())
                        <a href="{{ route('role.superadmin') }}" class="btn btn-sm btn-primary">Superadmin Page</a>
                    @endif

                    @if ($user->isAdmin())
                        <a href="{{ route('role.admin') }}" class="btn btn-sm btn-secondary">Admin Page</a>
                    @endif

                    @if ($user->isSales())
                        <a href="{{ route('role.sales') }}" class="btn btn-sm btn-success">Sales Page</a>
                    @endif

                    @if ($user->isFinance())
                        <a href="{{ route('role.finance') }}" class="btn btn-sm btn-warning">Finance Page</a>
                    @endif

                    @if ($user->isGudang())
                        <a href="{{ route('role.gudang') }}" class="btn btn-sm btn-info text-white">Gudang Page</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>
