<div>
    <!-- Desktop View Container -->
    <div
        class="hidden md:block bg-white dark:bg-neutral-900 rounded-xl shadow-sm border border-slate-100 dark:border-neutral-800 overflow-hidden">
        <!-- Desktop Header -->
        <div class="px-6 py-4 border-b border-slate-100 dark:border-neutral-800 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-slate-800 dark:text-cream">Clientes</h2>
            <div class="flex items-center space-x-4">
                <input wire:model.live="search" type="text" placeholder="Buscar cliente..."
                    class="px-4 py-2 border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-slate-900 dark:text-cream rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-primary placeholder-slate-400">
                <a href="{{ route('nouveau.client') }}"
                    class="bg-brand-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-brand-light transition-colors">
                    + Nuevo Wizard
                </a>
            </div>
        </div>

        @if (session()->has('message'))
            <div
                class="px-6 py-4 bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 border-b border-green-100 dark:border-green-800">
                {{ session('message') }}
            </div>
        @endif

        <!-- Desktop Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
                <thead
                    class="bg-slate-50 dark:bg-neutral-800 text-xs uppercase font-medium text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class="px-6 py-3">Nombre</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Teléfono</th>
                        <th class="px-6 py-3 text-center">Registrado</th>
                        <th class="px-6 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-neutral-800" wire:poll.10s>
                    @forelse($clients as $client)
                        <tr class="hover:bg-slate-50 dark:hover:bg-neutral-800 transition-colors">
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-cream">{{ $client->name }}</td>
                            <td class="px-6 py-4">{{ $client->email ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $client->phone ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">{{ $client->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('clientes.show', $client->id) }}"
                                    class="text-brand-primary dark:text-brand-light hover:text-brand-primary/80 font-medium mr-2">Ver
                                    Perfil</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">No se
                                encontraron clientes.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-100 dark:border-neutral-800">
            {{ $clients->links() }}
        </div>
    </div>

    <!-- Mobile View (Independent Elements) -->
    <div class="md:hidden">
        <!-- Mobile Header (Search + Add Button) -->
        <div class="flex gap-2 mb-4">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </span>
                <input wire:model.live="search" type="text" placeholder="Buscar..."
                    class="w-full pl-10 pr-4 py-3 border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-slate-900 dark:text-cream rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-primary">
            </div>
            <a href="{{ route('nouveau.client') }}"
                class="bg-brand-primary text-white w-12 h-12 flex items-center justify-center rounded-xl shadow-md hover:bg-brand-light transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </a>
        </div>

        @if (session()->has('message'))
            <div
                class="mb-4 px-4 py-3 bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 rounded-xl border border-green-100 dark:border-green-800">
                {{ session('message') }}
            </div>
        @endif

        <!-- Mobile Cards List -->
        <div class="space-y-4">
            @forelse($clients as $client)
                <div
                    class="bg-white dark:bg-neutral-800 p-5 rounded-xl border border-slate-100 dark:border-neutral-700 shadow-sm">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h3 class="font-bold text-slate-900 dark:text-cream text-lg">{{ $client->name }}</h3>
                            <p class="text-xs text-slate-400">{{ $client->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-slate-600 dark:text-slate-300">
                            <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            {{ $client->email ?? 'No email' }}
                        </div>
                        <div class="flex items-center text-sm text-slate-600 dark:text-slate-300">
                            <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            {{ $client->phone ?? 'No phone' }}
                        </div>
                    </div>

                    <div class="flex gap-2">
                        @if($client->phone)
                            <a href="tel:{{ $client->phone }}"
                                class="flex-1 bg-slate-100 dark:bg-neutral-700 text-slate-600 dark:text-slate-300 py-2 rounded-lg text-center font-medium hover:bg-slate-200 dark:hover:bg-neutral-600 transition-colors">
                                <span class="flex items-center justify-center"><svg class="w-4 h-4 mr-1" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg> Llamar</span>
                            </a>
                        @endif
                        <a href="{{ route('clientes.show', $client->id) }}"
                            class="flex-[2] bg-brand-primary text-white py-2 rounded-lg text-center font-medium hover:bg-brand-light transition-colors">
                            Ver Perfil
                        </a>
                    </div>
                </div>
            @empty
                <div
                    class="text-center py-12 text-slate-500 bg-white dark:bg-neutral-800 rounded-xl border border-slate-100 dark:border-neutral-800">
                    No se encontraron clientes.
                </div>
            @endforelse
        </div>

        <div class="py-4">
            {{ $clients->links() }}
        </div>
    </div>
</div>