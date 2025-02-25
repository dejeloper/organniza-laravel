<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchasesHistoryHeaderRequest;
use App\Http\Requests\UpdatePurchasesHistoryHeaderRequest;
use App\Http\Resources\PurchasesHistoryHeaderResource;
use App\Models\PurchasesHistoryHeader;

class PurchasesHistoryHeaderController extends Controller
{
    /**
     * Display a listing of the resource only if the resource is not soft deleted.
     */
    public function index()
    {
        return PurchasesHistoryHeaderResource::collection(PurchasesHistoryHeader::all());
    }

    /**
     * Display a listing of the resource including soft deleted.
     */
    public function indexWithTrashed()
    {
        return PurchasesHistoryHeaderResource::collection(PurchasesHistoryHeader::withTrashed()->get());
    }

    /**
     * Display a listing of the resource if the resource is soft deleted.
     */
    public function indexOnlyTrashed()
    {
        return PurchasesHistoryHeaderResource::collection(PurchasesHistoryHeader::onlyTrashed()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchasesHistoryHeaderRequest $request)
    {
        $purchasesHistoryHeader = PurchasesHistoryHeader::create($request->validated());
        return new PurchasesHistoryHeaderResource($purchasesHistoryHeader);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchasesHistoryHeader = PurchasesHistoryHeader::findOrFail($id);
        return new PurchasesHistoryHeaderResource($purchasesHistoryHeader);
    }

    /**
     * Display a soft deleted resource.
     */
    public function showTrashed(string $id)
    {
        $purchasesHistoryHeader = PurchasesHistoryHeader::onlyTrashed()->findOrFail($id);
        return new PurchasesHistoryHeaderResource($purchasesHistoryHeader);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchasesHistoryHeaderRequest $request, PurchasesHistoryHeader $purchasesHistoryHeader)
    {
        $purchasesHistoryHeader->update($request->validated());
        return new PurchasesHistoryHeaderResource($purchasesHistoryHeader);
    }

    /**
     * Remove the specified resource from storage (Soft Delete if possible).
     */
    public function destroy(string $id)
    {
        $purchasesHistoryHeader = PurchasesHistoryHeader::withTrashed()->findOrFail($id);

        if ($purchasesHistoryHeader->trashed()) {
            // Si ya está eliminado (soft delete), lo eliminamos permanentemente
            $purchasesHistoryHeader->forceDelete();
        } else {
            // Si no está eliminado, solo aplicamos soft delete
            $purchasesHistoryHeader->delete();
        }

        return response()->json(['message' => 'Encabezado de compras eliminado correctamente']);
    }

    /**
     * Remove the specified resource permanently from storage.
     */
    public function forceDelete(string $id)
    {
        $purchasesHistoryHeader = PurchasesHistoryHeader::withTrashed()->findOrFail($id);
        $purchasesHistoryHeader->forceDelete();
        return response()->json(['message' => 'Encabezado de compras eliminado permanentemente']);
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $id)
    {
        $purchasesHistoryHeader = PurchasesHistoryHeader::withTrashed()->findOrFail($id);
        $purchasesHistoryHeader->restore();
        return response()->json(['message' => 'Encabezado de compras restaurado correctamente']);
    }
}
