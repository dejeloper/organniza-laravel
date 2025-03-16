<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ChecklistDetail extends Model implements Auditable
{
    use HasFactory, SoftDeletes, AuditableTrait;

    protected $fillable = [
        'checklist_header_id',
        'product_id',
        'pantry_amount_product',
        'pantry_unit_id',
        'required_amount_product',
        'required_unit_id',
        'enabled',
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    public function checklistHeader()
    {
        return $this->belongsTo(ChecklistHeader::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function pantryUnit()
    {
        return $this->belongsTo(Unit::class, 'pantry_unit_id');
    }

    public function requiredUnit()
    {
        return $this->belongsTo(Unit::class, 'required_unit_id');
    }

    protected $auditExclude = ['created_at', 'updated_at', 'deleted_at'];
    protected $auditEvents = ['created', 'updated', 'deleted'];
}
