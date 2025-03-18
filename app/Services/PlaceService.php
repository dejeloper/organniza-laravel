<?php

namespace App\Services;

use App\Http\Resources\PlaceResource;
use App\Repositories\PlaceRepository;
use App\Exceptions\CustomBusinessException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class PlaceService
{
    protected PlaceRepository $placeRepository;

    public function __construct(PlaceRepository $placeRepository)
    {
        $this->placeRepository = $placeRepository;
    }

    public function getAll()
    {
        return PlaceResource::collection($this->placeRepository->getAll());
    }

    public function getWithTrashed()
    {
        return PlaceResource::collection($this->placeRepository->getWithTrashed());
    }

    public function getOnlyTrashed()
    {
        return PlaceResource::collection($this->placeRepository->getOnlyTrashed());
    }

    public function store(array $data)
    {
        return new PlaceResource($this->placeRepository->create($data));
    }

    public function getById(string $id)
    {
        return new PlaceResource($this->placeRepository->findById($id));
    }

    public function getTrashedById(string $id)
    {
        return new PlaceResource($this->placeRepository->findTrashedById($id));
    }

    public function update(string $id, array $data)
    {
        try {
            $place = $this->placeRepository->findById($id);
            return new PlaceResource($this->placeRepository->update($place, $data));
        } catch (QueryException $e) {
            throw new CustomBusinessException("Error al actualizar el lugar con ID '{$id}'.", 500);
        }
    }

    public function delete(string $id)
    {
        $place = $this->placeRepository->findById($id);
        $this->placeRepository->delete($place);
        return response()->json(['message' => 'Lugar eliminado correctamente.']);
    }

    public function forceDelete(string $id)
    {
        $place = $this->placeRepository->findTrashedById($id);
        $this->placeRepository->forceDelete($place);
        return response()->json(['message' => 'Lugar eliminado permanentemente.']);
    }

    public function restore(string $id)
    {
        $place = $this->placeRepository->findTrashedById($id);
        $this->placeRepository->restore($place);
        return response()->json(['message' => 'Lugar restaurado correctamente.']);
    }
}
