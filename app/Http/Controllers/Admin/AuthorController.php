<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // Tidak terpakai lagi setelah update, bisa dihapus jika tidak ada method lain yang menggunakannya
use App\Http\Requests\AuthorRequest;
use App\Models\Author as AuthorModel; // Pastikan alias ini konsisten dengan nama Model Anda (Author bukan AuthorModel di Models/Author.php)
use Illuminate\Http\RedirectResponse; 
use Illuminate\View\View;

class AuthorController extends Controller
{
    /**
     * Menampilkan daftar penulis dengan pagination menggunakan custom method dari Model.
     * Operasi: Read
     */
    public function index(): View
    {
        // Memanggil custom method getAllAuthors() dari AuthorModel
        $authors = AuthorModel::getAllAuthors(10); // Menampilkan 10 data per halaman
        return view('page.admin.author', compact('authors'));
    }

    /**
     * Menyimpan data penulis baru menggunakan custom method dari Model.
     * Menggunakan AuthorRequest untuk validasi dan AuthorModel::createNewAuthor().
     * Operasi: Create
     */
    public function store(AuthorRequest $request): RedirectResponse
    {
        // Data sudah divalidasi oleh AuthorRequest dan hanya mengambil yang diperbolehkan
        $validatedData = $request->validated();
        
        // Memanggil custom method createNewAuthor() dari AuthorModel
        $operation = AuthorModel::createNewAuthor($validatedData);

        if ($operation) {
            return redirect()->route('admin.author')->with('success', 'Data penulis berhasil ditambahkan.');
        } else {
            return redirect()->route('admin.author')->with('error', 'Gagal menambahkan data penulis.');
        }
    }

    /**
     * Memperbarui data penulis menggunakan custom method dari Model.
     * Menggunakan AuthorRequest untuk validasi dan AuthorModel::updateExistingAuthor().
     * Operasi: Update
     */
    public function update(AuthorRequest $request, string $id): RedirectResponse
    {
        // Data sudah divalidasi oleh AuthorRequest
        $validatedData = $request->validated();
        
        // Memanggil custom method updateExistingAuthor() dari AuthorModel
        $operation = AuthorModel::updateExistingAuthor($validatedData, $id);

        if ($operation) {
            return redirect()->route('admin.author')->with('success', 'Data penulis berhasil diperbarui.');
        } else {
            return redirect()->route('admin.author')->with('error', 'Gagal memperbarui data penulis.');
        }
    }

    /**
     * Menghapus data penulis menggunakan custom method dari Model.
     * Menggunakan AuthorModel::deleteAuthorById().
     * Operasi: Delete
     */
    public function destroy(string $id): RedirectResponse
    {
        // Memanggil custom method deleteAuthorById() dari AuthorModel
        $operation = AuthorModel::deleteAuthorById($id);

        if ($operation) {
            return redirect()->route('admin.author')->with('success', 'Data penulis berhasil dihapus.');
        } else {
            return redirect()->route('admin.author')->with('error', 'Gagal menghapus data penulis.');
        }
    }
}
