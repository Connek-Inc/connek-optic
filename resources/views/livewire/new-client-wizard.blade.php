<div class="max-w-5xl mx-auto py-12 px-4">
    <!-- Stepper -->
    <div class="flex items-center justify-between mb-16 max-w-4xl mx-auto overflow-x-auto no-scrollbar">
        <button wire:click="previousStep"
            class="text-slate-500 hover:text-slate-700 flex items-center text-sm font-medium mr-4">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            {{ __('Atrás') }}
        </button>

        <div class="flex items-center space-x-2">
            @for ($i = 1; $i <= $totalSteps; $i++)
                <div class="flex items-center">
                    @if($i > 1)
                        <div class="w-8 h-0.5 {{ $i <= $currentStep ? 'bg-brand-primary' : 'bg-slate-200 dark:bg-slate-700' }}">
                        </div>
                    @endif

                    <div
                        class="relative flex items-center justify-center w-8 h-8 rounded-full font-bold text-xs transition-colors duration-300
                                                            {{ $i < $currentStep ? 'bg-green-500 text-white' : ($i == $currentStep ? 'bg-brand-primary text-white shadow-lg shadow-brand-light/50' : 'bg-slate-100 text-slate-400 dark:bg-slate-700 dark:text-slate-500') }}">
                        @if($i < $currentStep)
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @else
                            {{ $i }}
                        @endif
                    </div>
                </div>
            @endfor
        </div>

        <div class="w-10"></div>
    </div>

    <!-- Active Client Indicator (Visible after Step 1) -->
    @if ($currentStep > 1 && $name)
        <div class="max-w-4xl mx-auto -mt-10 mb-8 animate-fade-in">
            <div
                class="bg-brand-primary/5 dark:bg-brand-primary/10 border border-brand-primary/20 rounded-full px-6 py-2 inline-flex items-center">
                <div class="w-2 h-2 bg-green-500 rounded-full mr-3 animate-pulse"></div>
                <span class="text-xs font-bold uppercase tracking-wider text-brand-primary mr-2">{{ __('Cliente:') }}</span>
                <span class="font-bold text-slate-900 dark:text-cream">{{ $name }}</span>
            </div>
        </div>
    @endif

    <!-- Step 1: Client Information (REPLACED Splash Screen) -->
    @if ($currentStep === 1)
        <div class="max-w-4xl mx-auto animate-fade-in">
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center p-3 bg-brand-primary/10 rounded-2xl mb-4">
                    <svg class="w-8 h-8 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-slate-900 dark:text-cream mb-2">{{ __('Información del Nuevo Cliente') }}
                </h2>
                <p class="text-slate-500 dark:text-slate-400">{{ __('Por favor ingrese los detalles para comenzar.') }}</p>
            </div>

            <div
                class="bg-white/70 dark:bg-neutral-900/70 backdrop-blur-xl rounded-3xl shadow-2xl border border-slate-100/50 dark:border-neutral-800/50 p-8 md:p-12 relative overflow-hidden">
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-brand-primary/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                    <div class="space-y-6">
                        <div>
                            <label
                                class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">{{ __('Nombre Completo') }}
                                <span class="text-red-500">*</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-brand-primary transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <input wire:model.live="name" type="text"
                                    class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-200 dark:border-neutral-700 bg-slate-50/50 dark:bg-neutral-800/50 focus:ring-2 focus:ring-brand-primary dark:text-white transition-all outline-none"
                                    placeholder="Ex: Jean Dupont">
                            </div>
                            @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label
                                class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">{{ __('Teléfono') }}</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-brand-primary transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                </div>
                                <input wire:model="phone" type="tel"
                                    class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-200 dark:border-neutral-700 bg-slate-50/50 dark:bg-neutral-800/50 focus:ring-2 focus:ring-brand-primary dark:text-white transition-all outline-none"
                                    placeholder="+1 234 567 890">
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">{{ __('Correo Electrónico') }}</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-brand-primary transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                        </path>
                                    </svg>
                                </div>
                                <input wire:model="email" type="email"
                                    class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-200 dark:border-neutral-700 bg-slate-50/50 dark:bg-neutral-800/50 focus:ring-2 focus:ring-brand-primary dark:text-white transition-all outline-none"
                                    placeholder="jean@example.com">
                            </div>
                            @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div
                        class="flex flex-col justify-center items-centerspace-y-6 pt-6 md:pt-0 md:pl-8 md:border-l border-slate-100 dark:border-neutral-800">
                        <!-- Info / Upsell -->
                        <div class="bg-brand-primary/5 rounded-2xl p-6 text-center">
                            <h4 class="font-bold text-brand-primary mb-2">{{ __('Consejo Rápido') }}</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400">
                                {{ __('Recopilar datos precisos facilita la facturación y garantías.') }}
                            </p>
                        </div>

                        <div class="w-full mt-auto">
                            <button wire:click="nextStep"
                                class="w-full bg-brand-primary text-white py-4 rounded-xl font-bold shadow-lg shadow-brand-primary/30 hover:bg-brand-light transform hover:scale-[1.02] transition-all flex items-center justify-center group">
                                <span>{{ __('Siguiente Paso') }}</span>
                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-center pt-6 border-t border-slate-100 dark:border-neutral-800">
                    <a href="{{ route('clientes') }}"
                        class="inline-flex items-center text-sm text-slate-400 hover:text-brand-primary transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        {{ __('¿Ya es cliente? Buscar en Base de Datos') }}
                    </a>
                </div>
            </div>
        </div>
    @endif


    @if ($currentStep === 2)
        <div class="text-center max-w-5xl mx-auto animate-fade-in">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-cream mb-2">{{ __('¿Qué está buscando el cliente?') }}
            </h2>
            <p class="text-slate-500 dark:text-slate-400 mb-8">{{ __('Seleccione la categoría principal') }}</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <!-- Row 1: The Basics -->
                <button wire:click="selectClientType('simple_foyer')"
                    class="bg-white/70 dark:bg-neutral-900/70 backdrop-blur-md p-6 rounded-2xl border-2 border-slate-100/50 dark:border-neutral-800/50 hover:border-brand-primary hover:shadow-lg transition-all active:scale-95 text-center group">
                    <div class="mb-3 group-hover:scale-110 transition-transform text-brand-primary dark:text-brand-light">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-cream">{{ __('Visión Sencilla') }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('Distancia o Lectura') }}</p>
                </button>
                <button wire:click="selectClientType('progressif')"
                    class="bg-white dark:bg-neutral-900 p-6 rounded-2xl border-2 border-slate-100 dark:border-neutral-800 hover:border-brand-primary hover:shadow-lg transition-all active:scale-95 text-center group">
                    <div class="mb-3 group-hover:scale-110 transition-transform text-brand-primary dark:text-brand-light">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-cream">{{ __('Progresivos') }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('Todas las distancias') }}</p>
                </button>
                <button wire:click="selectClientType('bifocal')"
                    class="bg-white dark:bg-neutral-900 p-6 rounded-2xl border-2 border-slate-100 dark:border-neutral-800 hover:border-brand-primary hover:shadow-lg transition-all active:scale-95 text-center group">
                    <div class="mb-3 group-hover:scale-110 transition-transform text-brand-primary dark:text-brand-light">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-cream">{{ __('Bifocales') }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('Segmento visible') }}</p>
                </button>

                <!-- Row 2: Specialized -->
                <button wire:click="selectClientType('occupational')"
                    class="bg-white dark:bg-neutral-900 p-6 rounded-2xl border-2 border-slate-100 dark:border-neutral-800 hover:border-brand-primary hover:shadow-lg transition-all active:scale-95 text-center group">
                    <div class="mb-3 group-hover:scale-110 transition-transform text-brand-primary dark:text-brand-light">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-cream">{{ __('Ocupacional') }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('Oficina / PC') }}</p>
                </button>
                <button wire:click="selectClientType('antifatigue')"
                    class="bg-white dark:bg-neutral-900 p-6 rounded-2xl border-2 border-slate-100 dark:border-neutral-800 hover:border-brand-primary hover:shadow-lg transition-all active:scale-95 text-center group">
                    <div class="mb-3 group-hover:scale-110 transition-transform text-brand-primary dark:text-brand-light">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-cream">{{ __('Anti-Fatiga') }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('Descanso Visual') }}</p>
                </button>
                <button wire:click="selectClientType('kids')"
                    class="bg-white dark:bg-neutral-900 p-6 rounded-2xl border-2 border-slate-100 dark:border-neutral-800 hover:border-brand-primary hover:shadow-lg transition-all active:scale-95 text-center group">
                    <div class="mb-3 group-hover:scale-110 transition-transform text-brand-primary dark:text-brand-light">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-cream">{{ __('Niños') }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('Control de Miopía') }}</p>
                </button>

                <!-- Row 3: Other -->
                <button wire:click="selectClientType('sunglasses')"
                    class="bg-white dark:bg-neutral-900 p-6 rounded-2xl border-2 border-slate-100 dark:border-neutral-800 hover:border-brand-primary hover:shadow-lg transition-all active:scale-95 text-center group">
                    <div class="mb-3 group-hover:scale-110 transition-transform text-brand-primary dark:text-brand-light">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-cream">{{ __('Gafas de Sol') }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('Con/Sin prescripción') }}</p>
                </button>
                <button wire:click="selectClientType('contact_lens')"
                    class="bg-white dark:bg-neutral-900 p-6 rounded-2xl border-2 border-slate-100 dark:border-neutral-800 hover:border-brand-primary hover:shadow-lg transition-all active:scale-95 text-center group">
                    <div class="mb-3 group-hover:scale-110 transition-transform text-brand-primary dark:text-brand-light">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-cream">{{ __('Lentes de Contacto') }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('Adaptación o Venta') }}</p>
                </button>
                <button wire:click="selectClientType('frame_only')"
                    class="bg-white dark:bg-neutral-900 p-6 rounded-2xl border-2 border-slate-100 dark:border-neutral-800 hover:border-brand-primary hover:shadow-lg transition-all active:scale-95 text-center group">
                    <div class="mb-3 group-hover:scale-110 transition-transform text-brand-primary dark:text-brand-light">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-cream">{{ __('Servicio / Reparación') }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('Solo Montura') }}</p>
                </button>
            </div>
        </div>
    @endif

    <!-- Step 3: Promotion (Dynamic) -->
    @if ($currentStep === 3)
        <div class="text-center max-w-4xl mx-auto animate-fade-in">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-cream mb-4">{{ __('Promoción del día') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                @php
                    // Simple filter: if progressive, show all or prioritize progressive.
                    // For this demo, if type is 'progressif' or 'bifocal', show progressive opts + simple.
                    // Actually, let's just show them all but highlight relevant ones?
                    // Or filter strict? Let's filter strict for better UX.
                    $isProgressive = in_array($clientType, ['progressif', 'bifocal', 'occupational']);
                    $promos = $dbPromotions->filter(function ($p) use ($isProgressive) {
                        if ($isProgressive)
                            return $p->type === 'progressif' || $p->type === 'simple';
                        return $p->type === 'simple';
                    });
                @endphp

                @foreach($promos as $promo)
                    <button wire:click="selectPromotion({{ $promo->id }})"
                        class="bg-white/70 dark:bg-neutral-900/70 backdrop-blur-md p-8 rounded-2xl border-2 border-slate-100/50 dark:border-neutral-800/50 hover:border-brand-primary hover:shadow-lg transition-all text-center flex flex-col h-full active:scale-95">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-cream mb-2">{{ $promo->name }}</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mb-4 flex-grow">{{ $promo->description }}</p>

                        @if(isset($promo->features))
                            <ul class="text-xs text-left space-y-1 mb-4 text-slate-600 dark:text-slate-300">
                                @foreach($promo->features as $feat)
                                    <li class="flex items-center">
                                        <svg class="w-3 h-3 text-brand-primary mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                            </path>
                                        </svg>
                                        {{ $feat }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="mt-auto pt-4 border-t border-slate-100 dark:border-neutral-800 w-full">
                            <span class="text-xl font-bold text-brand-primary dark:text-brand-light">${{ $promo->price }}</span>
                        </div>
                    </button>
                @endforeach

                <button wire:click="selectPromotion(0)"
                    class="bg-white/70 dark:bg-neutral-900/70 backdrop-blur-md p-8 rounded-2xl border-2 border-slate-100/50 dark:border-neutral-800/50 hover:border-brand-primary hover:shadow-lg transition-all text-center flex flex-col items-center justify-center active:scale-95 relative overflow-hidden">
                    <!-- Glass shine effect -->
                    <div
                        class="absolute inset-0 bg-gradient-to-tr from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover:animate-shine">
                    </div>

                    <h3 class="text-lg font-bold text-slate-900 dark:text-cream">{{ __('Sin Promo') }}</h3>
                    <p class="text-slate-400 text-sm mt-2">{{ __('Precio Estándar') }}</p>
                </button>
            </div>
        </div>
    @endif

    <!-- Step 4: Prescription (Enhanced Manual Entry) -->
    @if ($currentStep === 4)
        <div class="text-center max-w-4xl mx-auto animate-fade-in">
            <h2 class="text-2xl font-bold text-slate-900 mb-4">Prescripción</h2>
            <p class="text-slate-500 mb-8">Analizar foto o ingresar manualmente</p>

            @if(!$prescriptionType)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <!-- Photo Upload -->
                    <div class="relative group">
                        <input type="file" wire:model="photo"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*">
                        <button
                            class="w-full bg-white/70 dark:bg-neutral-900/70 backdrop-blur-md p-8 rounded-2xl border-2 border-slate-100/50 dark:border-neutral-800/50 group-hover:border-brand-primary group-hover:shadow-lg transition-all text-center h-full flex flex-col justify-center items-center">
                            <div
                                class="mb-4 text-brand-primary dark:text-brand-light group-hover:scale-110 transition-transform">
                                <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-cream">{{ __('Subir Foto') }}</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                {{ __('Analizar foto o ingresar manualmente') }}
                            </p>

                            @if($photo)
                                <span
                                    class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded mt-2">{{ __('Analizando...') }}</span>
                            @endif
                        </button>
                    </div>

                    <!-- Manual Entry -->
                    <button wire:click="setPrescriptionType('manual')"
                        class="bg-white/70 dark:bg-neutral-900/70 backdrop-blur-md p-8 rounded-2xl border-2 border-slate-100/50 dark:border-neutral-800/50 hover:border-brand-primary hover:shadow-lg transition-all text-center h-full flex flex-col justify-center items-center">
                        <div class="mb-4 text-brand-primary dark:text-brand-light">
                            <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-cream">{{ __('Entrada Manual') }}</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">{{ __('Ingresar esfera, cilindro...') }}</p>
                    </button>

                    <!-- Reserve Without Exam -->
                    <button wire:click="reserveWithoutExam"
                        class="bg-white/70 dark:bg-neutral-900/70 backdrop-blur-md p-8 rounded-2xl border-2 border-slate-100/50 dark:border-neutral-800/50 hover:border-amber-500 hover:shadow-lg transition-all text-center h-full flex flex-col justify-center items-center group">
                        <div class="mb-4 text-slate-400 group-hover:text-amber-500 transition-colors">
                            <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3
                            class="text-lg font-bold text-slate-900 dark:text-cream group-hover:text-amber-500 transition-colors">
                            {{ __('Reservar / Saltar') }}
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">{{ __('Proveeré la prescripción luego') }}
                        </p>
                    </button>
                </div>
            @endif

            @if($prescriptionType === 'manual')
                <div
                    class="bg-white/70 dark:bg-neutral-900/70 backdrop-blur-md p-8 rounded-2xl border border-slate-200/50 dark:border-neutral-800/50 shadow-sm mt-4 text-left">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-cream mb-6">Detalles de Prescripción</h3>

                    <!-- Grid for Prescription -->
                    <div class="grid grid-cols-6 gap-4 mb-4 text-sm font-medium text-slate-500 dark:text-slate-400 text-center">
                        <div class="col-span-1"></div>
                        <div>Esfera (SPH)</div>
                        <div>Cilindro (CYL)</div>
                        <div>Eje (AXIS)</div>
                        <div>Adición (ADD)</div>
                        <div>DP</div>
                    </div>

                    <!-- Ojo Derecho (OD) -->
                    <div class="grid grid-cols-6 gap-4 mb-4 items-center">
                        <div class="font-bold text-slate-800 dark:text-slate-200">OD (Derecho)</div>
                        <input wire:model="manual_sph_od" type="number" step="0.25" placeholder="0.00"
                            class="border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded px-3 py-2 w-full text-center">
                        <input wire:model="manual_cyl_od" type="number" step="0.25" placeholder="0.00"
                            class="border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded px-3 py-2 w-full text-center">
                        <input wire:model="manual_axis_od" type="number" placeholder="0"
                            class="border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded px-3 py-2 w-full text-center">
                        <input wire:model="manual_add_od" type="number" step="0.25" placeholder="+0.00"
                            class="border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded px-3 py-2 w-full text-center">
                        <div class="row-span-2 flex items-center">
                            <input wire:model="manual_pd" type="number" placeholder="63"
                                class="border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded px-3 py-2 w-full text-center h-full">
                        </div>
                    </div>

                    <!-- Ojo Izquierdo (OG) -->
                    <div class="grid grid-cols-6 gap-4 mb-8 items-center">
                        <div class="font-bold text-slate-800 dark:text-slate-200">OI (Izquierdo)</div>
                        <input wire:model="manual_sph_og" type="number" step="0.25" placeholder="0.00"
                            class="border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded px-3 py-2 w-full text-center">
                        <input wire:model="manual_cyl_og" type="number" step="0.25" placeholder="0.00"
                            class="border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded px-3 py-2 w-full text-center">
                        <input wire:model="manual_axis_og" type="number" placeholder="0"
                            class="border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded px-3 py-2 w-full text-center">
                        <input wire:model="manual_add_og" type="number" step="0.25" placeholder="+0.00"
                            class="border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded px-3 py-2 w-full text-center">
                    </div>

                    <div class="flex justify-between">
                        <button wire:click="$set('prescriptionType', null)"
                            class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200">Cancelar</button>
                        <button wire:click="processManualPrescription"
                            class="bg-brand-primary text-white px-8 py-3 rounded-lg shadow hover:bg-brand-light font-medium transition-colors">
                            @if($analyzing) {{ __('Analizando...') }} @else {{ __('Analizar y Continuar') }} @endif
                        </button>
                    </div>
                </div>
            @endif

            @if($prescriptionData['sph_od'] && !$prescriptionType)
                <div class="mt-8 bg-green-50 p-4 rounded text-green-800 font-medium">¡Prescripción Analizada!</div>
                <div class="mt-8 text-right"><button wire:click="nextStep"
                        class="bg-teal-600 text-white px-6 py-2 rounded shadow hover:bg-teal-700">Continuar</button></div>
            @endif
        </div>
    @endif

    <!-- Step 5: Options (Dynamic Material & Frame) -->
    @if ($currentStep === 5)
        <div class="text-center max-w-4xl mx-auto animate-fade-in">
            <h2 class="text-2xl font-bold text-slate-900 mb-2">Opciones de Venta</h2>
            <p class="text-slate-500 mb-8">Material y tipo de montura</p>

            <h3 class="text-left text-lg font-semibold text-slate-800 mb-4">Material del Lente</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                @foreach($dbLensMaterials as $mat)
                    <button wire:click="selectMaterial({{ $mat->id }})"
                        class="p-6 rounded-xl border-2 transition-all backdrop-blur-sm {{ $lensMaterialId === $mat->id ? 'border-brand-primary bg-brand-light/30' : 'border-slate-100/50 dark:border-neutral-800/50 bg-white/70 dark:bg-neutral-900/70 hover:border-brand-light' }}">
                        <h4 class="font-bold text-slate-900 dark:text-cream">{{ $mat->name }}</h4>
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $mat->description }}</p>
                    </button>
                @endforeach
            </div>

            <h3 class="text-left text-lg font-semibold text-slate-800 mb-4">Tipo de Montura</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($dbFrameTypes as $frame)
                    <button wire:click="selectFrameType({{ $frame->id }})"
                        class="p-6 rounded-xl border-2 transition-all backdrop-blur-sm {{ $frameTypeId === $frame->id ? 'border-brand-primary bg-brand-light/20' : 'border-slate-100/50 dark:border-neutral-800/50 bg-white/70 dark:bg-neutral-900/70 hover:border-brand-light' }}">
                        <h4 class="font-bold text-slate-900 dark:text-cream">{{ $frame->name }}</h4>
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $frame->description }}</p>
                    </button>
                @endforeach
            </div>

            @if($lensMaterialId && $frameTypeId)
                <div class="mt-8 text-right"><button wire:click="nextStep"
                        class="bg-teal-600 text-white px-6 py-2 rounded shadow-md hover:bg-teal-700">Continuar →</button></div>
            @endif
        </div>
    @endif

    <!-- Step 6 (Using Automatic Analysis) -->
    @if ($currentStep === 6)
        <div class="text-center max-w-xl mx-auto animate-fade-in py-10">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-cream mb-2">Análisis Automático</h2>
            <p class="text-slate-500 dark:text-slate-400 mb-12">Basado en sus datos de prescripción</p>
            <div
                class="bg-white/70 dark:bg-neutral-900/70 backdrop-blur-md p-10 rounded-2xl shadow-sm border border-slate-100/50 dark:border-neutral-800/50">
                <div
                    class="w-16 h-16 bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 rounded-full flex items-center justify-center mx-auto mb-6">
                    i</div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-cream mb-2">Espesor Calculado:
                    {{ $thicknessAnalysis }}
                </h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm">Se recomienda un índice optimizado para reducir el
                    peso.</p>
            </div>
            <div class="mt-12 text-right">
                <button wire:click="nextStep"
                    class="bg-brand-primary text-white px-8 py-3 rounded-lg font-medium shadow-md hover:bg-brand-light transition-colors">Ver
                    Recomendación →</button>
            </div>
        </div>
    @endif

    @if ($currentStep === 7)
        <div class="text-center max-w-xl mx-auto animate-fade-in py-10">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-cream mb-2">Recomendación</h2>
            <p class="text-slate-500 dark:text-slate-400 mb-8">Índice Sugerido</p>
            <div
                class="bg-white/70 dark:bg-neutral-900/70 backdrop-blur-md p-12 rounded-2xl shadow-sm border border-slate-100/50 dark:border-neutral-800/50">
                <div class="flex items-center justify-center space-x-4 mb-6">
                    <div
                        class="text-4xl font-bold text-brand-primary dark:text-brand-light bg-brand-light/20 w-24 h-24 rounded-full flex items-center justify-center">
                        {{ $recommendedIndex }}
                    </div>
                </div>
            </div>
            <div class="mt-12 text-right">
                <button wire:click="nextStep"
                    class="bg-brand-primary text-white px-8 py-3 rounded-lg font-medium shadow-md hover:bg-brand-light hover:text-white transition-colors">Configurar
                    Lentes →</button>
            </div>
        </div>
    @endif

    <!-- Step 8: Configuration (Dynamic Options) -->
    @if ($currentStep === 8)
        <div class="max-w-5xl mx-auto animate-fade-in">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-slate-900 mb-2">Configuración de Lentes</h2>
                <p class="text-slate-500">Personalice ambos lentes de la promoción</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Verre A -->
                <div
                    class="border-2 border-brand-primary rounded-2xl p-6 bg-brand-light/10 dark:bg-brand-primary/10 backdrop-blur-sm">
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="font-bold text-lg text-slate-800 dark:text-cream">Lente A</h3>
                        <span class="bg-brand-primary text-white px-3 py-1 rounded-full text-xs font-medium">Incluido</span>
                    </div>

                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">Índice</p>
                    <div class="flex space-x-2 mb-8 overflow-x-auto pb-2">
                        @foreach($dbLensIndexes as $idx)
                            <button wire:click="selectIndex('{{ $idx->name }}')"
                                class="flex-shrink-0 w-20 h-24 rounded-lg border-2 flex flex-col items-center justify-center transition-all backdrop-blur-sm
                                                                                                        {{ $lensA_index === $idx->name ? 'border-brand-primary bg-white/80 dark:bg-neutral-800/80 ring-2 ring-brand-light' : 'border-slate-200 dark:border-neutral-800 bg-white/50 dark:bg-neutral-900/50 opacity-60' }}">
                                <span class="font-bold text-lg text-slate-800 dark:text-cream">{{ $idx->name }}</span>
                                @if($idx->price > 0) <span
                                    class="text-[10px] text-brand-primary dark:text-brand-light">+${{ $idx->price }}</span>
                                @else <span class="text-[10px] text-slate-500 dark:text-slate-400">Inclus</span> @endif
                            </button>
                        @endforeach
                    </div>

                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">Opciones</p>
                    <div class="space-y-4">
                        @foreach($dbLensOptions as $option)
                            <div
                                class="flex items-center justify-between bg-white/70 dark:bg-neutral-900/70 backdrop-blur-sm p-3 rounded-lg border border-slate-100/50 dark:border-neutral-800/50">
                                <div class="flex items-center">
                                    <span class="text-brand-primary dark:text-brand-light mr-3"><svg class="w-5 h-5" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg></span>
                                    <div>
                                        <p class="font-medium text-slate-800 dark:text-cream">{{ $option->name }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span
                                        class="text-sm font-medium text-brand-primary dark:text-brand-light">+{{ $option->price }}
                                        $</span>
                                    <button wire:click="toggleOption('A', {{ $option->id }})"
                                        class="w-10 h-5 rounded-full relative transition-colors {{ $this->isOptionSelected('A', $option->id) ? 'bg-brand-primary' : 'bg-slate-200 dark:bg-neutral-700' }}">
                                        <div
                                            class="w-3 h-3 bg-white rounded-full absolute top-1 transition-transform {{ $this->isOptionSelected('A', $option->id) ? 'left-6' : 'left-1' }}">
                                        </div>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Verre B (Clone logic) -->
                <div
                    class="border border-slate-200/50 dark:border-neutral-800/50 rounded-2xl p-6 bg-white/50 dark:bg-neutral-900/30 backdrop-blur-sm">
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="font-bold text-lg text-slate-800 dark:text-cream">Lente B</h3>
                        <span
                            class="bg-slate-100 dark:bg-neutral-700 text-slate-500 dark:text-slate-300 px-3 py-1 rounded-full text-xs font-medium">Estándar</span>
                    </div>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">Opciones</p>
                    <div class="space-y-4 opacity-75">
                        @foreach($dbLensOptions as $option)
                            <div
                                class="flex items-center justify-between bg-slate-50 dark:bg-neutral-800 p-3 rounded-lg border border-slate-100 dark:border-neutral-700">
                                <div class="flex items-center">
                                    <span class="text-brand-primary dark:text-brand-light mr-3"><svg class="w-5 h-5" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg></span>
                                    <div>
                                        <p class="font-medium text-slate-800 dark:text-cream">{{ $option->name }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span
                                        class="text-sm font-medium text-brand-primary dark:text-brand-light">+{{ $option->price }}
                                        $</span>
                                    <button wire:click="toggleOption('B', {{ $option->id }})"
                                        class="w-10 h-5 rounded-full relative transition-colors {{ $this->isOptionSelected('B', $option->id) ? 'bg-brand-primary' : 'bg-slate-200 dark:bg-neutral-700' }}">
                                        <div
                                            class="w-3 h-3 bg-white rounded-full absolute top-1 transition-transform {{ $this->isOptionSelected('B', $option->id) ? 'left-6' : 'left-1' }}">
                                        </div>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center mt-12">
                <button
                    class="bg-brand-primary text-white px-8 py-3 rounded-lg font-medium shadow hover:bg-brand-light transition-colors">Mantener
                    Base</button>
                <button wire:click="nextStep"
                    class="bg-brand-primary text-white px-8 py-3 rounded-lg font-medium shadow hover:bg-brand-light transition-colors">Ver
                    Carrito
                    →</button>
            </div>
        </div>
    @endif

    @if ($currentStep === 9)
        <div class="text-center max-w-4xl mx-auto animate-fade-in pb-20">
            <h2 class="text-3xl font-bold text-slate-900 dark:text-cream mb-2">Resumen del Expediente</h2>
            <p class="text-slate-500 dark:text-slate-400 mb-8">{{ __('Verificar y confirmar') }}</p>

            <div
                class="bg-white/70 dark:bg-neutral-900/70 backdrop-blur-xl rounded-3xl shadow-2xl border border-slate-100/50 dark:border-neutral-800/50 overflow-hidden text-left">

                <!-- 0. Client Details (Readonly Verification) -->
                <div
                    class="p-8 border-b border-slate-100 dark:border-neutral-800 bg-brand-primary/5 dark:bg-brand-primary/10">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-4">
                        {{ __('Información del Cliente') }}
                    </h3>
                    <div class="flex flex-col md:flex-row gap-8">
                        <div>
                            <span class="block text-xs text-slate-400 uppercase">{{ __('Nombre') }}</span>
                            <span class="text-lg font-bold text-slate-900 dark:text-cream">{{ $name }}</span>
                        </div>
                        <div>
                            <span class="block text-xs text-slate-400 uppercase">{{ __('Correo') }}</span>
                            <span class="text-lg font-bold text-slate-900 dark:text-cream">{{ $email ?: '-' }}</span>
                        </div>
                        <div>
                            <span class="block text-xs text-slate-400 uppercase">{{ __('Teléfono') }}</span>
                            <span class="text-lg font-bold text-slate-900 dark:text-cream">{{ $phone ?: '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- 1. Client & Prescription -->
                <div class="p-8 border-b border-slate-100 dark:border-neutral-800">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-400 mb-4">{{ __('Prescripción') }}</h3>

                    @if($prescriptionType === 'pending')
                        <div
                            class="bg-amber-50 dark:bg-amber-900/20 p-6 rounded-xl border border-amber-100 dark:border-amber-800/30 flex items-center justify-center text-center">
                            <div>
                                <svg class="w-12 h-12 text-amber-500 mx-auto mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <h4 class="font-bold text-lg text-amber-800 dark:text-amber-400">{{ __('Examen Pendiente') }}
                                </h4>
                                <p class="text-sm text-amber-600 dark:text-amber-500">
                                    {{ __('El cliente proveerá la prescripción luego.') }}
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- OD -->
                            <div class="bg-slate-50 dark:bg-neutral-800/50 rounded-xl p-4">
                                <div class="font-bold text-blue-600 dark:text-blue-400 mb-2">OD (Droit)</div>
                                <div class="grid grid-cols-4 gap-2 text-center text-sm">
                                    <div>
                                        <div class="text-xs text-slate-400">SPH</div>
                                        <div class="font-bold text-slate-800 dark:text-white">
                                            {{ $prescriptionData['sph_od'] ?? '-' }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-slate-400">CYL</div>
                                        <div class="font-bold text-slate-800 dark:text-white">
                                            {{ $prescriptionData['cyl_od'] ?? '-' }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-slate-400">AXE</div>
                                        <div class="font-bold text-slate-800 dark:text-white">
                                            {{ $prescriptionData['axis_od'] ?? '-' }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-slate-400">ADD</div>
                                        <div class="font-bold text-slate-800 dark:text-white">
                                            {{ $prescriptionData['add_od'] ?? '-' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- OG -->
                            <div class="bg-slate-50 dark:bg-neutral-800/50 rounded-xl p-4">
                                <div class="font-bold text-green-600 dark:text-green-400 mb-2">OG (Gauche)</div>
                                <div class="grid grid-cols-4 gap-2 text-center text-sm">
                                    <div>
                                        <div class="text-xs text-slate-400">SPH</div>
                                        <div class="font-bold text-slate-800 dark:text-white">
                                            {{ $prescriptionData['sph_og'] ?? '-' }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-slate-400">CYL</div>
                                        <div class="font-bold text-slate-800 dark:text-white">
                                            {{ $prescriptionData['cyl_og'] ?? '-' }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-slate-400">AXE</div>
                                        <div class="font-bold text-slate-800 dark:text-white">
                                            {{ $prescriptionData['axis_og'] ?? '-' }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-slate-400">ADD</div>
                                        <div class="font-bold text-slate-800 dark:text-white">
                                            {{ $prescriptionData['add_og'] ?? '-' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- 2. Product Details -->
                <div class="p-8 border-b border-slate-100 dark:border-neutral-800">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-400 mb-4">{{ __('Resumen de Venta') }}
                    </h3>
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Promotion -->
                        <div class="flex-1 flex items-start space-x-4">
                            <div
                                class="w-12 h-12 bg-brand-light/20 text-brand-primary rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-bold text-lg text-slate-900 dark:text-cream">
                                    {{ $selectedPromotion ? $selectedPromotion->name : 'Sin Promo' }}
                                </div>
                                <div class="text-slate-500 text-sm">
                                    {{ $selectedPromotion ? $selectedPromotion->description : '' }}
                                </div>
                            </div>
                        </div>

                        <!-- Specs -->
                        <div
                            class="flex-1 space-y-2 text-sm text-slate-600 dark:text-slate-300 bg-slate-50 dark:bg-neutral-800/50 p-4 rounded-xl">
                            <div class="flex justify-between">
                                <span>{{ __('Type') }}</span>
                                <span class="font-bold text-slate-900 dark:text-white capitalize">{{ $clientType }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>{{ __('Lens Material') }}</span>
                                <span
                                    class="font-bold text-slate-900 dark:text-white">{{ $dbLensMaterials->find($lensMaterialId)->name ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>{{ __('Frame Type') }}</span>
                                <span
                                    class="font-bold text-slate-900 dark:text-white">{{ $dbFrameTypes->find($frameTypeId)->name ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>{{ __('Index') }}</span>
                                <span class="font-bold text-slate-900 dark:text-white">{{ $lensA_index }}</span>
                            </div>

                            @if(count($lensA_options) > 0)
                                <div class="pt-2 mt-2 border-t border-slate-200 dark:border-neutral-700">
                                    <span
                                        class="block text-xs uppercase tracking-wider text-slate-400 mb-1">{{ __('Treatments') }}</span>
                                    <ul class="space-y-1">
                                        @foreach($lensA_options as $optId)
                                            <li class="flex justify-between">
                                                <span>{{ $dbLensOptions->firstWhere('id', $optId)->name ?? '' }}</span>
                                                <span
                                                    class="font-bold text-slate-900 dark:text-white">+{{ $dbLensOptions->firstWhere('id', $optId)->price ?? 0 }}$</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- 2b. Warranties (Dynamic Extras) -->
                <div class="p-8 border-b border-slate-100 dark:border-neutral-800">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-400 mb-4">Garantías y Extras</h3>
                    <div class="space-y-3">
                        @foreach($this->warranties as $warranty)
                            <div wire:click="toggleWarranty('{{ $warranty['id'] }}')"
                                class="flex items-center justify-between p-4 rounded-xl border cursor-pointer transition-all {{ in_array($warranty['id'], $selectedWarranties) ? 'border-brand-primary bg-brand-primary/5' : 'border-slate-200 dark:border-neutral-700 hover:border-brand-primary/50' }}">
                                <div class="flex items-center">
                                    <div
                                        class="w-5 h-5 rounded border flex items-center justify-center mr-3 {{ in_array($warranty['id'], $selectedWarranties) ? 'bg-brand-primary border-brand-primary' : 'border-slate-300' }}">
                                        @if(in_array($warranty['id'], $selectedWarranties))
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="font-medium text-slate-800 dark:text-cream">{{ $warranty['name'] }}</span>
                                    </div>
                                </div>
                                <span class="font-bold text-slate-900 dark:text-cream">+${{ $warranty['price'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 3. Totals -->
                <div class="p-8 bg-slate-50 dark:bg-neutral-800/80">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-slate-500 uppercase tracking-widest text-xs font-bold">{{ __('Total') }}</span>
                        <span
                            class="text-4xl font-extrabold text-brand-primary dark:text-brand-light">{{ number_format($this->calculateTotal(), 2) }}
                            $</span>
                    </div>

                    <div class="flex gap-4">
                        <button wire:click="previousStep"
                            class="flex-1 border border-slate-300 dark:border-slate-600 text-slate-600 dark:text-slate-300 py-4 rounded-xl font-bold hover:bg-white dark:hover:bg-neutral-700 transition-colors">
                            {{ __('Modify') }}
                        </button>
                        <button wire:click="saveSale"
                            class="flex-[2] bg-brand-primary text-white py-4 rounded-xl font-bold hover:bg-brand-light shadow-lg shadow-brand-primary/30 transform hover:scale-[1.02] transition-all">
                            {{ __('Confirm Sale') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>