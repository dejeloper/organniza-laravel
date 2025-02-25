<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchasesHistoryDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'purchases_history_header_id',
        'product_id',
        'amount_product',
        'unit_product',
        'sub_total_product',
        'enabled',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'sub_total_product' => 'float',
    ];

    public function purchasesHistoryHeader()
    {
        return $this->belongsTo(PurchasesHistoryHeader::class, 'purchases_history_header_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_product');
    }

    public function modifications()
    {
        return $this->hasMany(ModificationLog::class, 'record_id')
            ->where('table_name', 'purchases_history_details')
            ->orderBy('created_at', 'desc');
    }
}
