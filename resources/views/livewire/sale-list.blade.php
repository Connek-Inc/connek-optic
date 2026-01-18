<div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-slate-800">Facturas / Ventas</h2>

        <div class="flex items-center space-x-4">
            <input wire:model.live="search" type="text" placeholder="Buscar por cliente o ID..."
                class="px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-xs uppercase font-medium text-slate-500">
                <tr>
                    <th class="px-6 py-3">ID Venta</th>
                    <th class="px-6 py-3">Cliente</th>
                    <th class="px-6 py-3">Fecha</th>
                    <th class="px-6 py-3">Detalles</th>
                    <th class="px-6 py-3 text-center">Estado</th>
                    <th class="px-6 py-3 text-right">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100" wire:poll.10s>
                @forelse($sales as $sale)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs text-slate-500">#{{ $sale->id }}</td>
                        <td class="px-6 py-4 font-medium text-slate-900">
                            {{ $sale->client->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $sale->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4 text-xs">
                            @if(isset($sale->details['promo']))
                                <span class="block text-teal-600 font-medium">{{ ucfirst($sale->details['promo']) }}</span>
                            @endif
                            @if(isset($sale->details['lens_a']['index']))
                                <span class="block text-slate-500">Index {{ $sale->details['lens_a']['index'] }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span
                                class="px-2 py-1 rounded-full text-xs font-medium 
                                    {{ $sale->status === 'completed' ? 'bg-green-50 text-green-600' : 'bg-orange-50 text-orange-600' }}">
                                {{ $sale->status === 'completed' ? 'Completado' : 'En Proceso' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right font-bold text-slate-800">
                            ${{ number_format($sale->total_amount, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                            No se encontraron ventas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-slate-100">
        {{ $sales->links() }}
    </div>
</div>