<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = [
        'author', 'post_title', 'post_content', 'location', 'featured_images', 'slug',
    ];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
