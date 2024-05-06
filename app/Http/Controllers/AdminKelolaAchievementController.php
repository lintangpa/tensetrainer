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

    public function destroy($id)
    {
        $achievement = Achievement::find($id);
        if ($achievement) {
            $achievement->delete();
            return response()->json(['message' => 'Achievement deleted successfully.']);
        } else {
            return response()->json(['error' => 'Achievement not found.'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'requirement' => 'required|json',
            'icon' => 'required|string',
        ]);

        $nama = $request->input('nama');
        $deskripsi = $request->input('deskripsi');
        $requirement = $request->input('requirement'); 
        $icon = $request->input('icon');

        $achievement = new Achievement();
        $achievement->nama = $nama;
        $achievement->deskripsi = $deskripsi;
        $achievement->requirement = $requirement;
        $achievement->icon = $icon;
        $achievement->save();
        return redirect()->route('admin-kelola-achievement');
    }
}

