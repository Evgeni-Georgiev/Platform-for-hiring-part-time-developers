<?php

namespace App\Services;

use App\Http\Requests\DeveloperRequest;
use App\Models\Developer;
use Illuminate\Support\Facades\Storage;

class DeveloperService {

    public static function handleUploadedImage($request, $image): string
    {
        $imageName = '';
        if (!is_null($image)) {
            if($request->hasFile($image)){
                $imageName = Storage::putFile('public/developer', $request->file($image));
            }
        }
        return str_replace('public/developer/', '', $imageName);
    }

}
