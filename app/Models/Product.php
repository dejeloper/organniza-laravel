<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Product extends Model implements Auditable
{
    use HasFactory, SoftDeletes, AuditableTrait;

    protected $fillable = [
        'name',
        'description',
        'unit_id',
        'price',
        'category_id',
        'place_id',
        'status_id',
        'observation',
        'image',
        'enabled',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'price' => 'float',
    ];

    public function checklistDetails()
    {
        return $this->hasMany(ChecklistDetail::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function status()
    {
        return $this->belongsTo(ProductStatus::class, 'status_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function purchaseDetails()
    {
        return $this->hasMany(PurchasesHistoryDetail::class);
    }

    protected $auditExclude = ['created_at', 'updated_at', 'deleted_at'];
    protected $auditEvents = ['created', 'updated', 'deleted'];
}
