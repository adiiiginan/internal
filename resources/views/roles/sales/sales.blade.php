<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sales</title>
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
                <h1>Sales Page</h1>
                <p>Welcome, {{ $user->name }}. Here you can manage leads and customers.</p>

                <hr>

                <h5>Sales actions</h5>
                <ul>
                    <li>View leads</li>
                    <li>Create opportunities</li>
                    <li>Manage customer interactions</li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
