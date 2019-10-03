<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Posts Extends Model{
	
	protected $table = 'category_post';

	protected $fillable = [
        'post_id', 'category_id',
    ];

}
