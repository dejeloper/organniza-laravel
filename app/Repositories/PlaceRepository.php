<?php

namespace App\Repositories;

use App\Exceptions\CustomBusinessException;
use App\Models\Place;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PlaceRepository
{
    public function getAll()
    {
        return Place::all();
    }

    public function getWithTrashed()
    {
        return Place::withTrashed()->get();
    }

    public function getOnlyTrashed()
    {
        return Place::onlyTrashed()->get();
    }

    public function create(array $data)
    {
        return Place::create($data);
    }

    public function findById(string $id)
    {
        try {
            return Place::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new CustomBusinessException("El lugar con ID '{$id}' no fue encontrado.", 404);
        }
    }

    public function findTrashedById(string $id)
    {
        try {
            return Place::onlyTrashed()->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new CustomBusinessException("El lugar eliminado con ID '{$id}' no fue encontrado.", 404);
        }
    }

    public function update(string $id, array $data)
    {
        $place = $this->findById($id);
        $place->update($data);
        return $place;
    }

    public function delete(string $id)
    {
        $place = $this->findById($id);
        $place->delete();
        return $place;
    }

    public function forceDelete(string $id)
    {
        $place = $this->findTrashedById($id);
        $place->forceDelete();
        return $place;
    }

    public function restore(string $id)
    {
        $place = $this->findTrashedById($id);
        $place->restore();
        return $place;
    }
}
