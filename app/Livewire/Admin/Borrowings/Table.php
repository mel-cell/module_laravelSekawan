<?php

namespace App\Livewire\Admin\Borrowings;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Borrowing;

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
        $borrowings = Borrowing::with(['user', 'borrowingDetails.book'])
            ->when($this->search, function ($query) {
                $query->whereHas('user', function ($userQuery) {
                    $userQuery->where('username', 'like', '%' . $this->search . '%')
                             ->orWhere('email', 'like', '%' . $this->search . '%');
                })
                ->orWhere('borrowing_id', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.borrowings.table', compact('borrowings'));
    }
}
