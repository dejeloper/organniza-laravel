<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChecklistDetailResource;
use App\Models\ChecklistDetail;
use Illuminate\Http\Request;

class ChecklistDetailController extends Controller
{
    /**
     * Display a listing of the resource only if the resource is not soft deleted.
     */
    public function index()
    {
        return ChecklistDetailResource::collection(ChecklistDetail::all());
    }

    /**
     * Display a listing of the resource including soft deleted.
     */
    public function indexWithTrashed()
    {
        return ChecklistDetailResource::collection(ChecklistDetail::withTrashed()->get());
    }

    /**
     * Display a listing of the resource if the resource is soft deleted.
     */
    public function indexOnlyTrashed()
    {
        return ChecklistDetailResource::collection(ChecklistDetail::onlyTrashed()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $checklistDetail = ChecklistDetail::create($request->validated());
        return new ChecklistDetailResource($checklistDetail);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $checklistDetail = ChecklistDetail::findOrFail($id);
        return new ChecklistDetailResource($checklistDetail);
    }

    /**
     * Display a soft deleted resource.
     */
    public function showTrashed(string $id)
    {
        $checklistDetail = ChecklistDetail::onlyTrashed()->findOrFail($id);
        return new ChecklistDetailResource($checklistDetail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChecklistDetail $checklistDetail)
    {
        $checklistDetail->update($request->validated());
        return new ChecklistDetailResource($checklistDetail);
    }

    /**
     * Remove the specified resource from storage (Soft Delete if possible).
     */
    public function destroy(string $id)
    {
        $checklistDetail = ChecklistDetail::withTrashed()->findOrFail($id);

        if ($checklistDetail->trashed()) {
            // Si ya está eliminado (soft delete), lo eliminamos permanentemente
            $checklistDetail->forceDelete();
        } else {
            // Si no está eliminado, solo aplicamos soft delete
            $checklistDetail->delete();
        }

        return response()->json(['message' => 'Detalle del checklist eliminado correctamente']);
    }

    /**
     * Remove the specified resource permanently from storage.
     */
    public function forceDelete(string $id)
    {
        $checklistDetail = ChecklistDetail::withTrashed()->findOrFail($id);
        $checklistDetail->forceDelete();
        return response()->json(['message' => 'Detalle del checklist eliminado permanentemente']);
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $id)
    {
        $checklistDetail = ChecklistDetail::withTrashed()->findOrFail($id);
        $checklistDetail->restore();
        return response()->json(['message' => 'Detalle del checklist restaurado correctamente']);
    }
}
