<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    //
    
    protected $fillable = [
        'title_1', 'content_1',
        'title_2', 'content_2',
        'title_3', 'content_3',
        'title_4', 'content_4',
        'title_5', 'content_5',
    ];
}
