<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    use AuthenticatesUsers;

    protected $guardName = 'admin';
    protected $maxAttempts = 3;
    protected $decayMinutes = 2;
    protected $loginRoute;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        $this->loginRoute = route('admin.login');
    }

    public function login() {
        return view('admin.auth.login');
    }

    public function logout()
    {
        Auth::guard($this->guardName)->logout();
        Session::flush();
        return redirect()->guest($this->loginRoute);
    }

    public function check(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }

        $credential = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];


        if (Auth::guard($this->guardName)->attempt($credential)) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);

            return redirect()->intended();
        } else {
            $this->incrementLoginAttempts($request);

            return redirect()->back()
                ->withInput()
                ->withErrors(["Incorrect user login details!"]);
        }
    }

    public function index() {
        dd('test');
    }
}
