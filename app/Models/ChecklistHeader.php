<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistHeader extends Model
{
    protected $fillable = [
        'year',
        'month',
        'enabled',
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    public function checklistDetails()
    {
        return $this->hasMany(ChecklistDetail::class);
    }

    public function modifications()
    {
        return $this->hasMany(ModificationLog::class, 'record_id')
            ->where('table_name', 'categories')
            ->orderBy('created_at', 'desc');
    }
}
