<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.register');
    }

   public function store(RegisterRequest $request)
    {
        // Jika validasi sukses, cetak input
        dd($request->all());

        // Jika ingin redirect ke halaman lain:
        // return redirect()->route('register.success')->with('success', 'Registration successful!');
    }
}
