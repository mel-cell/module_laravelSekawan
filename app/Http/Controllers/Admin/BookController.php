<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Shelf;
use App\Http\Requests\BookRequest;
use Illuminate\Http\RedirectResponse;

class BookController extends Controller
{
    public function index(): View
    {   
        $books = Book::getAllBooks(10);
        return view('page.admin.books.index', compact('books'));
    }

    public function create(): View
    {
        $authors = Author::all();
        $categories = Category::all();
        $publishers = Publisher::all();
        $shelves = Shelf::all();
        return view('page.admin.books.create', compact('authors', 'categories', 'publishers', 'shelves'));
    }

    public function store(BookRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $operation = Book::createNewBook($validatedData);

        if ($operation) {
            return redirect()->route('admin.books')->with('success', 'Data buku berhasil ditambahkan.');
        } else {
            return redirect()->route('admin.books')->with('error', 'Gagal menambahkan data buku.');
        }
    }

    public function edit(string $book_id): View
    {
        $book = Book::findBookById($book_id);
        if (!$book) {
            abort(404); // Atau redirect dengan error
        }

        $authors = Author::all();
        $publishers = Publisher::all();
        $categories = Category::all();
        $shelves = Shelf::all();

        return view('page.admin.books.edit', compact('book', 'authors', 'publishers', 'categories', 'shelves'));
    }

    public function update(BookRequest $request, string $book_id): RedirectResponse
    {
        $validatedData = $request->validated();
        $operation = Book::updateExistingBook($validatedData, $book_id);

        if ($operation) {
            return redirect()->route('admin.books')->with('success', 'Data buku berhasil diperbarui.');
        } else {
            return redirect()->route('admin.books')->with('error', 'Gagal memperbarui data buku.');
        }
    }

    public function destroy(string $book_id): RedirectResponse
    {
        $operation = Book::deleteBookById($book_id);

        if ($operation) {
            return redirect()->route('admin.books')->with('success', 'Data buku berhasil dihapus.');
        } else {
            return redirect()->route('admin.books')->with('error', 'Gagal menghapus data buku.');
        }
    }
}
