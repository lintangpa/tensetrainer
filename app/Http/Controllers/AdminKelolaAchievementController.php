<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminKelolaAchievementController extends Controller
{
    public function index()
    {
        $achievement = Achievement::all();
        return view('admin.adminKelolaAchievement', compact('achievement'));
    }

    public function findId($id)
    {
        $penghargaan = Achievement::findOrFail($id);
        return response()->json($penghargaan);
    }

    public function updateDetail(Request $request, $id)
    {   
        $penghargaan = Achievement::findOrFail($id);
        $penghargaan->nama = $request->input('nama');
        $penghargaan->deskripsi = $request->input('deskripsi');
        $penghargaan->requirement = $request->input('requirement');
        
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $filename = date('Y-m-d') . $icon->getClientOriginalName();
            $path = 'images/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($icon));
            $penghargaan->icon = $filename;
        }
        
        $penghargaan->save();
    
        return response()->json($penghargaan);
    }
    

    public function destroy($id)
    {
        $penghargaan = Achievement::find($id);
        if ($penghargaan) {
            $penghargaan->delete();
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
            'icon' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);

        $nama = $request->input('nama');
        $deskripsi = $request->input('deskripsi');
        $requirement = $request->input('requirement');
        $icon = $request->file('icon');
        $filename = date('Y-m-d') . $icon->getClientOriginalName();
        $path = 'images/' . $filename;

        Storage::disk('public')->put($path, file_get_contents($icon));

        $penghargaan = new Achievement();
        $penghargaan->nama = $nama;
        $penghargaan->deskripsi = $deskripsi;
        $penghargaan->requirement = $requirement;
        $penghargaan->icon = $filename;
        $penghargaan->save();
        return redirect()->route('admin-kelola-achievement');
    }
}
