<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    //
    protected $fillable = [
        'title','image','tab1_title','tab1_content',
        'tab2_title', 'tab2_content', 'tab3_title', 'tab3_content',
        'tab4_title', 'tab4_content','button_text'
    ];
}
