<?php

namespace App\Services;

use App\Http\Requests\DeveloperRequest;
use App\Models\Developer;
use Illuminate\Support\Facades\Storage;

class DeveloperService {

    public static function handleUploadedImage($request, $image): string
    {
        $image_name = '';
        if (!is_null($image)) {
            if($request->hasFile($image)){
                $image_name = Storage::putFile('public/developer', $request->file($image));
            }
        }
        return str_replace('public/developer/', '', $image_name);
    }

}
