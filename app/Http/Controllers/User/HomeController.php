<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProfileImageRequest;

class HomeController extends Controller
{
    public function index()
    {
        return view('page.user.home', [
            'borrowedBooksCount' => 5,
            'dueSoonCount' => 2,
            'overdueCount' => 1,
            'recentBooks' => Book::with(['author', 'category'])->latest()->limit(5)->get()
        ]);
    }

    public function settings()
    {
        return view('page.user.settings', [
            'user' => auth()->user()
        ]);
    }

    public function updatePersonalInfo(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:150',
            'last_name' => 'required|string|max:150',
            'username' => 'required|string|max:150|unique:users,username,' . auth()->id(),
            'email' => 'required|email|max:150|unique:users,email,' . auth()->id(),
        ]);

        DB::table('users')
            ->where('id', auth()->id())
            ->update($request->only(['first_name', 'last_name', 'username', 'email']));

        return redirect()->back()->with('success', 'Personal information updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        DB::table('users')
            ->where('id', auth()->id())
            ->update(['password' => Hash::make($request->password)]);

        return redirect()->back()->with('success', 'Password updated successfully!');
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
