<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferBanner extends Model
{
    //
        protected $fillable = [
        'title', 'subtitle', 'discount', 'button_text', 'end_date', 'image',
    ];

}
