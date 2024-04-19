<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;
use OpenAI;
use OpenAI\Client;

class PresentContinuousController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $notifications = [];
        if (is_string($user->progress)) {
            $userProgress = json_decode($user->progress, true);
        } else {
            $userProgress = $user->progress;
        }
        $achievements = Achievement::all();

        foreach ($achievements as $achievement) {
            if ($user->achievement && array_key_exists($achievement->nama, $user->achievement)) {
                continue;
            }
            $requirement = json_decode($achievement->requirement, true);

            $isAchieved = true;
            foreach ($requirement['simple_present'] as $quest => $requiredProgress) {
                if ($userProgress['simple_present'][$quest] < $requiredProgress) {
                    $isAchieved = false;
                    break;
                }
            }
            if ($isAchieved) {
                $this->storeAchievement($user, $achievement->nama);
                $notifications[] = $achievement->nama;
            }
        }
        return view('user.presentContinuousQuiz.presentContinuousHome', compact('notifications', 'userProgress'));
    }

    public function quest1()
    {
        return view('user.simplePresentQuiz.simplepresent1');
    }

    public function quest2()
    {
        return view('user.simplePresentQuiz.simplepresent2');
    }

    public function quest3()
    {
        return view('user.simplePresentQuiz.simplepresent3');
    }

    private function storeAchievement(User $user, $achievementName)
    {

        $achievements = $user->achievement ?: [];
        $achievements[$achievementName] = true;
        $user->update(['achievement' => $achievements]);
    }
}
