<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeveloperRequest;
use App\Http\Resources\DeveloperResource;
use App\Models\Developer;
use App\Services\Developer\DeveloperService;
use App\Services\Developer\DeveloperServiceImpl;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DeveloperApiController extends Controller
{
    private DeveloperService $developerService;

    public function __construct(DeveloperService $developerService) {
        $this->developerService = $developerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return DeveloperResource::collection($this->developerService->getDeveloper());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param DeveloperRequest $request
     * @return JsonResponse
     */
    public function create(DeveloperRequest $request): JsonResponse
    {
        $this->developerService->createDeveloper($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Developer created successfully',
            'developer' => $request->validated(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DeveloperRequest $request
     * @return JsonResponse
     */
    public function store(DeveloperRequest $request): JsonResponse
    {
        $this->developerService->createDeveloper($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Developer created successfully',
            'developer' => $request->validated(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DeveloperRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(DeveloperRequest $request, $id): JsonResponse
    {
        $this->developerService->updateDeveloper($request, $id);

        return response()->json([
            "status" => "success",
            "message" => "Developer by id: $id updated successfully",
            "developer" => $request->validated(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Developer $developer
     * @return JsonResponse
     */
    public function destroy(Developer $developer): JsonResponse
    {
        $this->developerService->deleteDeveloper($developer->id);

        return response()->json([
            "status" => "success",
            "message" => "Developer by id: $developer->id deleted successfully.",
        ]);
    }
}
