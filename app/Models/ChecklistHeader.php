<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ChecklistHeader extends Model implements Auditable
{
    use HasFactory, SoftDeletes, AuditableTrait;

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

    protected $auditExclude = ['created_at', 'updated_at', 'deleted_at'];
    protected $auditEvents = ['created', 'updated', 'deleted'];
}
