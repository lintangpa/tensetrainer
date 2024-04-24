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
            $progress['karma'] += $request->karmaValue;
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

    public function updateProgress3Q1(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        if ($user) {
            $progress = $user->progress;
            $progress['karma'] += $request->karmaValue;
            $progress['simple_past']['quest_1'] = 1;
            $user->progress = $progress;
            $user->save();

            return response()->json(['message' => 'Progress updated successfully'], 200);
        }
    }

    public function updateProgress3Q2(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        if ($user) {
            $progress = $user->progress;
            $progress['karma'] += $request->karmaValue;
            $progress['simple_past']['quest_2'] = 1;
            $user->progress = $progress;
            $user->save();

            return response()->json(['message' => 'Progress updated successfully'], 200);
        }
    }

    public function updateProgress3Q3(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        if ($user) {
            $progress = $user->progress;
            $progress['karma'] += $request->karmaValue;
            $progress['simple_past']['quest_3'] = 1;
            $user->progress = $progress;
            $user->save();

            return response()->json(['message' => 'Progress updated successfully'], 200);
        }
    }

    public function updateProgress4Q1(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        if ($user) {
            $progress = $user->progress;
            $progress['karma'] += $request->karmaValue;
            $progress['past_continuous']['quest_1'] = 1;
            $user->progress = $progress;
            $user->save();

            return response()->json(['message' => 'Progress updated successfully'], 200);
        }
    }

    public function updateProgress4Q2(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        if ($user) {
            $progress = $user->progress;
            $progress['karma'] += $request->karmaValue;
            $progress['past_continuous']['quest_2'] = 1;
            $user->progress = $progress;
            $user->save();

            return response()->json(['message' => 'Progress updated successfully'], 200);
        }
    }

    public function updateProgress4Q3(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        if ($user) {
            $progress = $user->progress;
            $progress['karma'] += $request->karmaValue;
            $progress['past_continuous']['quest_3'] = 1;
            $user->progress = $progress;
            $user->save();

            return response()->json(['message' => 'Progress updated successfully'], 200);
        }
    }

    public function updateProgress5Q1(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        if ($user) {
            $progress = $user->progress;
            $progress['karma'] += $request->karmaValue;
            $progress['simple_future']['quest_1'] = 1;
            $user->progress = $progress;
            $user->save();

            return response()->json(['message' => 'Progress updated successfully'], 200);
        }
    }

    public function updateProgress5Q2(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        if ($user) {
            $progress = $user->progress;
            $progress['karma'] += $request->karmaValue;
            $progress['simple_future']['quest_2'] = 1;
            $user->progress = $progress;
            $user->save();

            return response()->json(['message' => 'Progress updated successfully'], 200);
        }
    }

    public function updateProgress5Q3(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        if ($user) {
            $progress = $user->progress;
            $progress['karma'] += $request->karmaValue;
            $progress['simple_future']['quest_3'] = 1;
            $user->progress = $progress;
            $user->save();

            return response()->json(['message' => 'Progress updated successfully'], 200);
        }
    }
}
