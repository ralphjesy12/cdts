<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Activity;
use Input;
use Validator;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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
     * Create a new authentication controller instance.
     *
     * @return void
     */
    protected $redirectPath = '/home';
    protected $loginPath = '/login';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
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
            'username' => 'required|max:255|alpha_num',
            'fullname' => 'required|max:255|string',
            'gender' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'reg_agree' => 'required|accepted',
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
        return User::create([
            'fullname' => $data['fullname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'contact' => $data['contact'],
            'gender' => $data['gender'],
            'position' => "crew",
            'level' => "0",
            'password' => bcrypt($data['password']),
        ]);
    }

	public function authenticate()
    {
		$username = Input::get('username');
		$password = Input::get('password');
		$remember = Input::get('remember');
        if (Auth::viaRemember() || Auth::attempt(['email' => $username, 'password' => $password],$remember) ||
			Auth::attempt(['username' => $username, 'password' => $password],$remember)) {
            // Authentication passed...
			$thisactivity = new Activity();
			$thisactivity->createActivity(
				Auth::user(),
				'login',
				'have logged in',
				0
			);

            return redirect()->intended('/home');
		}else{
			return redirect()->intended('/login')->withErrors(['Username and/or Password you entered does not belong to any user']);
		}
    }
}
