<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'name',
        'short_name',
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
