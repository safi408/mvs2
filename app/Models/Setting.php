<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //

    protected $fillable = [
    'site_name', 'logo', 'address', 'email', 'phone', 'direction_link','direction_address','contact',
    'facebook', 'x', 'instagram', 'tiktok', 'youtube', 'pinterest','open_time_weekdays','open_time_sunday'
  ];

}
