<?php

namespace App\Services;

use App\Http\Requests\DeveloperRequest;
use App\Models\Developer;
use Illuminate\Support\Facades\Storage;

class DeveloperService {

    /**
     * Return all exising developers.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getDeveloper()
    {
        return Developer::all();
    }

    public static function createDeveloper(DeveloperRequest $request) {
        Developer::create(array_merge($request->validated(), [
            'profile_picture' => self::handleUploadedImage($request, 'profile_picture')
        ]));
    }

    public static function updateDeveloper(DeveloperRequest $request, $id) {
        $developer = Developer::find($id);

        if($request->hasFile('profile_picture')){
            $developer->update(array_merge($request->validated(), [ 'profile_picture' => self::handleUploadedImage($request, 'profile_picture') ]));
        } else {
            $developer->update($request->except('profile_picture'));
        }
        // When developer is updated, it's record(s) also take the corresponding changes in the 'hire_developers' table.
        HireService::updateHires($request, $id);
    }

    public static function handleUploadedImage($request, $image): string
    {
        $image_name = '';
        if (!is_null($image)) {
            if($request->hasFile($image)){
//                $image = $request->file($image);
//                $image_name = 'developer/'.$image->hashName();
//                $image->storeAs('public', $image_name);
                $image_name = Storage::putFile('public/developer', $request->file($image));
            }
        }
        return str_replace('public/developer/', '', $image_name);
//        return $image_name;
    }


    public static function deleteDeveloper($id) {
            $developers = Developer::find($id);
//            $image_name = '/storage/developer/'.$developers->profile_picture;
//            dd(public_path($image_name));
//            if(is_file(public_path($image_name))){
//                unlink(public_path($image_name));
//            }
            Storage::disk('public')->delete('developer/'.$developers->profile_picture);
            $developers->delete();
    }

}
