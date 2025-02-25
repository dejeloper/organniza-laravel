<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'enabled',
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function modifications()
    {
        return $this->hasMany(ModificationLog::class, 'record_id')
            ->where('table_name', 'product_statuses')
            ->orderBy('created_at', 'desc');
    }
}
