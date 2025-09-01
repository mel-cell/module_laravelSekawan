<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class BorrowingController extends Controller
{
    public function index(): View
    {   
        $user = Auth::user();
        $borrowings = Borrowing::with(['details.book'])
            ->where('borrowing_user_id', $user->id)
            ->orderBy('borrowing_borrowed_at', 'desc')
            ->paginate(10);
        return view('page.user.borrowing.index', compact('borrowings'));
    }

    public function show(string $id): View|RedirectResponse
    {
        $userId = Auth()->user()->id;
        $borrowing = Borrowing::getUserBorrowingById($userId, $id);
        if (!$borrowing) {
            abort(404, 'Transaksi peminjaman tidak ditemukan.');
        }
        return view('page.user.borrowing.show', compact('borrowing'));
    }

    
}
