<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // If user is authenticated, redirect to appropriate dashboard
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.Home');
            }
        }

        // If not authenticated, show guest home page
        return view('Home');
    }
}
