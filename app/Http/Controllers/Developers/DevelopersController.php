<?php

namespace App\Http\Controllers\Developers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeveloperRequest;
use App\Models\Developer;
use App\Models\Hire;
use App\Services\DeveloperService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DevelopersController extends Controller
{
    /**
     * Display a listing of al developers.
     *
     * @return View
     */
    public function index(): View
    {
        $developer = DeveloperService::getDeveloper();
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
        DeveloperService::createDeveloper($request);
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
        DeveloperService::updateDeveloper($request, $id);
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
        DeveloperService::deleteDeveloper($id);
        return redirect('/developers')->with('success', 'Developer Data is successfully deleted');
    }
}
