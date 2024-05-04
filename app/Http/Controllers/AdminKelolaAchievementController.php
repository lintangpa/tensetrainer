<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AdminKelolaAchievementController extends Controller
{
    public function index()
    {
        $achievement = Achievement::all();
        return view('admin.adminKelolaAchievement', compact('achievement'));
    }

    public function findId($id)
    {
        $achievement = Achievement::findOrFail($id);
        return response()->json($achievement);
    }

    public function updateDetail(Request $request, $id)
    {
        $achievement= Achievement::findOrFail($id);
        $achievement->nama = $request->input('nama');
        $achievement->deskripsi = $request->input('deskripsi');
        $achievement->requirement = $request->input('requirement');
        $achievement->icon = $request->input('icon');
        $achievement->save();

        return response()->json($achievement);
    }
}

