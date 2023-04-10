<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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

    public function Login(LoginRequest $request)
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

    public function Register(SignUpRequest $request)
    {
        /*  $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles'  => 'required'
        ]);*/

        // specifying $request inputs not using $request->all() for security meassures thus it would be vunlerable to request attacks


        $data = $request->input(['first_name', 'last_name', 'email', 'password', 'roles']);

        // for security measurres and protection from files hijacking the images name must not be as they
        // uploaded for example "(car.png) must not be stay as it the sent name"
        // hence keeping the anonymity for the data is key to protection
        // here the name is being generated it is string combined of the  Unix time
        // and image extension


        $image_name = time() . '.' . $request->image->extension();
        $request->image->storeAs('images', $image_name);

        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'image_name' => $data['image'],
            'password' => Hash::make($data['password']),

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
    public function createStepOneForm()
    {

        return view('auth.first-form');
    }

    public function stepOneForm(Request $request)
    {
        $role = session(['role' => $request->role]);
    }
    public function createStepTwoForm()
    {

        if (Session::get('role') == 'developer') {

            return view('auth.second_form_developer');
        } else {

            return  view('auth.second_form_user');
        }
    }
    public function stepTwoForm(Request $request)
    {

        /*  $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles'  => 'required'
        ]);*/

        // specifying $request inputs not using $request->all() for security meassures thus it would be vunlerable to request attacks


        $data = $request->input(['first_name', 'last_name', 'email', 'password', 'roles']);

        // for security measurres and protection from files hijacking the images name must not be as they
        // uploaded for example "(car.png) must not be stay as it the sent name"
        // hence keeping the anonymity for the data is key to protection
        // here the name is being generated it is string combined of the  Unix time
        // and image extension


        $image_name = time() . '.' . $request->image->extension();
        $request->image->storeAs('images', $image_name);

        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
