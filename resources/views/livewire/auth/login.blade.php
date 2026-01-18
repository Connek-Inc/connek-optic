<div class="min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Animated Ambient Background -->
    <div class="absolute inset-0 z-0">
        <div
            class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-brand-primary/30 rounded-full blur-[100px] animate-pulse">
        </div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-brand-light/30 rounded-full blur-[100px] animate-pulse"
            style="animation-delay: 2s;"></div>
    </div>

    <!-- Login Card (Glassmorphism) -->
    <div
        class="relative z-10 w-full max-w-md p-8 bg-white/10 dark:bg-neutral-900/10 backdrop-blur-2xl border border-white/20 dark:border-neutral-800/20 rounded-3xl shadow-2xl">

        <!-- Logo -->
        <div class="flex flex-col items-center mb-10">
            <div
                class="w-16 h-16 bg-brand-primary rounded-2xl flex items-center justify-center text-white font-bold text-3xl shadow-lg mb-4 transform hover:rotate-12 transition-transform duration-500">
                C
            </div>
            <h2 class="text-3xl font-bold tracking-tight text-slate-800 dark:text-white">
                Bienvenido
            </h2>
            <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm">
                Inicia sesión en tu organización
            </p>
        </div>

        <!-- Form -->
        <form wire:submit.prevent="login" class="space-y-6">
            <!-- Email -->
            <div class="space-y-2">
                <label for="email" class="text-sm font-medium text-slate-700 dark:text-slate-300 ml-1">Email</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-brand-primary transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input wire:model="email" type="email" id="email" required autofocus
                        class="block w-full pl-10 pr-3 py-3 border border-slate-200/50 dark:border-neutral-700/50 rounded-xl leading-5 bg-white/50 dark:bg-neutral-800/50 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-primary/50 focus:border-brand-primary transition-all duration-300"
                        placeholder="nombre@empresa.com">
                </div>
                @error('email') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <label for="password"
                    class="text-sm font-medium text-slate-700 dark:text-slate-300 ml-1">Contraseña</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-brand-primary transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input wire:model="password" type="password" id="password" required
                        class="block w-full pl-10 pr-3 py-3 border border-slate-200/50 dark:border-neutral-700/50 rounded-xl leading-5 bg-white/50 dark:bg-neutral-800/50 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-primary/50 focus:border-brand-primary transition-all duration-300"
                        placeholder="••••••••">
                </div>
                @error('password') <span class="text-red-500 text-xs ml-1">{{ $message }}</span> @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input wire:model="remember" id="remember-me" type="checkbox"
                        class="h-4 w-4 text-brand-primary focus:ring-brand-primary border-gray-300 rounded bg-white/50 dark:bg-neutral-800/50">
                    <label for="remember-me" class="ml-2 block text-sm text-slate-600 dark:text-slate-400">
                        Recordarme
                    </label>
                </div>
                <div class="text-sm">
                    <a href="#" class="font-medium text-brand-primary hover:text-brand-light transition-colors">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-medium text-white bg-brand-primary hover:bg-brand-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary transform hover:scale-[1.02] transition-all duration-300 relative overflow-hidden group">
                <div
                    class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                </div>
                <span class="relative z-10">Iniciar Sesión</span>
            </button>
        </form>

        <!-- Footer -->
        <p class="mt-8 text-center text-xs text-slate-500 dark:text-slate-500">
            &copy; {{ date('Y') }} Connek System. Todos los derechos reservados.
        </p>
    </div>
</div>