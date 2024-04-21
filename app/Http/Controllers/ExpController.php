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

    public function getKarma()
    {
        $user = Auth::user();
        $progress = $user->progress;
        $nilaiKarma = $progress['karma'];

        return response()->json(['karma' => $nilaiKarma]);
    }

    public function updateProgress1Q1(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        if ($user) {
            $progress = $user->progress;
            $progress['karma'] += $request->karmaValue;
            $progress['simple_present']['quest_1'] = 1;
            $user->progress = $progress;
            $user->save();

            return response()->json(['message' => 'Progress updated successfully'], 200);
        }
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
            $progress['karma'] += $request->karmaValue;
            $progress['simple_present']['quest_3'] = 1;
            $user->progress = $progress;
            $user->save();
        }
    }

    public function updateProgress2Q1(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        if ($user) {
            $progress = $user->progress;
            $progress['karma'] += $request->karmaValue;
            $progress['present_continuous']['quest_1'] = 1;
            $user->progress = $progress;
            $user->save();

            return response()->json(['message' => 'Progress updated successfully'], 200);
        }
    }

    public function updateProgress2Q2(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        if ($user) {
            $progress = $user->progress;
            $progress['karma'] += $request->karmaValue;
            $progress['present_continuous']['quest_2'] = 1;
            $user->progress = $progress;
            $user->save();

            return response()->json(['message' => 'Progress updated successfully'], 200);
        }
    }

    public function updateProgress2Q3(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        if ($user) {
            $progress = $user->progress;
            $progress['karma'] += $request->karmaValue;
            $progress['present_continuous']['quest_3'] = 1;
            $user->progress = $progress;
            $user->save();

            return response()->json(['message' => 'Progress updated successfully'], 200);
        }
    }
}
