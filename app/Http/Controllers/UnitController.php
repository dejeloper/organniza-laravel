<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUnitRequest;
use App\Http\Resources\UnitResource;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource only if the resource is not soft deleted.
     */
    public function index()
    {
        return UnitResource::collection(Unit::all());
    }

    /**
     * Display a listing of the resource including soft deleted.
     */
    public function indexWithTrashed()
    {
        return UnitResource::collection(Unit::withTrashed()->get());
    }

    /**
     * Display a listing of the resource if the resource is soft deleted.
     */
    public function indexOnlyTrashed()
    {
        return UnitResource::collection(Unit::onlyTrashed()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUnitRequest $request)
    {
        $unit = Unit::create($request->validated());
        return new UnitResource($unit);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $unit = Unit::findOrFail($id);
        return new UnitResource($unit);
    }

    /**
     * Display a soft deleted resource.
     */
    public function showTrashed(string $id)
    {
        $unit = Unit::onlyTrashed()->findOrFail($id);
        return new UnitResource($unit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $unit->update($request->validated());
        return new UnitResource($unit);
    }

    /**
     * Remove the specified resource from storage (Soft Delete if possible).
     */
    public function destroy(string $id)
    {
        $unit = Unit::withTrashed()->findOrFail($id);

        if ($unit->trashed()) {
            // Si ya está eliminado (soft delete), lo eliminamos permanentemente
            $unit->forceDelete();
        } else {
            // Si no está eliminado, solo aplicamos soft delete
            $unit->delete();
        }

        return response()->json(['message' => 'Unidad eliminada correctamente']);
    }

    /**
     * Remove the specified resource permanently from storage.
     */
    public function forceDelete(string $id)
    {
        $unit = Unit::withTrashed()->findOrFail($id);
        $unit->forceDelete();
        return response()->json(['message' => 'Unidad eliminada permanentemente']);
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $id)
    {
        $unit = Unit::withTrashed()->findOrFail($id);
        $unit->restore();
        return response()->json(['message' => 'Unidad restaurada correctamente']);
    }
}
