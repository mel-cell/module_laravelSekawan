<?php

namespace App\Livewire\Admin\Shifts;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Shelf;

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
        $shifts = Shelf::when($this->search, function ($query) {
                $query->where('shelf_name', 'like', '%' . $this->search . '%')
                      ->orWhere('shelf_position', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.shifts.table', compact('shifts'));
    }
}
