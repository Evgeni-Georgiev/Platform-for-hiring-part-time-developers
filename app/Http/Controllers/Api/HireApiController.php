<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\HireRequest;
use App\Http\Resources\HireResource;
use App\Models\Developer;
use App\Models\Hire;
use App\Services\Hire\HireService;
use App\Services\Hire\HireServiceImpl;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HireApiController extends Controller
{
    private HireService $hireService;

    public function __construct(HireService $hireService) {
        $this->hireService = $hireService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return HireResource::collection($this->hireService->getHire());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param HireRequest $request
     * @param Hire $hire
     * @return JsonResponse
     */
    public function create(HireRequest $request, Hire $hire): JsonResponse
    {
        $hire_devs_by_names = Developer::where('name', $request->names)->get();
        $hire_dev = '';
        foreach($hire_devs_by_names as $dev) {
            $hire_dev = $hire->create([
                'developer_id' => $dev->id,
                'names' => request('names'),
                'start_date' => request('start_date'),
                'end_date' => request('end_date'),
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Developer for Hire created successfully',
            'hired_developers' => $hire_dev,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Hire $hire
     * @return JsonResponse
     */
    public function destroy(Hire $hire): JsonResponse
    {
        $this->hireService->deleteHire($hire->id);
        return response()->json([
            'message' => "Hire record by id: $hire->id deleted."
        ], 202);
    }
}
