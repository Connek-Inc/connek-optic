<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" x-data="{ 
          darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
      }" x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))"
    :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Connek') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body
    class="h-full font-sans antialiased text-slate-900 dark:text-cream bg-cream dark:bg-neutral-950 transition-colors duration-300">
    <div x-data="{ sidebarOpen: false, atTop: true }" @scroll.window="atTop = (window.pageYOffset > 10) ? false : true"
        class="min-h-screen flex flex-col lg:flex-row relative">

        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" style="display: none;" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-neutral-900/80 z-40 lg:hidden">
        </div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 lg:w-20 lg:hover:w-72 lg:translate-x-0 
                      bg-white/80 dark:bg-neutral-900/80 backdrop-blur-xl border-r border-slate-200/50 dark:border-neutral-800/50 
                      flex flex-col transition-all duration-300 ease-in-out group hover:shadow-2xl">

            <!-- Logo Section -->
            <div class="h-20 flex items-center justify-center relative overflow-hidden flex-shrink-0">
                <!-- Expanded/Mobile Logo -->
                <div
                    class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 lg:opacity-0 lg:group-hover:opacity-100">
                    <img x-show="!darkMode" src="{{ asset('Connek_Night.svg') }}" alt="Connek" class="h-10 w-auto">
                    <img x-show="darkMode" src="{{ asset('Connek_Light.svg') }}" alt="Connek" class="h-10 w-auto"
                        style="display: none;">
                </div>
                <!-- Collapsed Icon -->
                <div
                    class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 opacity-0 lg:opacity-100 lg:group-hover:opacity-0">
                    <div
                        class="w-10 h-10 bg-brand-primary rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        C</div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-3 py-6 space-y-2 overflow-y-auto no-scrollbar">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-3 py-3 rounded-xl transition-all relative overflow-hidden group/item {{ request()->routeIs('dashboard') ? 'bg-cream text-brand-primary dark:bg-slate-700 dark:text-brand-light' : 'text-slate-600 dark:text-slate-300 hover:bg-cream/50 dark:hover:bg-slate-700/50' }}">
                    <div class="flex-shrink-0 w-6 flex justify-center"><svg class="w-6 h-6" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg></div>
                    <span
                        class="ml-3 whitespace-nowrap transition-all duration-300 opacity-100 lg:opacity-0 lg:group-hover:opacity-100">{{ __('Dashboard') }}</span>
                </a>

                <!-- Inventory -->
                <a href="{{ route('inventario') }}"
                    class="flex items-center px-3 py-3 rounded-xl transition-all relative overflow-hidden group/item {{ request()->routeIs('inventario') ? 'bg-cream text-brand-primary dark:bg-slate-700 dark:text-brand-light' : 'text-slate-600 dark:text-slate-300 hover:bg-cream/50 dark:hover:bg-slate-700/50' }}">
                    <div class="flex-shrink-0 w-6 flex justify-center"><svg class="w-6 h-6" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg></div>
                    <span
                        class="ml-3 whitespace-nowrap transition-all duration-300 opacity-100 lg:opacity-0 lg:group-hover:opacity-100">{{ __('Inventario') }}</span>
                </a>

                <!-- Materials -->
                <a href="{{ route('materiales') }}"
                    class="flex items-center px-3 py-3 rounded-xl transition-all relative overflow-hidden group/item {{ request()->routeIs('materiales') ? 'bg-cream text-brand-primary dark:bg-slate-700 dark:text-brand-light' : 'text-slate-600 dark:text-slate-300 hover:bg-cream/50 dark:hover:bg-slate-700/50' }}">
                    <div class="flex-shrink-0 w-6 flex justify-center"><svg class="w-6 h-6" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                            </path>
                        </svg></div>
                    <span
                        class="ml-3 whitespace-nowrap transition-all duration-300 opacity-100 lg:opacity-0 lg:group-hover:opacity-100">{{ __('Materiales') }}</span>
                </a>

                <!-- Promos -->
                <a href="{{ route('promociones') }}"
                    class="flex items-center px-3 py-3 rounded-xl transition-all relative overflow-hidden group/item {{ request()->routeIs('promociones') ? 'bg-cream text-brand-primary dark:bg-slate-700 dark:text-brand-light' : 'text-slate-600 dark:text-slate-300 hover:bg-cream/50 dark:hover:bg-slate-700/50' }}">
                    <div class="flex-shrink-0 w-6 flex justify-center"><svg class="w-6 h-6" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
                            </path>
                        </svg></div>
                    <span
                        class="ml-3 whitespace-nowrap transition-all duration-300 opacity-100 lg:opacity-0 lg:group-hover:opacity-100">{{ __('Promociones') }}</span>
                </a>

                <!-- Clients -->
                <a href="{{ route('nouveau.client') }}"
                    class="flex items-center px-3 py-3 rounded-xl transition-all relative overflow-hidden group/item {{ request()->routeIs('nouveau.client') || request()->routeIs('clientes') || request()->routeIs('clientes.show') ? 'bg-cream text-brand-primary dark:bg-slate-700 dark:text-brand-light' : 'text-slate-600 dark:text-slate-300 hover:bg-cream/50 dark:hover:bg-slate-700/50' }}">
                    <div class="flex-shrink-0 w-6 flex justify-center"><svg class="w-6 h-6" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg></div>
                    <span
                        class="ml-3 whitespace-nowrap transition-all duration-300 opacity-100 lg:opacity-0 lg:group-hover:opacity-100">{{ __('Clientes') }}</span>
                </a>

                <!-- New Wizard -->
                <a href="{{ route('nouveau.client') }}"
                    class="flex items-center px-3 py-3 rounded-xl transition-all relative overflow-hidden group/item {{ request()->routeIs('nouveau.client') ? 'bg-cream text-brand-primary dark:bg-slate-700 dark:text-brand-light' : 'text-slate-600 dark:text-slate-300 hover:bg-cream/50 dark:hover:bg-slate-700/50' }}">
                    <div class="flex-shrink-0 w-6 flex justify-center"><svg class="w-6 h-6" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg></div>
                    <span
                        class="ml-3 whitespace-nowrap transition-all duration-300 opacity-100 lg:opacity-0 lg:group-hover:opacity-100">{{ __('New Wizard') }}</span>
                </a>
            </nav>

            <!-- Footer Actions & Profile -->
            <div
                class="border-t border-slate-200/50 dark:border-neutral-800/50 p-3 flex flex-col gap-3 relative z-20 bg-white/50 dark:bg-neutral-900/50 backdrop-blur-md">

                <!-- Action Buttons (Hidden when collapsed, slide up/fade in on expand) -->
                <div
                    class="lg:h-0 lg:opacity-0 lg:group-hover:h-auto lg:group-hover:opacity-100 overflow-hidden transition-all duration-500 ease-in-out flex flex-col gap-2">

                    <!-- Language Selection -->
                    <div
                        class="flex items-center justify-around bg-slate-100/50 dark:bg-neutral-800/50 rounded-xl p-2 border border-slate-200/50 dark:border-neutral-700/50">
                        <a href="{{ route('lang.switch', 'fr') }}"
                            class="hover:scale-110 transition-transform text-lg grayscale hover:grayscale-0 opacity-70 hover:opacity-100"
                            title="Français">🇫🇷</a>
                        <div class="w-px h-4 bg-slate-200 dark:bg-neutral-700"></div>
                        <a href="{{ route('lang.switch', 'en') }}"
                            class="hover:scale-110 transition-transform text-lg grayscale hover:grayscale-0 opacity-70 hover:opacity-100"
                            title="English">🇺🇸</a>
                        <div class="w-px h-4 bg-slate-200 dark:bg-neutral-700"></div>
                        <a href="{{ route('lang.switch', 'es') }}"
                            class="hover:scale-110 transition-transform text-lg grayscale hover:grayscale-0 opacity-70 hover:opacity-100"
                            title="Español">🇪🇸</a>
                    </div>

                    <!-- Tools (Theme & Logout) -->
                    <div class="flex items-center gap-2">
                        <button @click="darkMode = !darkMode"
                            class="flex-1 flex items-center justify-center p-2 rounded-xl bg-slate-100/50 dark:bg-neutral-800/50 text-slate-600 dark:text-slate-400 hover:bg-brand-primary hover:text-white transition-all group/theme border border-slate-200/50 dark:border-neutral-700/50">
                            x-text="darkMode ? '{{ __('Light') }}' : '{{ __('Dark') }}'">{{ __('Theme') }}</span>
                            <svg x-show="!darkMode" class="w-4 h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                                </path>
                            </svg>
                            <svg x-show="darkMode" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </button>

                        <a href="{{ route('logout') }}"
                            class="flex-1 flex items-center justify-center p-2 rounded-xl bg-red-50 dark:bg-red-900/10 text-red-500 hover:bg-red-500 hover:text-white transition-all border border-red-100 dark:border-red-900/20">
                            <span
                                class="text-xs font-medium mr-2 hidden lg:block lg:group-hover:block">{{ __('Logout') }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- User Info Profile (Always Visible) -->
                <div class="flex items-center gap-3 group/profile cursor-pointer">
                    <!-- Avatar -->
                    <div class="relative flex-shrink-0">
                        <div
                            class="h-10 w-10 rounded-xl bg-gradient-to-br from-brand-primary to-blue-600 flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-brand-primary/20 ring-2 ring-white dark:ring-neutral-800 transition-transform group-hover/profile:scale-105">
                            {{ substr(auth()->user()->name ?? 'G', 0, 1) }}
                        </div>
                        <div
                            class="absolute -bottom-1 -right-1 h-3.5 w-3.5 bg-green-500 rounded-full border-2 border-white dark:border-neutral-900">
                        </div>
                    </div>

                    <!-- Text Info -->
                    <div
                        class="flex-1 overflow-hidden transition-all duration-300 opacity-100 lg:opacity-0 lg:group-hover:opacity-100 w-full lg:w-0 lg:group-hover:w-auto">
                        <p class="text-sm font-bold text-slate-800 dark:text-white truncate">
                            {{ auth()->user()->name ?? 'Guest' }}
                        </p>
                        <div class="flex items-center gap-1">
                            <div class="h-1.5 w-1.5 rounded-full bg-brand-primary"></div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 truncate">Online</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 transition-all duration-300 lg:pl-20">
            <!-- Mobile Header -->
            <header
                class="lg:hidden h-16 flex items-center px-4 border-b border-slate-200/50 dark:border-neutral-800/50 bg-white/70 dark:bg-neutral-900/70 backdrop-blur-xl sticky top-0 z-30">
                <button @click="sidebarOpen = true"
                    class="p-2 -ml-2 rounded-lg hover:bg-slate-100 dark:hover:bg-neutral-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div class="mx-auto">
                    <img x-show="!darkMode" src="{{ asset('Connek_Night.svg') }}" alt="Connek" class="h-8 w-auto">
                    <img x-show="darkMode" src="{{ asset('Connek_Light.svg') }}" alt="Connek" class="h-8 w-auto"
                        style="display: none;">
                </div>
                <div class="w-10"></div> <!-- Spacer for centering -->
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-4 lg:p-8 overflow-x-hidden">
                {{ $slot }}
            </main>
        </div>

    </div>
    @livewireScripts
</body>

</html>