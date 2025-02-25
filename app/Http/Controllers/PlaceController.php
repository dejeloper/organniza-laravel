<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use App\Http\Resources\PlaceResource;
use App\Models\Place;

class PlaceController extends Controller
{

    /**
     * Display a listing of the resource only if the resource is not soft deleted.
     */
    public function index()
    {
        return PlaceResource::collection(Place::all());
    }

    /**
     * Display a listing of the resource including soft deleted.
     */
    public function indexWithTrashed()
    {
        return PlaceResource::collection(Place::withTrashed()->get());
    }

    /**
     * Display a listing of the resource if the resource is soft deleted.
     */
    public function indexOnlyTrashed()
    {
        return PlaceResource::collection(Place::onlyTrashed()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlaceRequest $request)
    {
        $place = Place::create($request->validated());
        return new PlaceResource($place);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $place = Place::findOrFail($id);
        return new PlaceResource($place);
    }

    /**
     * Display a soft deleted resource.
     */
    public function showTrashed(string $id)
    {
        $place = Place::onlyTrashed()->findOrFail($id);
        return new PlaceResource($place);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlaceRequest $request, Place $place)
    {
        $place->update($request->validated());
        return new PlaceResource($place);
    }

    /**
     * Remove the specified resource from storage (Soft Delete if possible).
     */
    public function destroy(string $id)
    {
        $place = Place::withTrashed()->findOrFail($id);

        if ($place->trashed()) {
            // Si ya está eliminado (soft delete), lo eliminamos permanentemente
            $place->forceDelete();
        } else {
            // Si no está eliminado, solo aplicamos soft delete
            $place->delete();
        }

        return response()->json(['message' => 'Lugar eliminado correctamente']);
    }

    /**
     * Remove the specified resource permanently from storage.
     */
    public function forceDelete(string $id)
    {
        $place = Place::withTrashed()->findOrFail($id);
        $place->forceDelete();
        return response()->json(['message' => 'Lugar eliminado permanentemente']);
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $id)
    {
        $place = Place::withTrashed()->findOrFail($id);
        $place->restore();
        return response()->json(['message' => 'Lugar restaurado correctamente']);
    }
}
