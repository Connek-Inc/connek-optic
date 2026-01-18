<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Material;
use Livewire\Attributes\Layout;

class MaterialList extends Component
{
    use WithPagination;

    public $search = '';
    public $isEditing = false;
    public $editId = null;
    public $showCreateModal = false;

    // Form inputs
    public $name = '';
    public $type = 'lens';
    public $price = '';
    public $stock = 0;
    public $description = '';

    protected $rules = [
        'name' => 'required|min:3',
        'type' => 'required',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'description' => 'nullable|string',
    ];

    #[Layout('components.layouts.app')]
    public function render()
    {
        $materials = Material::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.material-list', [
            'materials' => $materials,
        ]);
    }

    public function create()
    {
        $this->resetInput();
        $this->isEditing = false;
        $this->showCreateModal = true; // Renaming to showCreateModal is fine, or use showModal generic
    }

    public function edit($id)
    {
        $this->resetInput();
        $this->isEditing = true;
        $this->editId = $id;

        $m = Material::findOrFail($id);
        $this->name = $m->name;
        $this->type = $m->type;
        $this->price = $m->price;
        $this->stock = $m->stock;
        $this->description = $m->description;

        $this->showCreateModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $m = Material::findOrFail($this->editId);
            $m->update([
                'name' => $this->name,
                'type' => $this->type,
                'price' => $this->price,
                'stock' => $this->stock,
                'description' => $this->description,
            ]);
            session()->flash('message', 'Material actualizado correctamente.');
        } else {
            Material::create([
                'name' => $this->name,
                'type' => $this->type,
                'price' => $this->price,
                'stock' => $this->stock,
                'description' => $this->description,
            ]);
            session()->flash('message', 'Material añadido correctamente.');
        }

        $this->showCreateModal = false;
        $this->resetInput();
    }

    public function delete($id)
    {
        Material::findOrFail($id)->delete();
        session()->flash('message', 'Material eliminado correctamente.');
    }

    private function resetInput()
    {
        $this->name = '';
        $this->type = 'lens';
        $this->price = '';
        $this->stock = 0;
        $this->description = '';
        $this->editId = null;
    }
}
