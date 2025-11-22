<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem SkillHub - Uji Kompetensi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f3f4f6;
            font-family: sans-serif;
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            background: linear-gradient(to right, #1e293b, #334155);
        }
        .navbar-brand { font-weight: 700; letter-spacing: 0.5px; }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
            background-color: #ffffff;
        }
        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            padding: 15px 20px;
            font-weight: 600;
            color: #334155;
            border-radius: 10px 10px 0 0 !important;
        }
        .card-body { padding: 25px; }

        .btn { border-radius: 6px; font-weight: 500; padding: 8px 16px; }
        .btn-primary { background-color: #3b82f6; border-color: #3b82f6; }
        .btn-primary:hover { background-color: #2563eb; border-color: #2563eb; }

        .table thead th {
            background-color: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            color: #475569;
            font-weight: 600;
        }
        .badge { font-weight: 500; padding: 6px 10px; border-radius: 4px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark mb-5">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                SkillHub
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('peserta*') ? 'active text-warning fw-bold' : '' }}" href="{{ route('peserta.index') }}">Data Peserta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('kelas*') ? 'active text-warning fw-bold' : '' }}" href="{{ route('kelas.index') }}">Data Kelas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pendaftaran*') ? 'active text-warning fw-bold' : '' }}" href="{{ route('pendaftaran.index') }}">Transaksi Pendaftaran</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-start border-5 border-success" role="alert">
                <div class="d-flex align-items-center">
                    <strong class="me-2">Berhasil!</strong> {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-start border-5 border-danger" role="alert">
                <div class="d-flex align-items-center">
                    <strong class="me-2">Gagal!</strong> {{ session('error') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>