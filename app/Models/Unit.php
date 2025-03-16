<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes;

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

    public function modifications()
    {
        return $this->hasMany(ModificationLog::class, 'record_id')
            ->where('table_name', 'units')
            ->orderBy('created_at', 'desc');
    }
}
