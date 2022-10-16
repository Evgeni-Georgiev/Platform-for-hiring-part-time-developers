<?php

namespace App\Http\Controllers\Developers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeveloperRequest;
use App\Models\Developer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DevelopersController extends Controller
{
    private Developer $devModel;

    public function __construct(Developer $devModel) {
        $this->devModel = $devModel;
    }

    /**
     * Display a listing of al developers.
     *
     * @return View
     */
    public function index(): View
    {
        return view('developers', ['developer' => Developer::all()]);
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
        $this->devModel->createDeveloper($request);
        return redirect('/developers')->with('success', 'Developer is successfully saved');
    }

    /**
     * Show all information about specified developer.
     * @param $id
     * @return View
     */
    public function developerProfile($id): View
    {
        $getDeveloperProfileById = $this->devModel->findOrFail($id);
        return view('profile', compact('getDeveloperProfileById'))->with('success', 'Developer is successfully saved');
    }

    /**
     * Show the form for editing the specified developer.
     *
     * @param $id
     * @return View
     */
    public function edit($id): View
    {
        $getDeveloperByIdForEdit = $this->devModel->findOrFail($id);
        return view('edit', compact('getDeveloperByIdForEdit'));

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
        $this->devModel->updateDeveloper($request, $id);
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
        $this->devModel->deleteDeveloper($id);
        return redirect('/developers')->with('success', 'Developer Data is successfully deleted');
    }
}
