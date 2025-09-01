<?php

namespace App\Livewire\Admin\Books;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Book;

class Table extends Component
{   
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $books = Book::with(['author', 'publisher', 'category', 'shelf'])
            ->where(function ($query) {
                $query->where('book_name', 'like', '%' . $this->search . '%')
                    ->orWhere('book_isbn', 'like', '%' . $this->search . '%')
                    ->orWhereHas('publisher', function ($q) {
                        $q->where('publisher_name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('author', function ($q) {
                        $q->where('author_name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('category', function ($q) {
                        $q->where('category_name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('shelf', function ($q) {
                        $q->where('shelf_name', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy('book_name', 'asc')
            ->paginate(10);

        return view('livewire.admin.books.table', compact('books'));
    }
}
