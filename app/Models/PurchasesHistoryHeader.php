<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchasesHistoryHeader extends Model
{
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
            ->where('table_name', 'categories')
            ->orderBy('created_at', 'desc');
    }
}
