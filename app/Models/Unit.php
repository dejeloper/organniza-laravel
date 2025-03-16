<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Unit extends Model implements Auditable
{
    use HasFactory, SoftDeletes, AuditableTrait;

    protected $fillable = [
        'name',
        'short_name',
        'enabled',
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function checklistPantryUnits()
    {
        return $this->hasMany(ChecklistDetail::class, 'pantry_unit_id');
    }

    public function checklistRequiredUnits()
    {
        return $this->hasMany(ChecklistDetail::class, 'required_unit_id');
    }

    public function purchasesHistoryDetails()
    {
        return $this->hasMany(PurchasesHistoryDetail::class);
    }

    protected $auditExclude = ['created_at', 'updated_at', 'deleted_at'];
    protected $auditEvents = ['created', 'updated', 'deleted'];
}
