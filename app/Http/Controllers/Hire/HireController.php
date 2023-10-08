<?php

namespace App\Http\Controllers\Hire;

use App\Http\Controllers\Controller;
use App\Http\Requests\HireRequest;
use App\Models\Developer;
use App\Models\Hire;
use App\Services\Contracts\IHireService;
use Illuminate\Http\Request;

class HireController extends Controller
{
    private IHireService $hireService;

    public function __construct(IHireService $hireService)
    {
        $this->hireService = $hireService;
        $this->middleware('auth');
    }


    /**
     * Display a listing of the hired developer resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('hire');
    }

    /**
     * Show the form for hiring new developer(s).
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(HireRequest $request)
    {
        $request->validated();
        $this->hireService->storeHire($request);
        return redirect(route('hire.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Hire $hire
     * @return \Illuminate\Http\Response
     */
    public function show(Hire $hire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Hire $hire
     * @return \Illuminate\Http\Response
     */
    public function edit(Hire $hire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Hire $hire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hire $hire)
    {
        //
    }

    /**
     * Remove the specified hired developer from database.
     *
     * @param \App\Models\Hire $hire
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $this->hireService->deleteHire($id);
        return redirect(route('hire.create'));
    }
}
