<?php

namespace App\Services\Contracts;

use App\Http\Requests\DeveloperRequest;

interface IDeveloperService
{
    /**
     * Return all exising developers.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDevelopers(): \Illuminate\Database\Eloquent\Collection;
    public function getDeveloperById($id);

    public function createDeveloper(DeveloperRequest $request);

    public function updateDeveloper(DeveloperRequest $request, $id);

    public function deleteDeveloper($id) : bool;
}
