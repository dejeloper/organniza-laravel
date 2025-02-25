<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchasesHistoryHeader extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'year',
        'month',
        'amount_purchase',
        'total_purchase',
        'enabled',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'total_purchase' => 'float',
    ];

    public function purchasesHistoryDetails()
    {
        return $this->hasMany(PurchasesHistoryDetail::class, 'purchases_history_header_id');
    }

    public function modifications()
    {
        return $this->hasMany(ModificationLog::class, 'record_id')
            ->where('table_name', 'purchases_history_headers')
            ->orderBy('created_at', 'desc');
    }
}
