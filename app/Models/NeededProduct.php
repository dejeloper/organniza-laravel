<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NeededProduct extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'unit_id',
        'fulfilled',
        'added_by'
    ];

    protected $casts = [
        'fulfilled' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function modifications()
    {
        return $this->hasMany(ModificationLog::class, 'record_id')
            ->where('table_name', 'categories')
            ->orderBy('created_at', 'desc');
    }
}
