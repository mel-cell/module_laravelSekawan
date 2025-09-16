<?php

namespace App\Livewire\Admin\Books;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Book;

class Table extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $books = Book::with(['author', 'publisher', 'category', 'shelf'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('book_name', 'like', '%' . $this->search . '%')
                        ->orWhere('book_isbn', 'like', '%' . $this->search . '%')
                        ->orWhereHas('publisher', function ($subQ) {
                            $subQ->where('publisher_name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('author', function ($subQ) {
                            $subQ->where('author_name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('category', function ($subQ) {
                            $subQ->where('category_name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('shelf', function ($subQ) {
                            $subQ->where('shelf_name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->orderBy('book_name', 'asc')
            ->paginate(10);

        return view('livewire.admin.books.table', compact('books'));
    }
}
