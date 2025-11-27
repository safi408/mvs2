<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddBlog extends Model
{
    //
        protected $fillable = [
        'title',
        'author',
        'publish_date',
        'description',
        'paragraphs', // <- add this
        'bullets',
        'image_1',
        'image_2',
        'image_3',
        'tags',
        'related_previous_title',
        'related_previous_url',
        'related_next_title',
        'related_next_url',
        'facebook',
        'x',           // Twitter/X
        'instagram',
        'tiktok',
        'youtube',
        'pinterest',
    ];

    protected $casts = [
        'bullets' => 'array',
        'tags' => 'array',
        'paragraphs' => 'array'
    ];
}
