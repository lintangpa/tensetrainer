<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use \App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $this->updateLevel($user);

        $currentLevel = $user->level;
        $nextLevel = $currentLevel + 1;

        // Mengambil batas EXP level saat ini dan level berikutnya
        $currentExpRequirement = isset(User::$expRequirements[$currentLevel]) ? User::$expRequirements[$currentLevel] : 0;
        $nextExpRequirement = isset(User::$expRequirements[$nextLevel]) ? User::$expRequirements[$nextLevel] : $currentExpRequirement;

        // Menghitung persentase EXP
        $expPercentage = 0;
        if ($nextExpRequirement !== $currentExpRequirement) {
            $expPercentage = round(($user->exp - $currentExpRequirement) / ($nextExpRequirement - $currentExpRequirement) * 100);
        }

        return view('user.dashboard', compact('user', 'expPercentage'));
    }

    private function updateLevel(User $user)
    {
        $totalExp = $user->exp;
        $level = 1;

        $expRequirements = [
            1 => 0,
            2 => 100,
            3 => 300,
            4 => 600,
            5 => 1000,
            6 => 1500,
            7 => 2100,
            8 => 2800,
            9 => 3600,
            10 => 4500,
        ];

        foreach ($expRequirements as $requiredLevel => $requiredExp) {
            if ($totalExp >= $requiredExp) {
                $level = $requiredLevel;
            } else {
                break;
            }
        }

        $user->level = $level;
        $user->save();
    }
}
