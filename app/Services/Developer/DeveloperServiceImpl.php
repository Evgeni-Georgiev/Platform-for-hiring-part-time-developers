<?php

namespace App\Services\Developer;

use App\Http\Requests\DeveloperRequest;
use App\Models\Developer;
use App\Services\Hire\HireService;
use App\Services\Hire\HireServiceImpl;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class DeveloperServiceImpl implements DeveloperService {

    private HireService $hireService;

    public function __construct(HireService $hireService) {
        $this->hireService = $hireService;
    }

    /**
     * Return all exising developers.
     * @return Collection
     */
    public function getDeveloper(): Collection
    {
        return Developer::all();
    }

    public function createDeveloper(DeveloperRequest $request): void
    {
        Developer::create(array_merge($request->validated(), [
            'profile_picture' => $this->handleUploadedImage($request, 'profile_picture')
        ]));
    }

    public function updateDeveloper(DeveloperRequest $request, $id): void
    {
        $developer = Developer::find($id);

        if($request->hasFile('profile_picture')){
            $developer->update(array_merge($request->validated(), [ 'profile_picture' => $this->handleUploadedImage($request, 'profile_picture') ]));
        } else {
            $developer->update($request->except('profile_picture'));
        }
        $this->hireService->updateHires($request, $id);
    }

    public function deleteDeveloper($id): void
    {
            $developers = Developer::find($id);
            Storage::disk('public')->delete('developer/'.$developers->profile_picture);
            $developers->delete();
    }

    /**
     * Uploads image for a developer.
     *
     * @param $request
     * @param $image
     * @return string
     */
    private function handleUploadedImage($request, $image): string
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
