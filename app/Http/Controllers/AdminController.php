<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Validator;
use Response;
use File;
use App\User;
use App\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Posts;
use App\Models\Categories;
use App\Models\Categoryposts;
use Illuminate\Pagination\LengthAwarePagination;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;
//use Intervention\Image\Facades\Image;


class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
   }

    /**
     * Display a login of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdminLogin(){
        if(Auth::guard('admin')->check()){
            return redirect('/admin');
        }
        return view('admin.auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegister(){
        $super_role = auth()->guard('admin')->user();
        return view('admin.auth.register')->with('role', $super_role);
    }

    /**
     * Show the form for editing the specified admin resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showChangePassword(){
        $super_role = auth()->guard('admin')->user();
        if(Auth::guard('admin')->check()){
            return view('admin.auth.change-password')->with('role', $super_role);
        }
        return redirect('/');
    }

    /**
     * Update the specified admin resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveChangePassword(){
        $admin = auth()->guard('admin')->user();
        $rules = array(
            'old_password' => 'required|alphaNum|between:6,16',
            'password' => 'required|alphaNum|between:6,16|confirmed'
    );

    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator);
    } else {  if (!Hash::check(Input::get('old_password'), $admin->password)) {
        return redirect()->back()->withErrors('Your old password does not match');   
    } else{
            $admin->password = Hash::make(Input::get('password'));
            $admin->save();  
            return redirect()->back()->with('passmessage', 'Password have been changed');
        }
     }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index(){
        $super_role = auth()->guard('admin')->user();
        $post = Posts::all();
        $categories = Categories::orderBy('name')->get();
        if(Auth::guard('admin')->check()){
            return view('admin.index')->with('role', $super_role)->with('post', $post)->with('categories', $categories);
        }
        return redirect('/');
    }

    /**
     * Store a newly created post resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function SavePost(Request $request){

        $category_in = $request->input('category_id');

        $str = 'abcdefghijklmnopqrstuvwxyz123456789';
        $shuffled = str_shuffle($str);
        $data_1   = substr($shuffled , -20);
        $data_2   = substr($shuffled , 0,20);
        $newname  = ($data_1.$data_2);

        $update = new Posts;
        $update->id = $request->input('id');
        $update->author = $request->input('author');
        $update->post_title = $request->input('post_title');
        $update->post_content = $request->input('post_content');
        $update->location = $request->input('location');
        //$update->slug = $slug;

        if ($request->hasFile('featured_images')) {

            $file = $request->file('featured_images')->getClientOriginalExtension();
            $request->file('featured_images')->move(public_path('photos/contents/'),'' .$newname . '.'.$file);
            
            if (!is_dir(public_path('/photos/contents/medium/'))) {
               mkdir(public_path('/photos/contents/medium/', 0777, true));
            }

            if (!is_dir(public_path('/photos/contents/thumb/'))) {
                mkdir(public_path('/photos/contents/thumb/', 0777, true));
            }

            copy(public_path('/photos/contents/') .$newname . '.'.$file, public_path('/photos/contents/medium/') .$newname . '.'.$file);
            copy(public_path('/photos/contents/medium/') .$newname . '.'.$file, public_path('/photos/contents/thumb/').$newname . '.'.$file);


            $pathfeatured = public_path('/photos/contents/' .$newname . '.'.$file);
            Image::make($pathfeatured)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save($pathfeatured);

            $pathmedium = public_path('/photos/contents/medium/' .$newname . '.'.$file);
            Image::make($pathmedium)->fit(500, 500)->save($pathmedium);

            $paththumb = public_path('/photos/contents/thumb/' .$newname . '.'.$file);
            Image::make($paththumb)->fit(150, 150)->save($paththumb);

            $update->featured_images = $newname.'.'.$file;

        }

        $update->save();

        $update->PostCategory()->sync($request->category_id, false);

        return redirect()->back()->with('update_message', 'Successfully added!');

    }

    /**
     * Show the form for editing the specified post resource. 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function PostEdit($id){
        $edit = Posts::where('id', $id)->firstOrFail();
        $categories = Categories::orderBy('name')->get();
        $has_categories = Categories::orderBy('name')->with('CategoriesPost')->get();
        $super_role = auth()->guard('admin')->user();
        if(Auth::guard('admin')->check()){
            return view('admin.post-edit')->with('edit', $edit)
                                        ->with('categories', $categories)
                                        ->with('has_categories', $has_categories)
                                        ->with('role', $super_role)
                                        ->with('id', $id);
        }
        return redirect('/');
    }


    /**
     * Update the specified post resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function PostEditSave(Request $request){

        // $this->validate($request, [
        //     'images_name' => 'required|max:60',
        //     'images_desc' => 'required|max:160',
        // ]);

        $id = $request->input('id');

        $category_in = $request->input('category_id');

        $str = 'abcdefghijklmnopqrstuvwxyz123456789';
        $shuffled = str_shuffle($str);
        $data_1   = substr($shuffled , -20);
        $data_2   = substr($shuffled , 0,20);
        $newname  = ($data_1.$data_2);

        $update = Posts::find($id);
        $update->id = $request->input('id');
        $update->author = $request->input('author');
        $update->post_title = $request->input('post_title');
        $update->post_content = $request->input('post_content');
        $update->location = $request->input('location');

        if ($request->hasFile('featured_images')) {

            $file = $request->file('featured_images')->getClientOriginalExtension();
            $request->file('featured_images')->move(public_path('photos/contents/'),'' .$newname . '.'.$file);
            
            if (!is_dir(public_path('/photos/contents/medium/'))) {
               mkdir(public_path('/photos/contents/medium/', 0777, true));
            }

            if (!is_dir(public_path('/photos/contents/thumb/'))) {
                mkdir(public_path('/photos/contents/thumb/', 0777, true));
            }

            copy(public_path('/photos/contents/') .$newname . '.'.$file, public_path('/photos/contents/medium/') .$newname . '.'.$file);
            copy(public_path('/photos/contents/medium/') .$newname . '.'.$file, public_path('/photos/contents/thumb/').$newname . '.'.$file);


            $pathfeatured = public_path('/photos/contents/' .$newname . '.'.$file);
            Image::make($pathfeatured)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save($pathfeatured);

            $pathmedium = public_path('/photos/contents/medium/' .$newname . '.'.$file);
            Image::make($pathmedium)->fit(500, 500)->save($pathmedium);

            $paththumb = public_path('/photos/contents/thumb/' .$newname . '.'.$file);
            Image::make($paththumb)->fit(150, 150)->save($paththumb);

            $update->featured_images = $newname.'.'.$file;

        } 

        $update->save();

        if (isset($request->category_id)) {
            $update->PostCategory()->sync($request->category_id);
        } else {
            $update->PostCategory()->sync(array());
        }

        return redirect()->back()->with('update_message', 'Successfully added!');
    }

    /**
     * Display the specified post resource as JSON.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ShowDataPost(){
        $data = Posts::orderBy('created_at', 'desc')->with('PostCategory')->get();    
        // dd($data);   
        if(Auth::guard('admin')->check()){
            return Response::json($data);
        }
        return redirect('/');
    }

    /**
     * Remove the specified post resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function DestroyPost(Posts $id){
        
        if($id->featured_images !=''){
            if (File::exists(public_path('/photos/contents/'.$id->featured_images)) ) {
                unlink(public_path('/photos/contents/'.$id->featured_images));
            }
            if (File::exists(public_path('/photos/contents/medium/'.$id->featured_images)) ) {
                unlink(public_path('/photos/contents/medium/'.$id->featured_images));
            }
            if (File::exists(public_path('/photos/contents/thumb/'.$id->featured_images)) ) {
                unlink(public_path('/photos/contents/thumb/'.$id->featured_images));
            }
        }

        $id->delete();
        $id->PostCategory()->detach();

        return redirect()->back()->with('destroy_message', ' Successfully deleted!');
    }

    /**
     * Store a newly created categories resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function SaveCategory(Request $request){

        $delimiter = '-';
        setlocale(LC_ALL, 'en_US.UTF8');
        
        $slugs = $request->input('name');
        $specialstr = iconv('UTF-8', 'ASCII//TRANSLIT', $slugs);
        $specialpreg = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $specialstr);
        $slugpreg = preg_replace("/[\/_|+ -]+/", $delimiter, $specialpreg);
        $slug = strtolower(trim($slugpreg, $delimiter));

        $update = new Categories;
        $update->name = $request->input('name');
        $update->slug = $slug;
        $update->save();

        return Response::json($update);
    }

    /**
     * Update the specified post resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function CategoryEditSave(Request $request){
        $id = $request->input('id');

        $delimiter = '-';
        setlocale(LC_ALL, 'en_US.UTF8');
        
        $slugs = $request->input('name');
        $specialstr = iconv('UTF-8', 'ASCII//TRANSLIT', $slugs);
        $specialpreg = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $specialstr);
        $slugpreg = preg_replace("/[\/_|+ -]+/", $delimiter, $specialpreg);
        $slug = strtolower(trim($slugpreg, $delimiter));

        $update = Categories::find($id);
        //$update->id = $request->input('id');
        $update->name =  $request->input('name');
        $update->slug = $slug;
        $update->save();

        return Response::json($update);
    }

    /**
     * Remove the specified category resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function DestroyCategory(Categories $id){

        $categories = Categories::where('id', $id->id);
        $id->delete();
        $categories->delete();

        return Response::json($id);
    }

}
