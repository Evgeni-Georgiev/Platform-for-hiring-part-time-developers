<?php

namespace App\Services\Developer;

use App\Http\Requests\DeveloperRequest;
use Illuminate\Database\Eloquent\Collection;

interface DeveloperService
{
    /**
     * Returns all existing in the database developers.
     *
     * @return Collection
     */
    public function getDeveloper(): Collection;

    /**
     * Creates new Developer in the database.
     *
     * @param DeveloperRequest $request
     * @return void
     */
    public function createDeveloper(DeveloperRequest $request): void;

    /**
     * Updates Developer's data if exists.
     *
     * @param DeveloperRequest $request
     * @param $id
     * @return void
     */
    public function updateDeveloper(DeveloperRequest $request, $id): void;

    /**
     * Deletes existing developer.
     *
     * @param $id
     * @return void
     */
    public function deleteDeveloper($id): void;
}
