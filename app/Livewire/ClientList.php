<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Client;
use Livewire\Attributes\Layout;

class ClientList extends Component
{
    use WithPagination;

    public $search = '';
    public $showCreateModal = false;

    // Form inputs
    public $name = '';
    public $email = '';
    public $phone = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'nullable|email',
        'phone' => 'nullable|string',
    ];

    #[Layout('components.layouts.app')]
    public function render()
    {
        $clients = Client::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.client-list', [
            'clients' => $clients,
        ]);
    }

    public function create()
    {
        $this->reset(['name', 'email', 'phone']);
        $this->showCreateModal = true;
    }

    public function save()
    {
        $this->validate();

        Client::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        $this->showCreateModal = false;
        $this->reset(['name', 'email', 'phone']);

        session()->flash('message', 'Cliente añadido correctamente.');
    }
}
