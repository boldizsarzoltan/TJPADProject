<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTasksRequest;
use App\Http\Requests\UpdateTasksRequest;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        if(Auth::check()) {
            return redirect(route('home'));
        }
        return view('login');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        Auth::logout();
        return redirect(route('home'));
    }

    public function loginauth(Request $request)
    {
        if(Auth::check()) {
            return redirect(route('home'));
        }
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt(
            [
                'email' => $request->get("email"),
                'password' => $request->get("password")
            ],
            true
        ) || Auth::viaRemember()) {
            $request->session()->regenerate();

            return redirect()->intended('tasks');
        }
        return back()->withInput()->withErrors([
            'login' => 'wrong login'
        ]);
    }

    public function wrongLoginauth()
    {
        if(Auth::check()) {
            return redirect(route('home'));
        }
        return view('wrong_login');
    }

    public function register()
    {
        if(Auth::check()) {
            return redirect(route('home'));
        }
        return view('register');
    }

    public function registerAction(Request $request)
    {
        try {
            $token = csrf_token();
            $this->validate($request, [
                'name' => 'required|min:3',
                'email' => 'required|email',
                'password' => 'required|alpha_dash|min:7',
            ]);
            $user = new User($request->all());
            $user->save();
            Session::flash('alert-success', 'Created');
            return redirect(route('list_tasks'));
        }
        catch (\RuntimeException $runtimeException) {
            return back()->withInput()->withErrors([
                'error' => $runtimeException->getMessage()
            ]);
        }
    }
}
