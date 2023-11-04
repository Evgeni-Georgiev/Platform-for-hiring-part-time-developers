<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeveloperRequest;
use App\Models\Developer;
use App\Services\Developer\DeveloperService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DeveloperController extends Controller
{
    private DeveloperService $developerService;

    public function __construct(DeveloperService $developerService) {
        $this->developerService = $developerService;
    }

    /**
     * Display a listing of al developers.
     *
     * @return View
     */
    public function index(): View
    {
        $developer = $this->developerService->getDeveloper();
        return view('developers', compact('developer'));
    }

    /**
     * Show the form for creating a new developer.
     *
     * @return View
     */
    public function create(): View
    {
        return view('create');
    }

    /**
     * Store a newly created developer in Database.
     *
     * @param DeveloperRequest $request - Retrieve the input from the custom request class that were submitted by the client.
     * @return RedirectResponse
     */
    public function store(DeveloperRequest $request): RedirectResponse
    {
        $this->developerService->createDeveloper($request);
        return redirect('/developers')->with('success', 'Developer is successfully saved');
    }

    /**
     * Show all information about specified developer.
     * @param $id
     * @return View
     */
    public function developerProfile($id): View
    {
        $get_dev_profile = Developer::find($id);
        return view('profile', compact('get_dev_profile'))->with('success', 'Developer is successfully saved');
    }

    /**
     * Show the form for editing the specified developer.
     *
     * @param $id
     * @return View
     */
    public function edit($id): View
    {
        $developers = Developer::findOrFail($id);
        return view('edit', compact('developers'));
    }

    /**
     * Update the specified developer in database.
     *
     * @param DeveloperRequest $request - Obtain client request for updating specified developer
     * @param $id
     * @return RedirectResponse
     */
    public function update(DeveloperRequest $request, $id): RedirectResponse
    {
        $this->developerService->updateDeveloper($request, $id);
        return redirect('/developers')->with('success', 'Developer Data is successfully updated');
    }

    /**
     * Remove the specified developer from database.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->developerService->deleteDeveloper($id);
        return redirect('/developers')->with('success', 'Developer Data is successfully deleted');
    }
}
