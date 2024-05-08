<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->route('admin-dashboard');
            } else {
                return redirect()->route('dashboard');
            }
        } else {
            return redirect()->route('login')->with('failed', 'Wrong email or password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function register()
    {
        return view('register');
    }

    public function register_proses(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $progressData = '{
            "karma": 0,
            "simple_past": {
                "quest_1": 0,
                "quest_2": 0,
                "quest_3": 0,
                "quest_4": 0
            },
            "simple_present": {
                "quest_1": 0,
                "quest_2": 0,
                "quest_3": 0,
                "quest_4": 0
            },
            "past_continuous": {
                "quest_1": 0,
                "quest_2": 0,
                "quest_3": 0,
                "quest_4": 0
            },
            "future_continuous": {
                "quest_1": 0,
                "quest_2": 0,
                "quest_3": 0,
                "quest_4": 0
            },
            "present_continuous": {
                "quest_1": 0,
                "quest_2": 0,
                "quest_3": 0,
                "quest_4": 0
            }
        }';
        $data['progress'] = ($progressData);

        User::create($data);

        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($login)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('failed', 'Wrong email or password');
        };
    }

    public function forgot_password()
    {
        return view('forgotPassword');
    }

    public function forgot_password_act(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = \Str::random(60);

        PasswordResetToken::updateOrCreate(
            [
                'email' => $request->email,
            ],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]
        );

        Mail::to($request->email)->send(new ResetPasswordMail($token));

        return redirect()->route('forgot-password')->with('success', 'Please check your email to reset your password');
    }

    public function validasi_forgot_password(Request $request, $token)
    {
        $getToken = PasswordResetToken::where('token', $token)->first();

        if (!$getToken) {
            return redirect()->route('login')->with('failed', 'Invalid Token');
        }

        return view('validasiToken', compact('token'));
    }

    public function validasi_forgot_password_act(Request $request)
    {

        $request->validate([
            'password' => 'required|min:8',
        ]);

        $token = PasswordResetToken::where('token', $request->token)->first();

        if (!$token) {
            return redirect()->route('login')->with('failed', 'Invalid Token');
        }

        $user = User::where('email', $token->email)->first();

        if (!$user) {
            return redirect()->route('login')->with('failed', 'Email not found');
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        $token->delete();

        return redirect()->route('login')->with('success', 'Password reset successfully');
    }
}
