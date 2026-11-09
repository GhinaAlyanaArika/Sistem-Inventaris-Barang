<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Aktivitas Sistem - Cetak PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @page {
            size: landscape;
            margin: 10mm;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #000;
        }
        .table th, .table td {
            font-size: 11px;
            padding: 8px;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container-fluid py-3">
        <div class="text-center mb-4">
            <h3 class="fw-bold mb-1">LOG AKTIVITAS SISTEM SMART INVENTORY</h3>
            <p class="text-muted small mb-0">Total Aktivitas Terfilter: {{ $totalLogs }} Data</p>
        </div>

        <table class="table table-bordered align-middle w-100">
            <thead class="table-light text-uppercase small" style="border-bottom: 2px solid #adb5bd;">
                <tr>
                    <th class="py-2" style="width: 50px;">No</th>
                    <th class="py-2" style="width: 160px;">Waktu</th>
                    <th class="py-2" style="width: 150px;">Pengguna</th>
                    <th class="py-2" style="width: 150px;">Aksi</th>
                    <th class="py-2">Deskripsi Aktivitas</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $index => $log)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $log->created_at ? $log->created_at->format('d/m/Y H:i:s') : '-' }}</td>
                        <td class="fw-bold">{{ $log->user->name ?? 'Sistem' }}</td>
                        <td class="fw-bold">{{ $log->action ?? '-' }}</td>
                        <td>{{ $log->description ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Tidak ada data log aktivitas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>