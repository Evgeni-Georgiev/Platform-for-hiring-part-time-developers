<?php

namespace App\Services;

use App\Http\Requests\DeveloperRequest;
use App\Models\Developer;
use App\Services\Contracts\IDeveloperService;
use App\Services\Contracts\IHireService;
use Illuminate\Support\Facades\Storage;

class DeveloperService implements IDeveloperService
{

    private IHireService $hireService;

    /**
     * @param IHireService $hireService
     */
    public function __construct(IHireService $hireService)
    {
        $this->hireService = $hireService;
    }

    public function getDevelopers(): \Illuminate\Database\Eloquent\Collection
    {
        return Developer::all();
    }

    public function createDeveloper(DeveloperRequest $request)
    {
        return Developer::create(array_merge($request->validated(), [
            'profile_picture' => self::handleUploadedImage($request, 'profile_picture')
        ]));
    }

    public function updateDeveloper(DeveloperRequest $request, $id)
    {
        $developer = Developer::find($id);

        if ($request->hasFile('profile_picture')) {
            $developer->update(array_merge($request->validated(), ['profile_picture' => self::handleUploadedImage($request, 'profile_picture')]));
        } else {
            $developer->update($request->except('profile_picture'));
        }
        // When developer is updated, it's record(s) also take the corresponding changes in the 'hire_developers' table.
        $this->hireService->updateHires($request, $id);
    }

    private function handleUploadedImage($request, $image): string
    {
        $image_name = '';
        if (!is_null($image)) {
            if ($request->hasFile($image)) {
                $image_name = Storage::putFile('public/developer', $request->file($image));
            }
        }
        return str_replace('public/developer/', '', $image_name);
    }


    public function deleteDeveloper($id): bool
    {
        $developer = Developer::find($id);

        if (is_null($developer)) {
            return false;
        }

        Storage::disk('public')->delete('developer/' . $developer->profile_picture);
        return $developer->delete();
    }

    public function getDeveloperById($id)
    {
        return Developer::find($id);
    }
}
