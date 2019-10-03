<?php
namespace App\Http\Controllers\AdminAuth;

use Auth;
use Session;
use Validator;
use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/login';

    // redirect user after logout
    protected $redirectAfterLogout = '/admin/login';

    protected $table = 'admins';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'admin/logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:60',
            'email' => 'required|email|max:60|unique:admins',
            'password' => 'required|min:6|confirmed',
           // 'g-recaptcha-response' => 'required|recaptcha',
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function postRegister(Request $request)
    {
      $validator = $this->validator($request->all());
      if ($validator->fails()) {
        $this->throwValidationException(
          $request, $validator
          );
      }

      $user = $this->create($request->all());

      return redirect()->back()->with('register_message', 'Pendaftaran berhasil'); 

    }

    // Login
    public function postLogin(Request $request)
    {

      // If the class is using the ThrottlesLogins trait, we can automatically throttle
      // the login attempts for this application. We'll key this by the username and
      // the IP address of the client making these requests into this application.
      $throttles = $this->isUsingThrottlesLoginsTrait();

      if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
          $this->fireLockoutEvent($request);

          return $this->sendLockoutResponse($request);
      }

      // If the login attempt was unsuccessful we will increment the number of attempts
      // to login and redirect the user back to the login form. Of course, when this
      // user surpasses their maximum number of attempts they will get locked out.
      if ($throttles && ! $lockedOut) {
          $this->incrementLoginAttempts($request);
      }

      $rules = [
      'email' => 'required|exists:admins',
      'password' => 'required',
      //'g-recaptcha-response' => 'required|recaptcha'
    ];
      
      $input = $request->only('email', 'password', 'g-recaptcha-response');
      
      $validator = Validator::make($input, $rules);
      
      if($validator->fails())
      {
        return redirect ('/admin/login')->withInput()->withErrors($validator);
      }
      
      $credentials = [
      'email' => $request->input('email'),
      'password' => $request->input('password'),
      ];
      
      if ( ! Auth::guard('admin')->attempt($credentials))
      {
       
        Session::flash('login_message', 'These credentials do not match our records.');
        
        return redirect ('/admin/login');
        
      }
      
      return redirect('/admin')->with('admin_welcome', 'Selamat datang');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login')->with('logout_message', 'Anda berhasil logout');

    }

}