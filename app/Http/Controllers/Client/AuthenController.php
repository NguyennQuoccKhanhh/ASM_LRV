<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showFormLogin()
    {
        return view('client.login');
    }
    public function handleLogin()
    {
        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();

            /**
             * @var User $user
             */
            $user =Auth::user();
            if($user->isAdmin()){
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function showFormRegister()
    {
        return view('client.register');
    }
    public function handleRegister()
    {
        $data = request()->validate([
            'name' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        if (request()->hasFile('avatar')) {
            $avatarPath = request()->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $avatarPath;
        }

        $user = User::query()->create($data);


        Auth::login($user);

        request()->session()->regenerate();

        return redirect()->route('index');
    }
    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }








}
