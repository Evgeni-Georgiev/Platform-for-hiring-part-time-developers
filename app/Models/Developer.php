<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
