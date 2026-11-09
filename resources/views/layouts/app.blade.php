<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Smart Inventory') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- (Opsional) Bootstrap Icons - Jika sewaktu-waktu butuh icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { 
            background-color: #f8f9fa; 
            font-family: 'Figtree', sans-serif; /* Menggunakan font modern bawaan Breeze */
        }
        
        .sidebar {
            min-height: 100vh; 
            width: 260px; 
            background-color: #212529;
            position: fixed; 
            left: 0; 
            top: 0; 
            z-index: 1000; 
            transition: all 0.3s ease-in-out;
        }
        
        .main-content { 
            margin-left: 260px; 
            padding-top: 70px; 
            transition: all 0.3s ease-in-out; 
            min-height: 100vh;
        }
        
        .topbar {
            position: fixed; 
            top: 0; 
            right: 0; 
            left: 260px;
            height: 65px; 
            z-index: 999; 
            transition: all 0.3s ease-in-out;
        }
        
        @media (max-width: 768px) {
            .sidebar { margin-left: -260px; }
            .sidebar.show { margin-left: 0; }
            .main-content { margin-left: 0; }
            .topbar { left: 0; }
        }
        
        .nav-link { 
            color: #adb5bd; 
            padding: 0.8rem 1.2rem; 
            font-weight: 600; 
            transition: all 0.2s;
        }
        
        .nav-link:hover, .nav-link.active { 
            color: #fff; 
            background-color: #0d6efd; 
            border-radius: 0.5rem; 
        }
    </style>
</head>
<body>
    
    <!-- Memuat Sidebar & Topbar (Pastikan layouts/navigation.blade.php juga pakai syntax Bootstrap 5 ya) -->
    @include('layouts.navigation')

    <!-- Area Konten Utama -->
    <div class="main-content" id="main-content">
        @isset($header)
            <header class="bg-white shadow-sm py-3 mb-4" style="border-bottom: 1px solid #dee2e6;">
                <div class="container-fluid px-4 max-w-7xl mx-auto">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="container-fluid px-4 pb-5">
            <!-- Flash Message Notifikasi -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show fw-bold text-dark shadow-sm rounded-3 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill text-success me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show fw-bold text-dark shadow-sm rounded-3 mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            {{ $slot }}
        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script untuk Toggle Sidebar di HP (Dengan null check agar tidak error)
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            
            if(sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
        });
    </script>
</body>
</html>