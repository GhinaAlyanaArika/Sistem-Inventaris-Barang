<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    private function buildQuery(Request $request)
    {
        $query = ActivityLog::with('user')->latest();

        if ($request->filled('start_date')) {
            $query->where('created_at', '>=', $request->start_date . ' 00:00:00');
        }

        if ($request->filled('end_date')) {
            $query->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }

        if ($request->filled('action_type')) {
            $type = strtolower($request->action_type);
            $query->where(function($q) use ($type) {
                if ($type === 'buat') {
                    $q->where('action', 'like', '%buat%')->orWhere('action', 'like', '%tambah%');
                } elseif ($type === 'update') {
                    $q->where('action', 'like', '%update%')->orWhere('action', 'like', '%edit%')->orWhere('action', 'like', '%ubah%');
                } elseif ($type === 'hapus') {
                    $q->where('action', 'like', '%hapus%');
                } else {
                    $q->where('action', 'like', "%{$type}%");
                }
            });
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('action', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($u) use ($search) {
                      $u->where('name', 'like', "%{$search}%");
                  });
            });
        }

        return $query;
    }

    public function index(Request $request)
    {
        $query = $this->buildQuery($request);

        $totalLogs = (clone $query)->count();
        $totalCreate = (clone $query)->where(function($q) {
            $q->where('action', 'like', '%buat%')->orWhere('action', 'like', '%tambah%');
        })->count();
        $totalUpdate = (clone $query)->where(function($q) {
            $q->where('action', 'like', '%update%')->orWhere('action', 'like', '%edit%')->orWhere('action', 'like', '%ubah%');
        })->count();
        $totalDelete = (clone $query)->where(function($q) {
            $q->where('action', 'like', '%hapus%');
        })->count();

        $logs = $query->paginate(10)->withQueryString();
        $users = User::all();

        return view('activity-logs', compact(
            'logs', 
            'users', 
            'totalLogs', 
            'totalCreate', 
            'totalUpdate', 
            'totalDelete'
        ));
    }

    public function print(Request $request)
    {
        $query = $this->buildQuery($request);
        $logs = $query->get();
        $totalLogs = $logs->count();

        return view('activity_logs.print', compact('logs', 'totalLogs'));
    }

    public function export(Request $request)
    {
        $query = $this->buildQuery($request);
        $logs = $query->get();

        $filename = 'Log_Aktivitas_' . date('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($logs) {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF");

            fputcsv($file, ['No', 'Waktu', 'Pengguna', 'Aksi', 'Deskripsi Aktivitas']);

            foreach ($logs as $index => $log) {
                fputcsv($file, [
                    $index + 1,
                    $log->created_at ? $log->created_at->format('d/m/Y H:i:s') : '-',
                    $log->user->name ?? 'Sistem',
                    $log->action ?? '-',
                    $log->description ?? '-'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}