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

        <!-- Bootstrap 5 CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <style>
            body { font-family: 'Figtree', sans-serif; background-color: #f8f9fa; }
        </style>
    </head>
    <body class="d-flex align-items-center justify-content-center vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                    
                    <div class="text-center mb-4">
                        <a href="/" class="text-decoration-none text-dark d-flex flex-column align-items-center">
                            <!-- Ganti dengan logo aplikasi jika ada -->
                            <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center mb-2 shadow" style="width: 60px; height: 60px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                                    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.84l-6.5-2.6v7.922zM2.053 3.197 8 5.5l5.947-2.303L8 1.5z"/>
                                </svg>
                            </div>
                            <h4 class="fw-black mb-0">INVENTORY SYSTEM</h4>
                        </a>
                    </div>

                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-body p-5">
                            {{ $slot }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>