<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        // Real Data Queries
        $stats = [
            'clients_today' => Client::whereDate('created_at', Carbon::today())->count(),
            'in_progress' => Sale::whereDate('created_at', Carbon::today())->where('status', 'in_progress')->count(),
            'cart_ready' => Sale::whereDate('created_at', Carbon::today())->where('status', 'pending_approval')->count(), // Assuming 'pending_approval' or similar logic
            // For now, let's say "Complétés" is completed sales today
            'completed' => Sale::whereDate('created_at', Carbon::today())->where('status', 'completed')->count(),
        ];

        // Fetch today's clients with sales details if available
        $recentClients = Client::with('sales')->whereDate('created_at', Carbon::today())->latest()->take(5)->get();

        $todayClients = $recentClients->map(function ($client) {
            $latestSale = $client->sales->first();
            $details = null;
            $status = 'Nouveau';
            $statusColor = 'bg-blue-100 text-blue-600';

            if ($latestSale) {
                if ($latestSale->status === 'completed') {
                    $status = 'Complété';
                    $statusColor = 'bg-green-100 text-green-600';
                    $details = [
                        'type' => $latestSale->details['type'] ?? 'N/A',
                        'index' => 'Indice ' . ($latestSale->details['lens_a']['index'] ?? 'N/A'),
                        'tag' => 'Recommandé',
                        'promo' => 'Promotion: ' . ($latestSale->details['promo'] ?? 'N/A'),
                    ];
                }
            }

            return [
                'time' => $client->created_at->format('H \h i'),
                'status' => $status,
                'status_color' => $statusColor,
                'details' => $details,
            ];
        });

        // Initialize mock data if empty (for demo purposes if no db data yet)
        if ($todayClients->isEmpty()) {
            // Keep mock data for first view so it's not empty empty
            // Or leave it empty. Let's leave it empty to show "Real" state, or maybe keep 1 fake one?
            // User said "make it work", usually implies "show me it working".
            // But real data is better. Let's stick to real.
        }

        return view('livewire.dashboard', [
            'stats' => $stats,
            'todayClients' => $todayClients,
            'date' => Carbon::now()->locale('es')->isoFormat('dddd D MMMM'),
        ]);
    }
}
