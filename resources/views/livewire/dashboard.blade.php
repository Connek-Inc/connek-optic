<div wire:poll.5s>
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div class="flex items-center space-x-3">
            <div class="bg-brand-primary text-white p-2 rounded-lg shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                    </path>
                </svg>
            </div>
            <div>
                <!-- Logos are handled globally in sidebar/header usually, but since this view has its own header section: -->
                <img x-show="!darkMode" src="{{ asset('Connek_Night.svg') }}" alt="Connek" class="h-10 w-auto">
                <img x-show="darkMode" src="{{ asset('Connek_Light.svg') }}" alt="Connek" class="h-10 w-auto"
                    style="display: none;">
            </div>
        </div>
        <!-- Button removed -->
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <!-- Clients Today -->
        <div
            class="bg-white dark:bg-neutral-900 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-neutral-800 flex items-center transition-transform hover:scale-105 duration-200">
            <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-xl text-blue-600 dark:text-blue-400 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-3xl font-bold text-slate-900 dark:text-cream">{{ $stats['clients_today'] }}</p>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Clients aujourd'hui</p>
            </div>
        </div>

        <!-- In Progress -->
        <div
            class="bg-white dark:bg-neutral-900 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-neutral-800 flex items-center transition-transform hover:scale-105 duration-200">
            <div class="p-3 bg-orange-50 dark:bg-orange-900/30 rounded-xl text-orange-500 dark:text-orange-400 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-3xl font-bold text-slate-900 dark:text-cream">{{ $stats['in_progress'] }}</p>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">En cours</p>
            </div>
        </div>

        <!-- Ready -->
        <div
            class="bg-white dark:bg-neutral-900 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-neutral-800 flex items-center transition-transform hover:scale-105 duration-200">
            <div class="p-3 bg-teal-50 dark:bg-teal-900/30 rounded-xl text-teal-600 dark:text-teal-400 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-3xl font-bold text-slate-900 dark:text-cream">{{ $stats['cart_ready'] }}</p>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Panier prêt</p>
            </div>
        </div>

        <!-- Completed -->
        <div
            class="bg-white dark:bg-neutral-900 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-neutral-800 flex items-center transition-transform hover:scale-105 duration-200">
            <div class="p-3 bg-green-50 dark:bg-green-900/30 rounded-xl text-green-600 dark:text-green-400 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-3xl font-bold text-slate-900 dark:text-cream">{{ $stats['completed'] }}</p>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Complétés</p>
            </div>
        </div>
    </div>

    <!-- Clients List -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold text-slate-800 dark:text-brand-light">Clients du jour</h2>
        <span class="text-sm text-slate-500 dark:text-slate-400 capitalize">{{ $date }}</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($todayClients as $client)
            <div
                class="bg-white dark:bg-neutral-900 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-neutral-800 min-h-[160px] flex flex-col hover:shadow-lg hover:border-brand-light transition-all duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center text-slate-500 dark:text-slate-400 text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $client['time'] }}
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $client['status_color'] }}">
                        {{ $client['status'] }}
                    </span>
                </div>

                @if($client['details'])
                    <div class="mt-2 space-y-2">
                        <div class="flex items-center text-slate-700 dark:text-cream font-medium">
                            <svg class="w-4 h-4 mr-2 text-brand-primary dark:text-brand-light" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                            {{ $client['details']['type'] }}
                        </div>
                        <div class="flex space-x-2">
                            <span
                                class="bg-brand-light/20 text-brand-primary dark:text-brand-light px-2 py-0.5 rounded text-xs">{{ $client['details']['index'] }}</span>
                            <span
                                class="bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 px-2 py-0.5 rounded text-xs">{{ $client['details']['tag'] }}</span>
                        </div>
                        <p class="text-xs text-slate-400 mt-2">{{ $client['details']['promo'] }}</p>
                    </div>
                @else
                    <div class="flex-1"></div>
                    <p class="text-sm text-slate-400 italic">No details yet</p>
                @endif
            </div>
        @endforeach
    </div>
</div>