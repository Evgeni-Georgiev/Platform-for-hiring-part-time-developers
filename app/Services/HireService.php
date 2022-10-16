<?php

namespace App\Services;

use App\Http\Requests\HireRequest;
use App\Models\Developer;
use App\Models\Hire;

class HireService
{

    /**
     * Hire existing developer(s) from a list without dates overlap
     * @param HireRequest $request - Obtain the client HTTP request.
     * @return void
     */
    public function storeHire(HireRequest $request)
    {
        // Select all from developer where name = names from hire_developers
        $selectHiredDevelopersByName = Developer::where('name', $request->names)->get();

        $selectedDevelopersFromListToHire = $request->names;
        $now = date("Y-m-d H:i:s");

        // Loop every selected developer for hiring and store them in an array by "names"
        foreach ($selectedDevelopersFromListToHire as $selectedDeveloper) {
            $selectedDevelopersArray[] = $selectedDeveloper;
            // For every selected developer: Select all from hire_developers where names = 'selected developer' where start_date and end_date do not overlap
            $getDeveloperByOverlapCriteria =
                Hire::select('*')
                    ->where('names', '=', $selectedDeveloper)
                    ->where(function ($query) use ($request) {
                        $query->whereBetween('start_date', [$request->start_date, $request->end_date])->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
                    })
                    ->first();
            $hiredDevelopersArray[] = $getDeveloperByOverlapCriteria;

            if ($getDeveloperByOverlapCriteria) {
                header('Location: /hire');
                die("Select valid date");
            }
            // Validation checks.
            if ($request->end_date < $request->start_date) {
                header('Location: /hire');
                die("Select valid date");
            }
            if ($request->start_date < $now || $request->end_date < $now) {
                header('Location: /hire');
                die("Select valid date");
            }

            // Check if the looped developers count is equal to the selected developers from the list: if more than one developer is selected from the list, the loop does not exit but gets back and iterates for every other.
            if (count($hiredDevelopersArray) !== count($selectedDevelopersFromListToHire)) {
                continue;
            }
            // Loop all the collected/selected in array developers and hire simultaneously.
            foreach ($selectedDevelopersArray as $singleDeveloper) {
                foreach ($selectHiredDevelopersByName as $hiredDeveloper) {
                    Hire::insert(
                        ["names" => $singleDeveloper, "developer_id" => $hiredDeveloper->id, "start_date" => $request->start_date, "end_date" => $request->end_date]
                    );
                }
            }
        }
    }

}
