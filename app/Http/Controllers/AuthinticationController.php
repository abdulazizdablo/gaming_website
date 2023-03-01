<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class AuthinticationController extends Controller
{

    function __construct()
    {
        $this->middleware('guest', ['only' => ['register']]);
        $this->middleware('auth', ['only' => ['login']]);
    }


    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(LoginRequest $request)
    {
        /*$request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);*/

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function customRegistration(SignUpRequest $request)
    {
        /*  $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles'  => 'required'
        ]);*/

        // specifying $request inputs not using $request->all() for security meassures thus it would be vunlerable to request attacks

        $data = $request->input(['first_name', 'last_name', 'email', 'password', 'roles']);
        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            /*'roles' =>   auth()->user()->assignRole($data['roles'])*/

        ]);

        // using Spatie assignRole to attach the selected role to the registerd user

        $user = $user->assignRole($data['roles']);
        return $user;
    }

    /* public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }*/

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
