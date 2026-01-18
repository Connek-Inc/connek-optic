<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Promotion;
use Livewire\Attributes\Layout;

class PromotionList extends Component
{
    public $promotions;
    public $showModal = false;
    public $isEditing = false;
    public $editId = null;

    // Form Fields
    public $name, $price, $description, $type = 'simple', $featuresText = '', $active = true;

    protected $rules = [
        'name' => 'required|string|min:3',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'type' => 'required|string',
        'featuresText' => 'nullable|string', // Comma separated
        'active' => 'boolean',
    ];

    public function mount()
    {
        $this->loadPromotions();
    }

    public function loadPromotions()
    {
        $this->promotions = Promotion::orderBy('created_at', 'desc')->get();
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.promotion-list');
    }

    public function create()
    {
        $this->resetInput();
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->resetInput();
        $this->isEditing = true;
        $this->editId = $id;

        $p = Promotion::findOrFail($id);
        $this->name = $p->name;
        $this->price = $p->price;
        $this->description = $p->description;
        $this->type = $p->type;
        $this->active = $p->active;

        // Convert array features to comma-separated string for editing
        if ($p->features && is_array($p->features)) {
            $this->featuresText = implode("\n", $p->features);
        } else {
            $this->featuresText = '';
        }

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        // Process features text -> array
        $featuresArray = array_filter(array_map('trim', explode("\n", $this->featuresText)));

        if ($this->isEditing) {
            $p = Promotion::findOrFail($this->editId);
            $p->update([
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
                'type' => $this->type,
                'features' => $featuresArray,
                'active' => $this->active,
            ]);
            session()->flash('message', 'Promoción actualizada.');
        } else {
            Promotion::create([
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
                'type' => $this->type,
                'features' => $featuresArray,
                'active' => $this->active,
            ]);
            session()->flash('message', 'Promoción creada.');
        }

        $this->showModal = false;
        $this->loadPromotions();
    }

    public function delete($id)
    {
        Promotion::findOrFail($id)->delete();
        $this->loadPromotions();
        session()->flash('message', 'Promoción eliminada.');
    }

    public function toggleStatus($id)
    {
        $p = Promotion::findOrFail($id);
        $p->active = !$p->active;
        $p->save();
        $this->loadPromotions();
    }

    private function resetInput()
    {
        $this->name = '';
        $this->price = '';
        $this->description = '';
        $this->type = 'simple';
        $this->featuresText = '';
        $this->active = true;
        $this->editId = null;
    }
}
