<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login_proses(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login')->with('failed','Wrong email or password');
        };
        
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

    public function register()
    {
        return view('register');
    }

    public function register_proses(Request $request){
        $request->validate([
            'name'=> 'required',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|min:8'
        ]);

        $data['name']= $request->name;
        $data['email']= $request->email;
        $data['password']= Hash::make($request->password);
        $progressData = '{
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
        $data['progress'] = json_decode($progressData);

        User::create($data);

        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($login)){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login')->with('failed','Wrong email or password');
        };

    }
}
