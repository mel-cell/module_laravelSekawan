<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Borrowing;
use App\Models\User;
use App\Models\Book;
use App\Models\BorrowingDetail;
use App\Http\Requests\BorrowingRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BorrowingController extends Controller
{   
    public function index(): View
    {
        return view('page.admin.borrowing.index');
    }

    public function create(): View
    {
        $users = User::all();
        $books = Book::all();
        return view('page.admin.borrowing.create', compact('users', 'books'));
    }

    // simpan peminjaman baru ke database
    public function store(BorrowingRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            // Simpan data peminjaman
            $borrowing = Borrowing::create([
                'borrowing_id' => Str::uuid(),
                'borrowing_user_id' => $request->input('borrowing_user_id'),
                'borrowing_notes' => $request->input('borrowing_notes'),
                'borrowing_borrowed_at' => now(),
                'borrowing_returned' => false,
                'borrowing_fine' => 0,
            ]);

            // tambhakan Simpan detail peminjaman
            foreach ($request->books as $bookItem) {
                $book = Book::find($bookItem['book_id']);
                if ($book && $book->book_stock >= $bookItem['quantity']) {
                    DB::rollBack();
                    return back()->withErrors(['books' => 'stok buku tidak mencukupi'])->withInput();
            }
            $book->decrement('book_stock', $bookItem['quantity']);

                BorrowingDetail::create([
                    'detail_id' => Str::uuid(),
                    'detail_borrowing_id' => $borrowing->borrowing_id,
                    'detail_book_id' => $bookItem['book_id'],
                    'detail_quantity' => $bookItem['quantity'],
                ]);
            }

            DB::commit();
            return redirect()->route('admin.borrowing.index')->with('success', 'Peminjaman berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan peminjaman.'])->withInput();
        }
    }

    public function show(string $borrowingId): View
    {
        $borrowing = Borrowing::with(['user', 'borrowingDetails.book'])->findOrFail($borrowingId);
        return view('page.admin.borrowing.show', compact('borrowing'));
    }

    public function destroy(string $borrowingId): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $borrowing = Borrowing::with('details')->findOrFail($borrowingId);

            // Kembalikan stok buku
            foreach ($borrowing->details as $detail) {
                $book = Book::find($detail->detail_book_id);
                if ($book) {
                    $book->increment('book_stock', $detail->detail_quantity);
                }
            }

            // Hapus detail peminjaman
            BorrowingDetail::where('detail_borrowing_id', $borrowingId)->delete();

            // Hapus header peminjaman
            $borrowing->delete();
            DB::commit();
            return redirect()->route('admin.borrowing.index')->with('success', 'Peminjaman berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus peminjaman.']);
        }
    }

    public function returnBorrowing(string $borrowingId): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $borrowing = Borrowing::with('borrowingDetails')->findOrFail($borrowingId);
            if ($borrowing->borrowing_returned) {
                return back()->withErrors(['error' => 'Peminjaman sudah dikembalikan.']);
            }

            // Perbarui status pengembalian
            $borrowing->update([
                'borrowing_returned' => true,
                'returned_at' => now(),
            ]);

            // Kembalikan stok buku
            foreach ($borrowing->borrowingDetails as $detail) {
                $book = Book::find($detail->detail_book_id);
                if ($book) {
                    $book->increment('book_stock', $detail->detail_quantity);
                }
            }

            DB::commit();
            return redirect()->route('admin.borrowing.index')->with('success', 'Peminjaman berhasil dikembalikan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengembalikan peminjaman.']);
        }
    }

    public function getBookItemForm(Request $request): View
    {
        $books = Book::all();
        $index = $request->input('index', 0);
        return view('page.admin.borrowing.book_item', compact('books', 'index'));
    }
   
}
