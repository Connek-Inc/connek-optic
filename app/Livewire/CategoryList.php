<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryList extends Component
{
    use WithPagination;

    public $search = '';
    public $isModalOpen = false;
    public $editingCategory = null;

    // Form fields
    public $name = '';
    public $description = ''; // Just in case we add this later, or use as placeholder

    protected $rules = [
        'name' => 'required|min:3|unique:categories,name',
    ];

    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('name')
            ->paginate(12); // Grid friendly pagination

        return view('livewire.category-list', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $this->reset(['name', 'editingCategory']);
        $this->isModalOpen = true;
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->editingCategory = $category;
        $this->name = $category->name;
        $this->isModalOpen = true;
    }

    public function save()
    {
        // Custom validation for edit to ignore current ID
        $this->validate([
            'name' => 'required|min:3|unique:categories,name,' . ($this->editingCategory ? $this->editingCategory->id : ''),
        ]);

        if ($this->editingCategory) {
            $this->editingCategory->update(['name' => $this->name]);
            session()->flash('message', 'Category updated successfully.');
        } else {
            Category::create(['name' => $this->name]);
            session()->flash('message', 'Category created successfully.');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        // Optional: Check if products exist before deleting?
        // For now, let's keep it simple or show error if SQL constraint fails.
        $category->delete();
        session()->flash('message', 'Category deleted successfully.');
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->reset(['name', 'editingCategory']);
    }
}
