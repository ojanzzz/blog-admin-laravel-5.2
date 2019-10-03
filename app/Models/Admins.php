<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Admins Extends Model{
	
	protected $table = 'admins';

	protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    // public function AdminPosts(){
    //     return $this->hasMany('App\Models\Posts', 'id');
    // }

}
