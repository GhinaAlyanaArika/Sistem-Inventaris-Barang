<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BackupController extends Controller
{
    public function download()
    {
        try {
            // Mengambil daftar tabel tanpa memerlukan Doctrine DBAL (Aman untuk Laravel 11/12)
            $tables = Schema::getTableListing();
            
            $sqlScript = "-- Backup Database Smart Inventory System\n";
            $sqlScript .= "-- Tanggal: " . date('Y-m-d H:i:s') . "\n\n";

            foreach ($tables as $table) {
                $rows = DB::table($table)->get();
                if ($rows->count() > 0) {
                    $sqlScript .= "-- Data untuk tabel `$table` --\n";
                    foreach ($rows as $row) {
                        $rowArray = (array) $row;
                        $keys = array_keys($rowArray);
                        $fields = implode("`, `", $keys);
                        
                        $values = array_map(function ($value) {
                            if (is_null($value)) {
                                return "NULL";
                            }
                            return "'" . addslashes($value) . "'";
                        }, array_values($rowArray));

                        $valString = implode(", ", $values);
                        $sqlScript .= "INSERT INTO `$table` (`$fields`) VALUES ($valString);\n";
                    }
                    $sqlScript .= "\n";
                }
            }

            $fileName = 'backup_db_' . date('Y-m-d_H-i-s') . '.sql';

            // Catat log aktivitas sistem
            if (class_exists('App\Models\ActivityLog') && method_exists('App\Models\ActivityLog', 'log')) {
                ActivityLog::log('Buat', 'Pengaturan Sistem', 'Mengunduh backup database SQL', 'BACKUP-DB');
            }

            return response($sqlScript)
                ->header('Content-Type', 'text/plain')
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses backup database: ' . $e->getMessage());
        }
    }
}