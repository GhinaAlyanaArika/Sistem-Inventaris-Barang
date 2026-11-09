<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reference_no',
        'action_type',
        'transaction_type',
        'action',
        'description',
        'ip_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper static untuk mencatat log aktivitas dengan ringkas dari mana saja
     */
    public static function log($actionType, $transactionType, $description, $referenceNo = null)
    {
        return static::create([
            'user_id'          => auth()->id(),
            'reference_no'     => $referenceNo,
            'action_type'      => $actionType,
            'transaction_type' => $transactionType,
            'action'           => $actionType . ' ' . $transactionType,
            'description'      => $description,
            'ip_address'       => request()->ip(),
        ]);
    }
}