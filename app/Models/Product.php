<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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
        return $this->belongsTo(Category::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function status()
    {
        return $this->belongsTo(ProductStatus::class, 'status_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function purchaseDetails()
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
