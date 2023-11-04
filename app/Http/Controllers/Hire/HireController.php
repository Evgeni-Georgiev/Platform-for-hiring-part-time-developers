<?php

namespace App\Http\Controllers\Hire;

use App\Http\Controllers\Controller;
use App\Http\Requests\HireRequest;
use App\Models\Developer;
use App\Services\Hire\HireService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class HireController extends Controller
{
    private HireService $hireService;

    public function __construct(HireService $hireService) {
        $this->hireService = $hireService;
    }

    /**
     * Display a listing of the hired developer resources.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('hire');
    }

    /**
     * Show the form for hiring new developer(s).
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        // Undefined variable: $hire_devs -- Solution: create and store/get and post -- need to the the same routes (/hire)
        $list_developers_for_hire = Developer::all();
        $hired_developers = Developer::select('*')
                        ->join('hire_developers', 'developers.name', '=', 'hire_developers.names')
                        ->get();
        return view('hire', compact('list_developers_for_hire', 'hired_developers'));
    }

    /**
     * Store a record for hired developer(s) in database.
     *
     * @param HireRequest $request
     * @return \Illuminate\Foundation\Application|RedirectResponse|Redirector|Application
     */
    public function store(HireRequest $request): Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        $this->hireService->storeHire($request);
        return redirect('/hire')->with('success', 'Dev Data is successfully stored.');
    }

    /**
     * Remove the specified hired developer from database.
     *
     * @param $id
     * @return Application|\Illuminate\Foundation\Application|Redirector|RedirectResponse
     */
    public function destroy($id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $this->hireService->deleteHire($id);
        return redirect('/hire')->with('success', 'Dev Data is successfully deleted.');
    }
}
