<div class="max-w-6xl mx-auto py-8 px-4">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 mb-8 flex justify-between items-start">
        <div class="flex items-center space-x-6">
            <div
                class="w-24 h-24 bg-teal-100 text-teal-600 rounded-full flex items-center justify-center text-3xl font-bold">
                {{ substr($client->name, 0, 1) }}
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-900">{{ $client->name }}</h1>
                <div class="flex items-center space-x-4 text-slate-500 mt-2">
                    <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg> {{ $client->email ?? 'No email' }}</span>
                    <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg> {{ $client->phone ?? 'No teléfono' }}</span>
                </div>
                <div class="mt-4 flex space-x-3">
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Cliente
                        Activo</span>
                    <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-xs font-bold">Registro:
                        {{ $lastVisit }}</span>
                </div>
            </div>
        </div>
        <div class="text-right">
            <div class="text-right space-y-2">
                <div>
                    <span class="block text-sm text-slate-500">Total Gastado</span>
                    <span class="text-3xl font-bold text-slate-900">${{ number_format($totalSpent, 2) }}</span>
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <a href="{{ route('print.prescription', $client) }}" target="_blank"
                        class="px-4 py-2 bg-white border border-slate-300 rounded-lg text-sm font-bold text-slate-700 hover:bg-slate-50 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                            </path>
                        </svg>
                        Imprimir
                    </a>
                    <button wire:click="sendEmail"
                        class="px-4 py-2 bg-brand-primary text-white rounded-lg text-sm font-bold hover:bg-brand-light flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        Enviar a mi Correo
                    </button>
                </div>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="mb-6 bg-green-50 text-green-700 px-4 py-3 rounded-lg border border-green-200">
                {{ session('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="mb-6 bg-red-50 text-red-700 px-4 py-3 rounded-lg border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tabs -->
        <div class="flex space-x-1 mb-8 border-b border-slate-200">
            <button wire:click="setTab('overview')"
                class="px-6 py-3 font-medium text-sm transition-colors border-b-2 {{ $activeTab === 'overview' ? 'border-teal-500 text-teal-600' : 'border-transparent text-slate-500 hover:text-slate-700' }}">
                General
            </button>
            <button wire:click="setTab('invoices')"
                class="px-6 py-3 font-medium text-sm transition-colors border-b-2 {{ $activeTab === 'invoices' ? 'border-teal-500 text-teal-600' : 'border-transparent text-slate-500 hover:text-slate-700' }}">
                Facturas / Compras
            </button>
            <button wire:click="setTab('formulas')"
                class="px-6 py-3 font-medium text-sm transition-colors border-b-2 {{ $activeTab === 'formulas' ? 'border-teal-500 text-teal-600' : 'border-transparent text-slate-500 hover:text-slate-700' }}">
                Fórmulas de Lentes
            </button>
        </div>

        <!-- Content -->
        <div class="animate-fade-in">
            <!-- Overview Tab -->
            @if($activeTab === 'overview')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                        <h3 class="font-bold text-slate-800 mb-4">Última Prescripción</h3>
                        @if($client->prescription_details)
                            @php $presc = json_decode($client->prescription_details, true); @endphp
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-center border-collapse">
                                    <thead>
                                        <tr class="bg-slate-50 text-slate-500">
                                            <th class="p-2 border border-slate-200">Ojo</th>
                                            <th class="p-2 border border-slate-200">SPH</th>
                                            <th class="p-2 border border-slate-200">CYL</th>
                                            <th class="p-2 border border-slate-200">AXIS</th>
                                            <th class="p-2 border border-slate-200">ADD</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="p-2 border border-slate-200 font-bold">OD</td>
                                            <td class="p-2 border border-slate-200">{{ $presc['sph_od'] ?? '-' }}</td>
                                            <td class="p-2 border border-slate-200">{{ $presc['cyl_od'] ?? '-' }}</td>
                                            <td class="p-2 border border-slate-200">{{ $presc['axis_od'] ?? '-' }}</td>
                                            <td class="p-2 border border-slate-200">{{ $presc['add_od'] ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 border border-slate-200 font-bold">OI</td>
                                            <td class="p-2 border border-slate-200">{{ $presc['sph_og'] ?? '-' }}</td>
                                            <td class="p-2 border border-slate-200">{{ $presc['cyl_og'] ?? '-' }}</td>
                                            <td class="p-2 border border-slate-200">{{ $presc['axis_og'] ?? '-' }}</td>
                                            <td class="p-2 border border-slate-200">{{ $presc['add_og'] ?? '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="mt-2 text-center text-xs text-slate-400">DP: {{ $presc['pd'] ?? 'N/A' }} mm</div>
                            </div>
                        @else
                            <p class="text-slate-500 italic">No hay datos de prescripción registrados.</p>
                        @endif
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                        <h3 class="font-bold text-slate-800 mb-4">Notas Internas</h3>
                        <textarea
                            class="w-full h-32 border border-slate-200 rounded-lg p-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500"
                            placeholder="Agregar notas sobre el cliente..."></textarea>
                        <button class="mt-2 bg-slate-800 text-white px-4 py-2 rounded text-sm hover:bg-slate-700">Guardar
                            Nota</button>
                    </div>
                </div>
            @endif

            <!-- Invoices Tab -->
            @if($activeTab === 'invoices')
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-xs uppercase font-medium text-slate-500">
                            <tr>
                                <th class="px-6 py-3">ID Venta</th>
                                <th class="px-6 py-3">Fecha</th>
                                <th class="px-6 py-3">Detalles</th>
                                <th class="px-6 py-3 text-center">Estado</th>
                                <th class="px-6 py-3 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($sales as $sale)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 font-mono text-xs">#{{ $sale->id }}</td>
                                    <td class="px-6 py-4">{{ $sale->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="block font-medium">{{ ucfirst($sale->details['type'] ?? 'Venta') }}</span>
                                        <span class="text-xs text-slate-400">{{ $sale->details['promo'] ?? '' }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Completado</span>
                                    </td>
                                    <td class="px-6 py-4 text-right font-bold">${{ number_format($sale->total_amount, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">No hay compras registradas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- Formulas Tab -->
            @if($activeTab === 'formulas')
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden p-6">
                    <h3 class="font-bold text-slate-800 mb-6">Historial de Fórmulas</h3>
                    <!-- Currently showing only the main one associated with client profile, could loop through past sales if they stored unique formulas -->
                    @if($client->prescription_details)
                        @php $presc = json_decode($client->prescription_details, true); @endphp
                        <div class="border border-teal-100 rounded-xl p-6 bg-teal-50/20 mb-6">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="font-bold text-teal-800">Prescripción Actual</h4>
                                <span class="text-sm text-slate-500">{{ $client->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="grid grid-cols-2 gap-8">
                                <div>
                                    <h5 class="font-bold text-slate-700 mb-2 border-b border-slate-200 pb-1">Ojo Derecho (OD)
                                    </h5>
                                    <div class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
                                        <span class="text-slate-500">Esfera:</span> <span
                                            class="font-mono font-bold">{{ $presc['sph_od'] ?? '0.00' }}</span>
                                        <span class="text-slate-500">Cilindro:</span> <span
                                            class="font-mono font-bold">{{ $presc['cyl_od'] ?? '0.00' }}</span>
                                        <span class="text-slate-500">Eje:</span> <span
                                            class="font-mono font-bold">{{ $presc['axis_od'] ?? '0' }}°</span>
                                        <span class="text-slate-500">Adición:</span> <span
                                            class="font-mono font-bold">{{ $presc['add_od'] ?? '0.00' }}</span>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="font-bold text-slate-700 mb-2 border-b border-slate-200 pb-1">Ojo Izquierdo (OI)
                                    </h5>
                                    <div class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
                                        <span class="text-slate-500">Esfera:</span> <span
                                            class="font-mono font-bold">{{ $presc['sph_og'] ?? '0.00' }}</span>
                                        <span class="text-slate-500">Cilindro:</span> <span
                                            class="font-mono font-bold">{{ $presc['cyl_og'] ?? '0.00' }}</span>
                                        <span class="text-slate-500">Eje:</span> <span
                                            class="font-mono font-bold">{{ $presc['axis_og'] ?? '0' }}°</span>
                                        <span class="text-slate-500">Adición:</span> <span
                                            class="font-mono font-bold">{{ $presc['add_og'] ?? '0.00' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-slate-500">No hay fórmulas registradas.</p>
                    @endif
                </div>
            @endif
        </div>
    </div>