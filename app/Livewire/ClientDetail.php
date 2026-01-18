<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\Sale;
use Livewire\Attributes\Layout;

class ClientDetail extends Component
{
    public Client $client;
    public $activeTab = 'overview';

    public function mount(Client $client)
    {
        $this->client = $client->load('sales');
    }

    public function sendEmail()
    {
        if (!auth()->check()) {
            return;
        }

        $recipient = auth()->user()->email;

        try {
            \Illuminate\Support\Facades\Mail::to($recipient)->send(new \App\Mail\PrescriptionMail($this->client));
            session()->flash('message', "Prescripción enviada a $recipient");
        } catch (\Exception $e) {
            session()->flash('error', "Error al enviar correo: " . $e->getMessage());
        }
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        $totalSpent = $this->client->sales->sum('total_amount');
        $totalPurchases = $this->client->sales->count();
        $lastVisit = $this->client->created_at->format('d M Y');

        return view('livewire.client-detail', [
            'totalSpent' => $totalSpent,
            'totalPurchases' => $totalPurchases,
            'lastVisit' => $lastVisit,
            'sales' => $this->client->sales()->orderBy('created_at', 'desc')->get(),
        ]);
    }
}
