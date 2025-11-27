<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    //
    public $fillable = 
    [
        'name_1','destination_1','facebook_1','image_1',
        'name_2','destination_2','facebook_2','image_2',
        'name_3','destination_3','facebook_3','image_3',
        'name_4','destination_4','facebook_4','image_4',
    ];
}
