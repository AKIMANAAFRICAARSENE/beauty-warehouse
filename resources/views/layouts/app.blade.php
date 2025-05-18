<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty Warehouse System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #FF8800; /* Orange */
            --primary-dark: #CC6E00; /* Darker Orange */
            --secondary: #FFA940; /* Light Orange */
            --success: #10B981;
            --info: #06B6D4;
            --warning: #FF8800;
            --danger: #EF4444;
            --dark: #111111; /* Black */
            --light: #FFFFFF; /* White */
            --gray: #6B7280;
            --gray-light: #F3F3F3;
            --gray-dark: #222222;
            --body-bg: #FFFFFF; /* White background */
        }

        body {
            background-color: var(--body-bg);
            font-family: 'Inter', sans-serif;
            color: var(--dark);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure body takes at least full viewport height */
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 1rem;
            background: var(--dark);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            letter-spacing: -0.025em;
            color: var(--primary) !important;
        }

        .navbar .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.2s;
            color: var(--light) !important;
        }

        .navbar .nav-link.active, .navbar .nav-link:hover {
            background-color: var(--primary);
            color: var(--light) !important;
        }

        .card {
            border-radius: 0.75rem;
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
            background: var(--light);
            color: var(--dark);
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .card-header {
            border-bottom: none;
            padding: 1rem 1.25rem;
            font-weight: 600;
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            letter-spacing: -0.025em;
            color: var(--primary);
        }

        .btn {
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            color: var(--light);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: var(--light);
            box-shadow: 0 4px 12px rgba(255, 136, 0, 0.3);
        }

        .btn-success {
            background-color: var(--success);
            border-color: var(--success);
        }

        .btn-info {
            background-color: var(--info);
            border-color: var(--info);
            color: var(--light);
        }

        .btn-danger {
            background-color: var(--danger);
            border-color: var(--danger);
        }

        .btn-warning {
            background-color: var(--warning);
            border-color: var(--warning);
            color: var(--light);
        }

        .form-control, .form-select {
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            border-color: var(--gray-light);
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(255, 136, 0, 0.15);
            border-color: var(--primary);
        }

        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
            border-radius: 6px;
        }

        .bg-primary {
            background-color: var(--primary) !important;
        }

        .bg-success {
            background-color: var(--success) !important;
        }

        .bg-info {
            background-color: var(--info) !important;
        }

        .bg-warning {
            background-color: var(--warning) !important;
        }

        .bg-danger {
            background-color: var(--danger) !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        .text-success {
            color: var(--success) !important;
        }

        .text-info {
            color: var(--info) !important;
        }

        .text-warning {
            color: var(--warning) !important;
        }

        .text-danger {
            color: var(--danger) !important;
        }

        .table {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .table thead th {
            border-top: none;
            font-weight: 600;
        }

        .progress {
            height: 0.75rem;
            border-radius: 1rem;
            background-color: var(--gray-light);
        }

        .progress-bar {
            border-radius: 1rem;
        }

        .alert {
            border: none;
            border-radius: 0.75rem;
        }

        /* Custom components */
        .stat-card {
            position: relative;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .stat-card .icon {
            position: absolute;
            right: 1rem;
            bottom: 1rem;
            font-size: 4rem;
            opacity: 0.1;
        }

        /* App container */
        .app-container {
            max-width: 1400px;
            margin: 0 auto;
            flex-grow: 1; /* Allow the main content container to grow */
        }

        /* Page title section */
        .page-title {
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-light);
        }
    </style>
    @yield('styles')
</head>
<body>
    @section('navbar')
        <nav class="navbar navbar-expand-lg navbar-dark mb-4">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <i class="bi bi-box-seam me-2"></i>
                    Beauty Warehouse
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.index') }}">
                                <i class="bi bi-speedometer2 me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('suppliers.index') }}">
                                <i class="bi bi-truck me-1"></i> Suppliers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('companies.index') }}">
                                <i class="bi bi-building me-1"></i> Companies
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">
                                <i class="bi bi-box me-1"></i> Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.index') }}">
                                <i class="bi bi-bag me-1"></i> Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('employees.index') }}">
                                <i class="bi bi-people me-1"></i> Employees
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reports.index') }}">
                                <i class="bi bi-file-earmark-bar-graph me-1"></i> Reports
                            </a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    @show

    <div class="container app-container mt-4 mb-5">
        @yield('content')
    </div>

    <!-- Footer -->
    @section('footer')
        <footer class="bg-white py-4 mt-auto border-top">
            <div class="container">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <div class="mb-2 mb-md-0">
                        <span class="text-muted">&copy; 2025 Beauty Warehouse Management System</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="#" class="text-decoration-none text-muted me-3"><i class="bi bi-question-circle"></i> Help</a>
                        <a href="#" class="text-decoration-none text-muted"><i class="bi bi-envelope"></i> Contact</a>
                    </div>
                </div>
            </div>
        </footer>
    @show

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
