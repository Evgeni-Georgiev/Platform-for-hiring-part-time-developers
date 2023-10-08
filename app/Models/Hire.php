<?php

namespace App\Models;

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
        'user_hired_id'
    ];
    protected $dates = [
        'start_date',
        'end_date',
    ];

    public function developer(){
        return $this->belongsTo(Developer::class);  // A Hire belongs to a Developer
    }
    public function user(){
        return $this->belongsTo(User::class);  // A Hire belongs to a User
    }

}
