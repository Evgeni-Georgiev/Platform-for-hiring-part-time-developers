<?php

namespace App\Services\Contracts;

use App\Http\Requests\DeveloperRequest;
use App\Http\Requests\HireRequest;

interface IHireService
{
    /**
     * Return all exising developers.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getHire(): \Illuminate\Database\Eloquent\Collection;

    /**
     * Hire existing developer(s) from a list without dates overlap
     * @param HireRequest $request - Obtain the client HTTP request.
     * //     * @return void
     */
    public function storeHire(HireRequest $request);

    /**
     * @param $id - Accessing id route for determining which developer was updated.
     * @return void
     */
    public function deleteHire($id);

    /**
     * When an existing developer which is hired gets edited, the changes take place also in the hire_developers table records.
     * @param DeveloperRequest $request - Obtain an instance by injecting custom request class.
     * @param $id - Accessing id route for determining which developer was updated.
     * @return void
     */
    public function updateHires(DeveloperRequest $request, $id);
}
