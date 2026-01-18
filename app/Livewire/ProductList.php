<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;

class ProductList extends Component
{
    use WithPagination;

    public $search = '';
    public $showCreateModal = false;

    // Form inputs
    public $name = '';
    public $brand = '';
    public $sku = '';
    public $price = '';
    public $stock_quantity = 0;
    public $category_id = null;
    public $description = '';

    protected $rules = [
        'name' => 'required|min:3',
        'brand' => 'required',
        'sku' => 'required|unique:products,sku',
        'price' => 'required|numeric|min:0',
        'stock_quantity' => 'required|integer|min:0',
        'description' => 'nullable|string',
    ];

    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('sku', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.product-list', [
            'products' => $products,
            'categories' => Category::all(),
        ]);
    }

    public function create()
    {
        $this->reset(['name', 'brand', 'sku', 'price', 'stock_quantity', 'category_id', 'description']);
        $this->showCreateModal = true;
    }

    public function save()
    {
        $this->validate();

        Product::create([
            'name' => $this->name,
            'brand' => $this->brand,
            'sku' => $this->sku,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'category_id' => $this->category_id,
            'description' => $this->description,
        ]);

        $this->showCreateModal = false;
        $this->reset(['name', 'brand', 'sku', 'price', 'stock_quantity', 'category_id', 'description']);

        session()->flash('message', 'Producto creado exitosamente.');
    }
}
