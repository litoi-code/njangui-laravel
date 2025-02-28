<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Management</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation Bar -->
        <nav class="bg-blue-600 text-white p-4">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold"> Gestion HODYVIKU</h1>
                <ul class="flex space-x-4">
                    <li><a href="{{ route('home') }}" class="hover:underline">Home</a></li>
                    <li><a href="{{ route('contributions.index') }}" class="hover:underline">Contributions</a></li>
                    <li><a href="{{ route('members.index') }}" class="hover:underline">Membres</a></li>
                    <li><a href="{{ route('funds.index') }}" class="hover:underline">Caisses</a></li>
                    <li><a href="{{ route('loans.index') }}" class="hover:underline">Prêts</a></li>
                    <li><a href="{{ route('penalties.index') }}" class="hover:underline">Penalités</a></li>
                    {{-- <li><a href="{{ route('transactions.index') }}" class="hover:underline">Transactions</a></li> --}}
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="container mx-auto p-4 flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white text-center p-4">
            &copy; {{ date('Y') }} Finance Management System
        </footer>
    </div>
</body>
</html>