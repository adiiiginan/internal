<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark">
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
                <h1>Gudang Page</h1>
                <p>Welcome, {{ $user->name }}. Manage inventory and stock here.</p>

                <hr>

                <h5>Gudang actions</h5>
                <ul>
                    <li>Manage inventory</li>
                    <li>Receive shipments</li>
                    <li>Pick and pack orders</li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
