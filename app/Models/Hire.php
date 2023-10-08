<?php

namespace App\Models;

use App\Http\Requests\DeveloperRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hire extends Model
{
    use HasFactory;
//    public $timestamps = false;
//    protected $dateFormat = 'Y-m-d ';

    protected $table = 'hire_developers';
    protected $fillable = [
        'id',
        'developer_id',
        'names',
        'start_date',
        'end_date',
    ];
    protected $dates = [
        'start_date',
        'end_date',
    ];

    /**
     * @param $id - Accessing id route for determining which developer was updated.
     * @return void
     */
    public function deleteHire($id) {
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

    public function developer(){
        return $this->belongsTo(Developer::class);  // A Hire belongs to a Developer
    }

}
