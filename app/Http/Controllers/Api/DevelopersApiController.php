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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return DeveloperResource::collection(DeveloperService::getDeveloper());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(DeveloperRequest $request)
    {
        DeveloperService::createDeveloper($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Developer created successfully',
            'developer' => $request->validated(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DeveloperRequest $request)
    {
        DeveloperService::createDeveloper($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Developer created successfully',
            'developer' => $request->validated(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function show(Developer $developer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function edit(Developer $developer)
    {
        //
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
        DeveloperService::updateDeveloper($request, $id);

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
