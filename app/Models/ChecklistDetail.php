<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistDetail extends Model
{
    protected $fillable = [
        'checklist_header_id',
        'product_id',
        'pantry_amount_product',
        'pantry_unit_product',
        'required_amount_product',
        'required_unit_product',
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
        return $this->belongsTo(Unit::class, 'pantry_unit_product');
    }

    public function requiredUnit()
    {
        return $this->belongsTo(Unit::class, 'required_unit_product');
    }

    public function modifications()
    {
        return $this->hasMany(ModificationLog::class, 'record_id')
            ->where('table_name', 'categories')
            ->orderBy('created_at', 'desc');
    }
}
