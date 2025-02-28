<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Finance Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contributions*') ? 'active' : '' }}" href="{{ route('contributions.index') }}">Contributions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('loans*') ? 'active' : '' }}" href="{{ route('loans.index') }}">Loans</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('transactions*') ? 'active' : '' }}" href="{{ route('transactions.index') }}">Transactions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('loan_repayments*') ? 'active' : '' }}" href="{{ route('loan_repayments.index') }}">Loan Repayments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('reports*') ? 'active' : '' }}" href="{{ route('reports.index') }}">Reports</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
