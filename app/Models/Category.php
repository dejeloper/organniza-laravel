<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'bg_color',
        'text_color',
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
            ->where('table_name', 'categories')
            ->orderBy('created_at', 'desc');
    }
}
