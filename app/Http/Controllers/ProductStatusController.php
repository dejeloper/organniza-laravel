<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductStatusRequest;
use App\Http\Requests\UpdateProductStatusRequest;
use App\Http\Resources\ProductStatusResource;
use App\Models\ProductStatus;

class ProductStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductStatusResource::collection(ProductStatus::all());
    }
    /**
     * Display a listing of the resource including soft deleted.
     */
    public function indexWithTrashed()
    {
        return ProductStatusResource::collection(ProductStatus::withTrashed()->get());
    }

    /**
     * Display a listing of the resource if the resource is soft deleted.
     */
    public function indexOnlyTrashed()
    {
        return ProductStatusResource::collection(ProductStatus::onlyTrashed()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductStatusRequest $request)
    {
        $productStatus =  ProductStatusResource::create($request->validated());
        return new ProductStatusResource($productStatus);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productStatus = ProductStatusResource::findOrFail($id);
        return new ProductStatusResource($productStatus);
    }

    /**
     * Display a soft deleted resource.
     */
    public function showTrashed(string $id)
    {
        $productStatus = ProductStatusResource::onlyTrashed()->findOrFail($id);
        return new ProductStatusResource($productStatus);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductStatusRequest $request, ProductStatus $productStatus)
    {
        $productStatus->update($request->validated());
        return new ProductStatusResource($productStatus);
    }

    /**
     * Remove the specified resource from storage (Soft Delete if possible).
     */
    public function destroy(string $id)
    {
        $productStatus = ProductStatusResource::withTrashed()->findOrFail($id);

        if ($productStatus->trashed()) {
            // Si ya está eliminado (soft delete), lo eliminamos permanentemente
            $productStatus->forceDelete();
        } else {
            // Si no está eliminado, solo aplicamos soft delete
            $productStatus->delete();
        }

        return response()->json(['message' => 'Estado del producto eliminado correctamente']);
    }

    /**
     * Remove the specified resource permanently from storage.
     */
    public function forceDelete(string $id)
    {
        $productStatus = ProductStatus::withTrashed()->findOrFail($id);
        $productStatus->forceDelete();
        return response()->json(['message' => 'Estado del producto eliminado permanentemente']);
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $id)
    {
        $productStatus = ProductStatus::withTrashed()->findOrFail($id);
        $productStatus->restore();
        return response()->json(['message' => 'Estado del producto restaurado correctamente']);
    }
}
