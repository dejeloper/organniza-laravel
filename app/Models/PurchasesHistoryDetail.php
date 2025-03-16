<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class PurchasesHistoryDetail extends Model implements Auditable
{
    use HasFactory, SoftDeletes, AuditableTrait;

    protected $fillable = [
        'purchases_history_header_id',
        'product_id',
        'amount_product',
        'unit_product_id',
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

    protected $auditExclude = ['created_at', 'updated_at', 'deleted_at'];
    protected $auditEvents = ['created', 'updated', 'deleted'];
}
