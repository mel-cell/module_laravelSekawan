<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

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
}
