<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeveloperRequest;
use App\Http\Resources\DeveloperResource;
use App\Models\Developer;
use App\Services\DeveloperService;
use Illuminate\Http\Request;

class DevelopersApiController extends Controller
{

    private Developer $devModel;

    public function __construct(Developer $devModel) {
        $this->devModel = $devModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return DeveloperResource::collection(Developer::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(DeveloperRequest $request)
    {
        $this->devModel->createDeveloper($request);

        return response()->json([
            'status' => 'success',
            'message' => 'Developer created successfully',
            'developer' => $request->validated(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DeveloperRequest $request, $id)
    {
//        $dev = $developer->update($request->validated());
        $this->devModel->updateDeveloper($request, $id);

        return response()->json([
            'status' => 'success',
            'message' => 'Developer updated successfully',
            'developer' => $request->validated(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Developer  $developer
     * @return array
     */
    public function destroy(Developer $developer)
    {
        $success_delete = $developer->delete();

        return [
            'success' => $success_delete,
            'developer' => $success_delete
        ];
    }
}
