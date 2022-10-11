<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Nette\Utils\Image;

class LoginController extends Controller
{
    public function index()
    {
        return view('authentication.index');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended();
        }

        return back()->withErrors([
            'errorLogin' => "Adresse e-mail ou mot de passe invalide",
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Allows the user to register
     *
     */
    public function register(): View
    {
        return view('authentication.register');
    }

    public function create(Request $request)
    {
        $rules = [
            'firstName' => ['required', 'min:2', 'max:100', 'alpha'],
            'lastName' => ['required', 'min:2', 'max:100', 'alpha'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'password' => ['required', 'min:8'],
            'passwordConfirm' => ['required', 'same:password'],
            'picture' => ['mimes:jpg,png,svg']
        ];

        $passwordHashed = Hash::make($request->input('password'));


        $credentials = $request->validate($rules);


        if ($request->hasFile('picture')) {

            $picture = $request->file('picture');
            $path = Storage::disk('public')->put('images', $picture);
            $filename = str_replace('images/', '', $path);

            $user = User::create([
                'firstname' => $request->input('firstName'),
                'lastname' => $request->input('lastName'),
                'email' => $request->input('email'),
                'password' => $passwordHashed,
                'picture' => $filename
            ]);
        } else {
            $user = User::create([
                'firstname' => $request->input('firstName'),
                'lastname' => $request->input('lastName'),
                'email' => $request->input('email'),
                'password' => $passwordHashed
            ]);
        }


        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.notice');

    }
}
