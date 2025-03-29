<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý chi tiêu - {{ auth()->user()->isAdmin() ? 'Admin' : ' CashFlowX ' }}</title>
    {{-- link logo --}}
    <link rel="icon" href="{{ asset('img/logo/logo.png') }}">
    {{-- link css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Custom CSS cho giao diện quản lý chi tiêu */
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            color: #fff !important;
        }
        .nav-link {
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #ffd700 !important; /* Vàng nhẹ khi hover */
        }
        .container {
            max-width: 1200px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        .btn-primary {
            background: linear-gradient(45deg, #007bff, #00d4ff);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(45deg, #0056b3, #00aaff);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg {{ auth()->user()->isAdmin() ? 'navbar-dark bg-dark' : 'navbar-light bg-primary' }}">
        <div class="container">
            <a class="navbar-brand" href="#">
                {{ auth()->user()->isAdmin() ? 'Admin Panel' : 'Expense Tracker' }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users') }}"><i class="fas fa-users"></i> Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.reports') }}"><i class="fas fa-chart-bar"></i> Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.notifications') }}"><i class="fas fa-bell"></i> Notifications</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('expenses.index') }}"><i class="fas fa-wallet"></i> Expenses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reports.index') }}"><i class="fas fa-chart-pie"></i> Reports</a>
                        </li>
                    @endif
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">
                            {{ auth()->user()->isAdmin() ? 'Admin' : 'Welcome' }}, {{ auth()->user()->email }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-white"><i class="fas fa-sign-out-alt"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-buttons-bs5@2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    
    <script>
        window.jQuery = window.$ = $;
        window.Swal = Swal;
        window.echarts = echarts;
        window.moment = moment;

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        @if(session('success'))
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
        @endif
        @if(session('error'))
            Toast.fire({
                icon: "error",
                title: "{{ session('error') }}"
            });
        @endif
    </script>
    @yield('scripts')
</body>
</html>