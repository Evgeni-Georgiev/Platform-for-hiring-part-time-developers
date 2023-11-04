<?php

namespace App\Services\Hire;

use App\Http\Requests\DeveloperRequest;
use App\Http\Requests\HireRequest;
use Illuminate\Database\Eloquent\Collection;

interface HireService
{
    /**
     * Return all exising developers.
     *
     * @return Collection
     */
    public function getHire(): Collection;

    /**
     * Hire existing developer(s) from a list without dates overlap.
     *
     * @param HireRequest $request - Obtain the client HTTP request.
     */
    public function storeHire(HireRequest $request): void;

    /**
     * Deletes existing hire record from database.
     *
     * @param $id - Accessing id route for determining which developer was updated.
     * @return void
     */
    public function deleteHire($id): void;

    /**
     * When an existing developer which is hired gets edited, the changes take place also in the hire_developers table records.
     *
     * @param DeveloperRequest $request - Obtain an instance by injecting custom request class.
     * @param $id - Accessing id route for determining which developer was updated.
     * @return void
     */
    public function updateHires(DeveloperRequest $request, $id): void;
}
