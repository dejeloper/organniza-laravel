<?php

namespace App\Observers;

use App\Models\ModificationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class GenericObserver
{
    /**
     * Cuando se crea un registro.
     */
    public function created(Model $model): void
    {
        ModificationLog::create([
            'table_name'  => $model->getTable(),
            'record_id'   => $model->id,
            'column_name' => null, // No hay columna específica, es un registro nuevo
            'old_value'   => null,
            'new_value'   => json_encode($model->attributesToArray()), // Guarda todo el registro creado
            'modified_by' => Auth::check() ? Auth::id() : null, // Verifica si hay usuario autenticado
        ]);
    }

    /**
     * Cuando se actualiza un registro.
     */
    public function updated(Model $model): void
    {
        $dirty = $model->getDirty(); // Obtiene solo los campos modificados

        foreach ($dirty as $column => $newValue) {
            ModificationLog::create([
                'table_name'  => $model->getTable(),
                'record_id'   => $model->id,
                'column_name' => $column,
                'old_value'   => (string) $model->getOriginal($column) ?? null, // Convierte a string si es necesario
                'new_value'   => (string) $newValue ?? null,
                'modified_by' => Auth::check() ? Auth::id() : null,
            ]);
        }
    }

    /**
     * Cuando se elimina un registro (soft delete).
     */
    public function deleted(Model $model): void
    {
        ModificationLog::create([
            'table_name'  => $model->getTable(),
            'record_id'   => $model->id,
            'column_name' => 'deleted_at',
            'old_value'   => null,
            'new_value'   => now()->toDateTimeString(), // Guarda la fecha de eliminación
            'modified_by' => Auth::check() ? Auth::id() : null,
        ]);
    }

    /**
     * Cuando se restaura un registro eliminado (soft delete).
     */
    public function restored(Model $model): void
    {
        ModificationLog::create([
            'table_name'  => $model->getTable(),
            'record_id'   => $model->id,
            'column_name' => 'deleted_at',
            'old_value'   => now()->toDateTimeString(), // Indica que estaba eliminado
            'new_value'   => null,
            'modified_by' => Auth::check() ? Auth::id() : null,
        ]);
    }

    /**
     * Cuando se elimina un registro permanentemente (force delete).
     */
    public function forceDeleted(Model $model): void
    {
        ModificationLog::create([
            'table_name'  => $model->getTable(),
            'record_id'   => $model->id,
            'column_name' => 'force_deleted',
            'old_value'   => null,
            'new_value'   => now()->toDateTimeString(), // Indica que fue eliminado definitivamente
            'modified_by' => Auth::check() ? Auth::id() : null,
        ]);
    }
}
