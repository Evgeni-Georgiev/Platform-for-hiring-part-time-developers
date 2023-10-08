<?php
namespace App\Services;

use App\Http\Requests\DeveloperRequest;
use App\Http\Requests\HireRequest;
use App\Models\Developer;
use App\Models\Hire;
use Illuminate\Http\Request;

class HireService{


    /**
     * Return all exising developers.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getHire(): \Illuminate\Database\Eloquent\Collection
    {
        return Hire::all();
    }

    /**
     * Hire existing developer(s) from a list without dates overlap
     * @param HireRequest $request - Obtain the client HTTP request.
//     * @return void
     */
    public static function storeHire(HireRequest $request) {
        // Select all from developer where name = names from hire_developers
        $hire_devs_by_names = Developer::where('name', $request->names)->get();

        $selected_developers_to_hire = $request->names;
        $now = date("Y-m-d H:i:s");

        // Loop every selected developer for hiring and store them in an array by "names"
        foreach ($selected_developers_to_hire as $single_developer) {
            $collected_developers[] = $single_developer;
            // For every selected developer: Select all from hire_developers where names = 'selected developer' where start_date and end_date do not overlap
            $select_hired_developers_by_names =
                Hire::select('*')
                    ->where('names', '=', $single_developer)
                    ->where(function ($query) use ($request) { $query->whereBetween('start_date', [$request->start_date, $request->end_date])->orWhereBetween('end_date', [$request->start_date, $request->end_date]); })
                    ->first();
//            $check_rows = $developer_for_hire_from_db_select;
            $store_hired_developers_by_names[] = $select_hired_developers_by_names;

            if ($select_hired_developers_by_names) {
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
            if (count($store_hired_developers_by_names) !== count($selected_developers_to_hire)) {
                continue;
            }
            // Loop all the collected/selected in array developers and hire simultaneously.
            foreach ($collected_developers as $single_collected_developer) {
                foreach($hire_devs_by_names as $dev) {
                    Hire::insert(
                        ["names" => $single_collected_developer, "developer_id" => $dev->id, "start_date" => $request->start_date, "end_date" => $request->end_date]
                    );
                }
            }
        }
    }

    /**
     * @param $id - Accessing id route for determining which developer was updated.
     * @return void
     */
    public static function deleteHire($id) {
        $delete_dev = Hire::findOrFail($id);
        $delete_dev->delete();
    }

    /**
     * When an existing developer which is hired gets edited, the changes take place also in the hire_developers table records.
     * @param DeveloperRequest $request - Obtain an instance by injecting custom request class.
     * @param $id - Accessing id route for determining which developer was updated.
     * @return void
     */
    public static function updateHires(DeveloperRequest $request, $id) {
        $hire = Hire::where('developer_id', $id)->get();
        foreach($hire as $single_hire) {
            $single_hire->names = $request->get('name', 'No Data');
            $single_hire->save();
        }
    }

}
