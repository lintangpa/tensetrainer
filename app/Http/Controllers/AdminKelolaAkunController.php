<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminKelolaAkunController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.adminKelolaAkun', compact('users'));
    }

    public function findId($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function updateDetail(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->exp = $request->input('exp');
        $progress = json_decode($request->input('progress'), true);
        $user->progress = $progress;
        $achievement = json_decode($request->input('achievement'), true);
        $user->achievement = $achievement;
        $user->save();

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully.']);
        } else {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }

}
