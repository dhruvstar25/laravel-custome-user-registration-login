<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //Get 10 years ago in a YYYY-MM-DD format.
        $eighteenYearsAgo = date("Y-m-d", strtotime("-18 years"));
        // dump($eighteenYearsAgo );
        // return;
        // dump($request);
        // $request->validate([
        //     'dob' => 'required|date|before:eighteenYearsAgo',
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => ['required|min:6|max:10', 'confirmed', Rules\Password::defaults()],
        // ]);
        
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:10|unique:users',
            'name' => 'required|string|max:255',
            'dob' => 'required|date|before:'.$eighteenYearsAgo,
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed',Rules\Password::defaults()],
        ]);
        if ($validator->fails()) {
            return redirect(route('register'))
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::create([
            'username' => $request->username,
            'dob' => $request->dob,
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
