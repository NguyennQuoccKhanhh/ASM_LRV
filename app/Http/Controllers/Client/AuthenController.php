<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            $user = Auth::user();

            if ($user->deleted_at !== null) {
                Auth::logout();
                request()->session()->invalidate();
                request()->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Tài Khoản Của Bạn Đã Bị Khóa',
                ])->onlyInput('email');
            }

            if ($user->isAdmin()) {
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

    public function forgotPassword()
    {
        return view('client.forgotPassword');
    }

    public function handlePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.exists' => 'Email này không tồn tại',
        ]);
        $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 6);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        User::where('email', $request->email)->update([
            'password' => $hashedPassword
        ]);
        Mail::raw("Mật khẩu của bạn là: {$password}", function ($message) use ($request) {
            $message->to($request->email)->subject('Thông tin mật khẩu');
        });
        return redirect()->route('login');
    }


}


