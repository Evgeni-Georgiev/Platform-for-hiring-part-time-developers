<?php

namespace App\Models;

use App\Http\Requests\DeveloperRequest;
use App\Services\DeveloperService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Developer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        "id",
        "name",
        "email",
        "phone",
        "location",
        "profile_picture",
        "price_per_hour",
        "technology",
        "description",
        "years_of_experience",
        "native_language",
        "linkedin_profile_link",
    ];

    public function createDeveloper(DeveloperRequest $request) {
        Developer::create(array_merge($request->validated(), [
            'profile_picture' => DeveloperService::handleUploadedImage($request, 'profile_picture')
        ]));
    }

    public function updateDeveloper(DeveloperRequest $request, $id) {
        $developer = Developer::find($id);

        if($request->hasFile('profile_picture')){
            $developer->update(array_merge($request->validated(), [ 'profile_picture' => DeveloperService::handleUploadedImage($request, 'profile_picture') ]));
        } else {
            $developer->update($request->except('profile_picture'));
        }
        // When developer is updated, it's record(s) also take the corresponding changes in the 'hire_developers' table.
        Hire::updateHires($request, $id);
    }

    public static function deleteDeveloper($id) {
        $developer = Developer::find($id);
        Storage::disk('public')->delete('developer/'.$developer->profile_picture);
        $developer->delete();
    }

    /**
     * Mutator function for Name of Developer.
     * Set every first letter of the name text to be capitol letter.
     * The attribute will be formatted before saving them into the database.
     * @param $value
     * @return void
     */

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }

    /**
     * Accessor function for Name of Developer.
     * Set every first letter of the name text to be capitol letter.
     * The attribute will be formatted when retrieved from database.
     * @param $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }


    public function hires() {
        return $this->hasMany(Hire::class); // A Developer can have many hires
    }
}
