<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DeveloperApiRequest;
use App\Http\Resources\DeveloperResource;
use App\Services\Contracts\IDeveloperService;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DevelopersApiController extends Controller
{
    private IDeveloperService $developerService;

    /**
     * @param IDeveloperService $developerService
     */
    public function __construct(IDeveloperService $developerService)
    {
        $this->developerService = $developerService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return DeveloperResource::collection($this->developerService->getDevelopers());
    }

    public function show(int $id)
    {
        $developer = $this->developerService->getDeveloperById($id);

        if (is_null($developer)) {
            return new Response('', ResponseAlias::HTTP_NOT_FOUND);
        }

        return new Response(json_encode($developer), ResponseAlias::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DeveloperApiRequest $request
     * @return Response
     */
    public function store(DeveloperApiRequest $request)
    {
        $developer = $this->developerService->createDeveloper($request);

        return new Response('', ResponseAlias::HTTP_CREATED, ["Location:" => route('api.v1.developer.show', $developer->id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Developer $developer
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DeveloperApiRequest $request, $id)
    {
        $this->developerService->updateDeveloper($request, $id);

        return response()->json([
            'status' => 'success',
            'message' => 'Developer updated successfully',
            'developer' => $request->validated(),
        ]);
    }

    public function destroy(int $id)
    {
        $result = $this->developerService->deleteDeveloper($id);
        return ($result ? new Response('', ResponseAlias::HTTP_NO_CONTENT) : new Response('', ResponseAlias::HTTP_NOT_FOUND));
    }
}
