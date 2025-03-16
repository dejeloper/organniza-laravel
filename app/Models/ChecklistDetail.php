<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChecklistDetail extends Model
{
    use HasFactory, SoftDeletes;

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

    public function modifications()
    {
        return $this->hasMany(ModificationLog::class, 'record_id')
            ->where('table_name', 'checklist_details')
            ->orderBy('created_at', 'desc');
    }
}
