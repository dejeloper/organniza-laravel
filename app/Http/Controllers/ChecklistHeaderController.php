<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChecklistHeaderRequest;
use App\Http\Requests\UpdateChecklistHeaderRequest;
use App\Http\Resources\ChecklistHeaderResource;
use App\Models\ChecklistHeader;

class ChecklistHeaderController extends Controller
{
    /**
     * Display a listing of the resource only if the resource is not soft deleted.
     */
    public function index()
    {
        return ChecklistHeaderResource::collection(ChecklistHeader::all());
    }

    /**
     * Display a listing of the resource including soft deleted.
     */
    public function indexWithTrashed()
    {
        return ChecklistHeaderResource::collection(ChecklistHeader::withTrashed()->get());
    }

    /**
     * Display a listing of the resource if the resource is soft deleted.
     */
    public function indexOnlyTrashed()
    {
        return ChecklistHeaderResource::collection(ChecklistHeader::onlyTrashed()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChecklistHeaderRequest $request)
    {
        $checklistHeader = ChecklistHeader::create($request->validated());
        return new ChecklistHeaderResource($checklistHeader);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $checklistHeader = ChecklistHeader::findOrFail($id);
        return new ChecklistHeaderResource($checklistHeader);
    }

    /**
     * Display a soft deleted resource.
     */
    public function showTrashed(string $id)
    {
        $checklistHeader = ChecklistHeader::onlyTrashed()->findOrFail($id);
        return new ChecklistHeaderResource($checklistHeader);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChecklistHeaderRequest $request, ChecklistHeader $checklistHeader)
    {
        $checklistHeader->update($request->validated());
        return new ChecklistHeaderResource($checklistHeader);
    }

    /**
     * Remove the specified resource from storage (Soft Delete if possible).
     */
    public function destroy(string $id)
    {
        $checklistHeader = ChecklistHeader::withTrashed()->findOrFail($id);

        if ($checklistHeader->trashed()) {
            // Si ya está eliminado (soft delete), lo eliminamos permanentemente
            $checklistHeader->forceDelete();
        } else {
            // Si no está eliminado, solo aplicamos soft delete
            $checklistHeader->delete();
        }

        return response()->json(['message' => 'Encabezado del checklist eliminado correctamente']);
    }

    /**
     * Remove the specified resource permanently from storage.
     */
    public function forceDelete(string $id)
    {
        $checklistHeader = ChecklistHeader::withTrashed()->findOrFail($id);
        $checklistHeader->forceDelete();
        return response()->json(['message' => 'Encabezado del checklist eliminado permanentemente']);
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $id)
    {
        $checklistHeader = ChecklistHeader::withTrashed()->findOrFail($id);
        $checklistHeader->restore();
        return response()->json(['message' => 'Encabezado del checklist restaurado correctamente']);
    }
}
