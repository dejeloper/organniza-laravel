<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use App\Services\PlaceService;
use Illuminate\Http\JsonResponse;
use App\Models\Place;

class PlaceController extends Controller
{
    protected PlaceService $placeService;

    public function __construct(PlaceService $placeService)
    {
        $this->placeService = $placeService;
    }

    public function index()
    {
        return $this->placeService->getAll();
    }

    public function indexWithTrashed()
    {
        return $this->placeService->getWithTrashed();
    }

    public function indexOnlyTrashed()
    {
        return $this->placeService->getOnlyTrashed();
    }

    public function store(StorePlaceRequest $request)
    {
        return $this->placeService->store($request->validated());
    }

    public function show(string $id)
    {
        return $this->placeService->getById($id);
    }

    public function showTrashed(string $id)
    {
        return $this->placeService->getTrashedById($id);
    }

    public function update(UpdatePlaceRequest $request, Place $place)
    {
        return $this->placeService->update($place, $request->validated());
    }

    public function destroy(string $id): JsonResponse
    {
        return response()->json($this->placeService->delete($id));
    }

    public function forceDelete(string $id): JsonResponse
    {
        return response()->json($this->placeService->forceDelete($id));
    }

    public function restore(string $id): JsonResponse
    {
        return response()->json($this->placeService->restore($id));
    }
}
