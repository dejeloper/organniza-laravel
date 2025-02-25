<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModificationLog extends Model
{
    protected $fillable = [
        'table_name',
        'record_id',
        'column_name',
        'old_value',
        'new_value',
        'modified_by',
    ];

    protected $casts = [
        'old_value' => 'string',
        'new_value' => 'string',
    ];

    public function modifiedBy()
    {
        return $this->belongsTo(User::class, 'modified_by');
    }

    public function relatedModel()
    {
        return match ($this->table_name) {
            'categories' => $this->belongsTo(Category::class, 'record_id'),
            'products' => $this->belongsTo(Product::class, 'record_id'),
            'places' => $this->belongsTo(Place::class, 'record_id'),
            'product_statuses' => $this->belongsTo(ProductStatus::class, 'record_id'),
            'units' => $this->belongsTo(Unit::class, 'record_id'),
            'purchases_history_headers' => $this->belongsTo(PurchasesHistoryHeader::class, 'record_id'),
            'purchases_history_details' => $this->belongsTo(PurchasesHistoryDetail::class, 'record_id'),
            'checklist_headers' => $this->belongsTo(ChecklistHeader::class, 'record_id'),
            'checklist_details' => $this->belongsTo(ChecklistDetail::class, 'record_id'),
            default => null,
        };
    }
}
