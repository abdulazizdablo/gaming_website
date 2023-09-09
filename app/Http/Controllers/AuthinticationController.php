<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;


class AuthenticationController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $image_name = time() . '.' . $request->image->extension();
        $request->image->storeAs('images', $image_name);

        $user = $this->createUser($data, $image_name);

        Auth::login($user);

        return redirect('index')->withMessage("You have signed up");
    }

    private function createUser($data, $image_name)
    {


        $user = 'App\\Models\\' . Session::get('role')::create(
            array_merge(
                $data,
                ['image' => $image_name, 'password' => bcrypt($data['password'])]
            )

        );


        $user->assignRole(Session::get('role'));
        return $user;
    }


    public function createStepOneForm()
    {
        return view('registration.create');
    }

    public function stepOneForm(Request $request)
    {
        session(['role' => $request->role]);
        return redirect('register');
    }

    public function createStepTwoForm()
    {
        if (Session::get('role') == 'developer') {
            return view('auth.second_form_developer');
        } else {
            return view('auth.second_form_user');
        }
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
