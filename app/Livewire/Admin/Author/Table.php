<?php

namespace App\Livewire\Admin\Author;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Author;

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
        $authors = Author::where('author_name', 'like', '%' . $this->search . '%')
            ->orWhere('author_description', 'like', '%' . $this->search . '%')
            ->orderBy('author_name', 'asc')
            ->paginate(10);

        return view('livewire.admin.author.table', compact('authors'));
    }
}
