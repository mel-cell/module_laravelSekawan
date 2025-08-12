<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'category'])->limit(5)->get();
        $categories = Category::withCount('books')->limit(5)->get();
        
        return view('page.user.Home', compact('books', 'categories'));
    }
}
