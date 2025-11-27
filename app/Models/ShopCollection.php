<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopCollection extends Model
{
    //
       protected $fillable = [
        'title1', 'subtitle1', 'button_text1', 'image1',
        'title2', 'subtitle2', 'button_text2', 'image2',
        'button_link', 'status'
    ];

}
