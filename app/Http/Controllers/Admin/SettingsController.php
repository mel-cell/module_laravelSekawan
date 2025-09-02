<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileImageRequest;
use App\Models\User;

class SettingsController extends Controller
{
    public function index()
    {
        return view('page.admin.settings', [
            'user' => auth()->user()
        ]);
    }

    public function updateProfileImage(ProfileImageRequest $request)
    {
        try {
            $profileImagePath = $request->file('profileimg')->store('profile_images', 'public');
            $data = [
                'profileimg' => $profileImagePath
            ];

            $user = User::updateProfileImageById(Auth::id(), $data);

            if ($user) {
                return redirect()->back()->with('success', 'Profile image updated successfully!');
            } else {
                return redirect()->back()->with('error', 'User not found!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update profile image. Please try again.');
        }
    }
}
