<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login_submit(Request $request)

    {   
        $input = $request->all();

        $this->validate($request, [

            'email' => 'required',

            'password' => 'required',

        ]);

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'ph_no';
        
        if(auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password'])))

        {

            return view('backend.dashboard.index');
            // return redirect()->intended($this->redirectTo)
            //             ->withSuccess('You have Successfully loggedin');

        }else{

            return redirect()->route('login')

                ->with('error','Email-Address And Password Are Wrong.');

        } 

    }


    protected function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('admin/login');
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name'=>$request->name,
            'ph_no'=>$request->phone,
            'email'=>$request->email,
            'status'=>1,
            'password'=>Hash::make($request->password)
        ]);
        $user->assignRole("Member");
        return redirect()->route('login');

    }

}
