<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in text-slate-900 dark:text-cream">

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h1
                class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-brand-primary to-blue-500 dark:from-blue-400 dark:to-blue-200">
                {{ __('Categories') }}
            </h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">{{ __('Manage your product categories') }}</p>
        </div>

        <div class="flex items-center gap-4 w-full md:w-auto">
            <!-- Search -->
            <div class="relative flex-1 md:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="{{ __('Search') }}..."
                    class="pl-10 pr-4 py-2 w-full rounded-xl border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 focus:ring-2 focus:ring-brand-primary outline-none transition-shadow">
            </div>

            <button wire:click="create"
                class="bg-brand-primary hover:bg-brand-secondary text-white px-4 py-2 rounded-xl flex items-center gap-2 shadow-lg shadow-brand-primary/20 transition-all hover:scale-105 active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="hidden sm:inline">{{ __('New Category') }}</span>
            </button>
        </div>
    </div>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 relative animate-fade-in"
            role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Grid Layout -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($categories as $category)
            <div
                class="bg-white/70 dark:bg-neutral-900/70 backdrop-blur-xl border border-slate-200/50 dark:border-neutral-800/50 rounded-2xl p-6 hover:shadow-xl hover:border-brand-primary/30 transition-all duration-300 group flex flex-col items-center text-center relative overflow-hidden">

                <!-- Decorative Background Blob -->
                <div
                    class="absolute top-0 right-0 -mr-8 -mt-8 w-24 h-24 bg-brand-primary/5 rounded-full blur-2xl group-hover:bg-brand-primary/10 transition-colors">
                </div>

                <!-- Icon / Initial -->
                <div
                    class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-neutral-800 dark:to-neutral-800 flex items-center justify-center mb-4 shadow-inner group-hover:scale-110 transition-transform duration-300">
                    <span class="text-3xl font-bold text-brand-primary dark:text-blue-400">
                        {{ strtoupper(substr($category->name, 0, 1)) }}
                    </span>
                </div>

                <!-- Content -->
                <h3 class="text-lg font-bold text-slate-800 dark:text-cream mb-1">{{ $category->name }}</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-6">
                    {{ $category->products()->count() }} {{ __('Products') }}
                </p>

                <!-- Actions -->
                <div class="flex items-center gap-2 w-full mt-auto">
                    <button wire:click="edit({{ $category->id }})"
                        class="flex-1 py-2 px-3 rounded-lg bg-slate-50 dark:bg-neutral-800 text-slate-600 dark:text-slate-300 text-sm font-medium hover:bg-brand-primary hover:text-white transition-colors">
                        {{ __('Edit') }}
                    </button>
                    <button wire:click="delete({{ $category->id }})"
                        wire:confirm="{{ __('Are you sure you want to delete this category?') }}"
                        class="p-2 rounded-lg bg-red-50 dark:bg-red-900/10 text-red-500 hover:bg-red-500 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-slate-500 dark:text-slate-400">
                <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <p class="text-lg">{{ __('No categories found.') }}</p>
                <button wire:click="create" class="mt-4 text-brand-primary font-bold hover:underline">
                    {{ __('Create your first category') }}
                </button>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $categories->links() }}
    </div>

    <!-- Modal -->
    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm animate-fade-in">
            <div
                class="bg-white dark:bg-neutral-900 rounded-3xl shadow-2xl w-full max-w-md p-6 border border-slate-100 dark:border-neutral-800 relative">
                <h2 class="text-xl font-bold mb-6 text-slate-900 dark:text-cream">
                    {{ $editingCategory ? __('Edit Category') : __('New Category') }}
                </h2>

                <form wire:submit.prevent="save">
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">{{ __('Name') }}
                            <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="name"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-neutral-700 bg-slate-50 dark:bg-neutral-800 focus:ring-2 focus:ring-brand-primary outline-none transition-all dark:text-white"
                            placeholder="Ex: Sun Glasses">
                        @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" wire:click="closeModal"
                            class="px-5 py-2.5 rounded-xl border border-slate-200 dark:border-neutral-700 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-neutral-800 font-medium transition-colors">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit"
                            class="px-5 py-2.5 rounded-xl bg-brand-primary text-white font-bold hover:bg-brand-secondary shadow-lg shadow-brand-primary/20 transition-all hover:scale-105 active:scale-95">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>