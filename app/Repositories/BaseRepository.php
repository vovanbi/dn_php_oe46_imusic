<?php

namespace App\Repositories;

use App\Repositories\IRepository;

abstract class BaseRepository implements IRepository
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function showAll()
    {
        return $this->model->all();
    }

    public function findOrFail($id)
    {
        $category = $this->model::findOrFail($id);

        return $category;
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $result = $this->findOrFail($id);
        if ($result) {
            $result->update($attributes);

            return $result;
        }

        return false;
    }

    public function destroy($id)
    {
        $result = $this->findOrFail($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}
