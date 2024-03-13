<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        $users = User::orderBy('exp', 'desc')->get();
        $rank = 1;
        foreach ($users as $user) {
            $user->rank = $rank;
            $rank++;
        }
        return view('user.leaderboard', compact('users'));
    }
}
