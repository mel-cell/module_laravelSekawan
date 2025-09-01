<?php

namespace App\Livewire\Admin\Publishers;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Publisher;

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
        $publishers = Publisher::when($this->search, function ($query) {
                $query->where('publisher_name', 'like', '%' . $this->search . '%')
                      ->orWhere('publisher_description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.publishers.table', compact('publishers'));
    }
}
