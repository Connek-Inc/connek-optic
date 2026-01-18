<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Sale;
use Livewire\Attributes\Layout;

class SaleList extends Component
{
    use WithPagination;

    public $search = '';

    #[Layout('components.layouts.app')]
    public function render()
    {
        $sales = Sale::with('client')
            ->whereHas('client', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orWhere('id', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.sale-list', [
            'sales' => $sales,
        ]);
    }
}
