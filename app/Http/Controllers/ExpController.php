<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpController extends Controller
{
    
    public function addExp(Request $request)
    {
        $user = Auth::user();
        $user->exp += $request->exp;
        /** @var \App\Models\User $user **/
        $user->save();

        return response()->json(['message' => 'EXP successfully added'], 200);
    }

    public function updateProgress1Q2(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        if ($user) {
            $progress = $user->progress;
            $progress['simple_present']['quest_2'] = 1;
            $user->progress = $progress;
            $user->save();
        }
    }

    public function updateProgress1Q3(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        if ($user) {
            $progress = $user->progress;
            $progress['simple_present']['quest_3'] = 1;
            $user->progress = $progress;
            $user->save();
        }
    }
}
