<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTasksRequest;
use App\Http\Requests\UpdateTasksRequest;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginauth(Request $request)
    {
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
        return view('wrong_login');
    }

    public function store(StoreTasksRequest $request)
    {
        //
    }

    public function show(Tasks $tasks)
    {
        //
    }

    public function edit(Tasks $tasks)
    {
        //
    }

    public function update(UpdateTasksRequest $request, Tasks $tasks)
    {
        //
    }

    public function destroy(Tasks $tasks)
    {
        //
    }
}
