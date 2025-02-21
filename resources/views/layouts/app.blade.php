<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HODYVIKU</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #dde4e0;
        }
        .container {
            margin-top: 20px;
        }
        .navbar {
            background-color: #c8cfc0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }       
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Custom Pagination Styles */
    .pagination {
        --bs-pagination-color: #007bff;
        --bs-pagination-active-bg: #007bff;
        --bs-pagination-active-color: #fff;
        --bs-pagination-hover-bg: #e9ecef;
    }

    .pagination .page-link {
        font-size: 1rem;
        padding: 0.5rem 1rem;
        line-height: 1.5;
    }

    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child .page-link {
        border-radius: 0.25rem;
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light  mb-3">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">HODYVIKU</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('accounts.*') ? 'active' : '' }}" href="{{ route('accounts.index') }}">Comptes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('transfers.*') ? 'active' : '' }}" href="{{ route('transfers.index') }}">Transferts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('loans.*') ? 'active' : '' }}" href="{{ route('loans.index') }}">Loans</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>