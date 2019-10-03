<?php

namespace App\Http\Controllers;

use Mail;
use Validator;
use Response;
use App\User;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\Posts;
use App\Models\Categories;
use App\Models\Categoryposts;
use Illuminate\Support\Facades\Redirect;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Pagination\LengthAwarePagination;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(){
        $post = Posts::orderBy('created_at', 'desc')->take(3)->get();
        return view('index') ->with('post', $post);
    }

    /**
     * Display a listing of the gallery resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AllContent(){
        $post = Posts::orderBy('created_at', 'desc')->with('PostCategory')->paginate(4);
        return view('all-post') ->with('post', $post);
    }

    /**
     * Display the specified single resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function Single($post_title){
        $post = Posts::orderBy('post_title')->where('post_title', $post_title)->firstOrFail();
        $all_categories = Categories::orderBy('name')->get();
        $related = Posts::inRandomOrder()->take(3)->get();
        return view('post') ->with('post', $post)
                            ->with('all_categories', $all_categories)
                            ->with('related', $related);
    }

    /**
     * Display the specified category resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function Category($slug){
        $category = Categories::where('slug', $slug)->firstOrFail();
        //$cat = Categories::find($category->id)->CategoriesPost()->get();
        $categories = Categories::find($category->id)->CategoriesPost()->paginate(3);
        return view('category') ->with('category', $category)
                                ->with('categories', $categories);
    }
	
	 public function search(Request $request)
   {
        $query = $request->get('q');
        $hasil = posts::where('post_title', 'LIKE', '%' . $query . '%')->paginate(10);

        return view('result', compact('hasil', 'query'));
    }
 
 
	
    public function template(Request $request){
        return view('email.template',compact('request'));
    }
	


public function sendMail(Request $request){
	
        
        $subject = "Kritik Dari " . $request->input('email');
        $name = $request->input('name');
        $emailAddress = $request->input('email');
        $message = $request->input('message');

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            // Pengaturan Server
           // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'ahmadfauzanmuhammad@gmail.com';                 // SMTP username
            $mail->Password = 'pemberontak2502';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            // Siapa yang mengirim email
            $mail->setFrom("ahmadfauzanmuhammad@gmail.com");

            // Siapa yang akan menerima email
            $mail->addAddress('ahmadfauzanmuhammad@gmail.com');     // Add a recipient
            // $mail->addAddress('ellen@example.com');               // Name is optional

            // ke siapa akan kita balas emailnya
            $mail->addReplyTo($emailAddress, $name);
            
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name


            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = $message;

            $mail->send();

            $request->session()->flash('status', 'Terima kasih, kami sudah menerima email anda.');
            return view('sukses');

        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }

    }
}
