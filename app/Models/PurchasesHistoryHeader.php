<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class PurchasesHistoryHeader extends Model implements Auditable
{
    use HasFactory, SoftDeletes, AuditableTrait;

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

    protected $auditExclude = ['created_at', 'updated_at', 'deleted_at'];
    protected $auditEvents = ['created', 'updated', 'deleted'];
}
