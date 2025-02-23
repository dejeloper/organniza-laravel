<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name',
        'nemonico',
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
        return $this->hasMany(ChecklistDetail::class, 'pantry_unit_product');
    }

    public function checklistRequiredUnits()
    {
        return $this->hasMany(ChecklistDetail::class, 'required_unit_product');
    }

    public function purchasesHistoryDetails()
    {
        return $this->hasMany(PurchasesHistoryDetail::class);
    }

    public function modifications()
    {
        return $this->hasMany(ModificationLog::class, 'record_id')
            ->where('table_name', 'categories')
            ->orderBy('created_at', 'desc');
    }
}
