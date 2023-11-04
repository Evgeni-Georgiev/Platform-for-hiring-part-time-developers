<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeveloperResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        // Resources Class - used to transform eloquent collection into format that we need
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'location' => $this->location,
            'profile_picture' => $this->profile_picture,
            'price_per_hour' => $this->price_per_hour,
            'technology' => $this->technology,
            'description' => $this->description,
            'years_of_experience' => $this->years_of_experience,
            'native_language' => $this->native_language,
            'linkedin_profile_link' => $this->linkedin_profile_link
        ];
    }
}
