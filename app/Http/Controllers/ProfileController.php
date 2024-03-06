<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('user.profile');
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();

        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update name and email
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password if provided
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Update profile picture if provided
        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $imagePath;
        }

        // Save changes
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
