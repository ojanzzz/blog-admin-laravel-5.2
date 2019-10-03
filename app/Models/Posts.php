<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Posts Extends Model{
	
	protected $table = 'posts';

	protected $fillable = [
        'author', 'post_title', 'post_content', 'location', 'featured_images',
    ];

    // public function PostAdmin(){
    //     return $this->belongsTo('App\Models\Admins', 'name');
    // }
    
    // public function categories(){
    //     return $this->hasMany(Categories::class);
    // }

    public function PostCategory(){
        return $this->belongsToMany('App\Models\Categories', 'category_post', 'post_id', 'category_id');
   }

    // public function PostCategory(){
    //      return $this->belongsToMany('App\Models\Categories', 'post_categories', 'posts_id', 'category_id' );
    // }


}
