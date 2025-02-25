<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchasesHistoryDetailRequest;
use App\Http\Requests\UpdatePurchasesHistoryDetailRequest;
use App\Http\Resources\PurchasesHistoryDetailResource;
use App\Models\PurchasesHistoryDetail;

class PurchasesHistoryDetailController extends Controller
{
    /**
     * Display a listing of the resource only if the resource is not soft deleted.
     */
    public function index()
    {
        return PurchasesHistoryDetailResource::collection(PurchasesHistoryDetail::all());
    }

    /**
     * Display a listing of the resource including soft deleted.
     */
    public function indexWithTrashed()
    {
        return PurchasesHistoryDetailResource::collection(PurchasesHistoryDetail::withTrashed()->get());
    }

    /**
     * Display a listing of the resource if the resource is soft deleted.
     */
    public function indexOnlyTrashed()
    {
        return PurchasesHistoryDetailResource::collection(PurchasesHistoryDetail::onlyTrashed()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchasesHistoryDetailRequest $request)
    {
        $purchasesHistoryDetail = PurchasesHistoryDetail::create($request->validated());
        return new PurchasesHistoryDetailResource($purchasesHistoryDetail);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchasesHistoryDetail = PurchasesHistoryDetail::findOrFail($id);
        return new PurchasesHistoryDetailResource($purchasesHistoryDetail);
    }

    /**
     * Display a soft deleted resource.
     */
    public function showTrashed(string $id)
    {
        $purchasesHistoryDetail = PurchasesHistoryDetail::onlyTrashed()->findOrFail($id);
        return new PurchasesHistoryDetailResource($purchasesHistoryDetail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchasesHistoryDetailRequest $request, PurchasesHistoryDetail $purchasesHistoryDetail)
    {
        $purchasesHistoryDetail->update($request->validated());
        return new PurchasesHistoryDetailResource($purchasesHistoryDetail);
    }

    /**
     * Remove the specified resource from storage (Soft Delete if possible).
     */
    public function destroy(string $id)
    {
        $purchasesHistoryDetail = PurchasesHistoryDetail::withTrashed()->findOrFail($id);

        if ($purchasesHistoryDetail->trashed()) {
            // Si ya está eliminado (soft delete), lo eliminamos permanentemente
            $purchasesHistoryDetail->forceDelete();
        } else {
            // Si no está eliminado, solo aplicamos soft delete
            $purchasesHistoryDetail->delete();
        }

        return response()->json(['message' => 'Detalle de compras eliminado correctamente']);
    }

    /**
     * Remove the specified resource permanently from storage.
     */
    public function forceDelete(string $id)
    {
        $purchasesHistoryDetail = PurchasesHistoryDetail::withTrashed()->findOrFail($id);
        $purchasesHistoryDetail->forceDelete();
        return response()->json(['message' => 'Detalle de compras eliminado permanentemente']);
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $id)
    {
        $purchasesHistoryDetail = PurchasesHistoryDetail::withTrashed()->findOrFail($id);
        $purchasesHistoryDetail->restore();
        return response()->json(['message' => 'Detalle de compras restaurado correctamente']);
    }
}
