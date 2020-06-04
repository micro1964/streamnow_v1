<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;

use Auth;


class AdminAuthController extends Controller
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
     * Where to redirect users after login / registration / logout.
     *
     * @var string
     */
    protected $redirectTo = 'admin';

    protected $redirectAfterLogout = '/admin/login';

    /**
     * The guard to be used for validation.
     *
     * @var string
     */

    protected $guard = 'admin';

    /**
     * The Login form view that should be used.
     *
     * @var string
     */

    protected $loginView = 'admin.auth.login';

    /**
     * The Register form view that should be used.
     *
     * @var string
     */

    protected $registerView = 'admin.auth.register';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {        
        $this->form_request = $request;
        $this->middleware('guestadmin', ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|min:6|confirmed',
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

    /**
     * Function called after user logs in
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated() {

        \Session::flash('flash_success', tr('login_success'));

        if(Auth::guard('admin')->check()) {

            if($admin = Admin::find(Auth::guard('admin')->user()->id)) {

                $admin->timezone = $this->form_request->timezone ? $this->form_request->timezone : $admin->timezone;
                $admin->save();
            }  

        }
        
        return redirect()->intended($this->redirectPath());
    }
}
