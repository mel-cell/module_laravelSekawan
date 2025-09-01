<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

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
        $categories = Category::where('category_name', 'like', '%' . $this->search . '%')
            ->orWhere('category_description', 'like', '%' . $this->search . '%')
            ->orderBy('category_name', 'asc')
            ->paginate(10);

        return view('livewire.admin.categories.table', compact('categories'));
    }
}
