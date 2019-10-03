<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Categories Extends Model{
	
	protected $table = 'categories';

	protected $fillable = [
        'name', 'slug',
    ];

    // public function posts(){
    //     return $this->belongsToMany(Posts::class);
    // }

    public function CategoriesPost(){
    	return $this->belongsToMany('App\Models\Posts', 'category_post', 'category_id', 'post_id');
    }

}
