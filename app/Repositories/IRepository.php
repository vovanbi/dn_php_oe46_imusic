<?php

namespace App\Repositories;

interface IRepository
{
    public function showAll();

    public function findOrFail($id);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function destroy($id);
}
