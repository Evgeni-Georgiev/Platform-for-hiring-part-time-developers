<?php

namespace App\Http\Controllers\Hire;

use App\Http\Controllers\Controller;
use App\Http\Requests\HireRequest;
use App\Models\Developer;
use App\Models\Hire;
use App\Services\HireService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class HireController extends Controller
{

    private Hire $hireModel;
    private HireService $hireService;

    public function __construct(Hire $hireModel, HireService $hireService) {
        $this->hireModel = $hireModel;
        $this->hireService = $hireService;
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
     * Render a list of already hired developers and its statuses
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Undefined variable: $hire_devs -- Solution: create and store/get and post -- need to the the same routes (/hire)
        $hiredDevelopersData = Developer::select('*')
                        ->join('hire_developers', 'developers.name', '=', 'hire_developers.names')
                        ->get();
        return view('hire', ['getDevelopers' => Developer::all(), 'hiredDevelopersData' => $hiredDevelopersData]);
    }

    /**
     * Store a record for hired developer(s) in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HireRequest $request)
    {
        $this->hireService->storeHire($request);
        return redirect('/hire')->with("Data stored successfully!");
    }

    /**
     * Remove the specified hired developer from database.
     *
     * @param  \App\Models\Hire  $hire
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->hireModel->deleteHire($id);
        return redirect('/hire')->with('success', 'Dev Data is successfully deleted');
    }
}
