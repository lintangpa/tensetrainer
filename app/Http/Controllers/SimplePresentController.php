<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;

class SimplePresentController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data pengguna yang sedang login
        $user = $request->user();

        // Pengecekan untuk notifikasi prestasi
        $notifications = [];

        // Ambil data kemajuan pengguna dari kolom progress
        if (is_string($user->progress)) {
            $userProgress = json_decode($user->progress, true);
        } else {
            $userProgress = $user->progress;
        }

        // Ambil semua prestasi yang ada
        $achievements = Achievement::all();

        foreach ($achievements as $achievement) {
            // Ambil persyaratan prestasi dari kolom requirement
            $requirement = json_decode($achievement->requirement, true);

            // Periksa apakah pengguna memenuhi persyaratan untuk prestasi
            $isAchieved = true;
            foreach ($requirement['simple_present'] as $quest => $requiredProgress) {
                if ($userProgress['simple_present'][$quest] < $requiredProgress) {
                    $isAchieved = false;
                    break;
                }
            }

            // Jika pengguna memenuhi syarat, tambahkan notifikasi untuk prestasi tersebut
            if ($isAchieved) {
                $notifications[] = $achievement->nama;
            }
        }
        // dd($notifications);
        // Tampilkan halaman menu utama dengan notifikasi jika ada
        return view('user.simplepresent', compact('notifications'));
    }

    public function quest1()
    {
        return view('user.quizsimplepresent');
    }

    public function quest2()
    {
        return view('user.dragndrop');
    }
}
