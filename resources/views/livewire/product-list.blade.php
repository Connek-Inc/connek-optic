<div>
    <!-- Desktop View Container -->
    <div
        class="hidden md:block bg-white dark:bg-neutral-900 rounded-xl shadow-sm border border-slate-100 dark:border-neutral-800 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-neutral-800 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-slate-800 dark:text-cream">Inventario de Productos</h2>

            <div class="flex items-center space-x-4">
                <input wire:model.live="search" type="text" placeholder="Buscar productos..."
                    class="px-4 py-2 border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-slate-900 dark:text-cream rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-primary placeholder-slate-400">
                <button wire:click="create"
                    class="bg-brand-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-brand-light transition-colors">
                    + Nuevo Producto
                </button>
            </div>
        </div>

        @if (session()->has('message'))
            <div
                class="px-6 py-4 bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 border-b border-green-100 dark:border-green-800">
                {{ session('message') }}
            </div>
        @endif

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <div class="group bg-white dark:bg-neutral-800 rounded-2xl border border-slate-100 dark:border-neutral-800 shadow-sm hover:shadow-xl hover:border-brand-primary/20 transition-all duration-300 flex flex-col overflow-hidden relative">
                        <!-- Image Area -->
                        <div class="aspect-[4/3] bg-slate-50 dark:bg-neutral-900 overflow-hidden relative">
                            @if($product->image_path)
                                <img src="{{ $product->image_path }}" alt="{{ $product->name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="flex items-center justify-center h-full text-slate-300">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute top-3 right-3 bg-white/90 dark:bg-neutral-900/90 backdrop-blur-sm px-2 py-1 rounded-lg text-xs font-bold shadow-sm">
                                {{ $product->brand }}
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-5 flex-1 flex flex-col">
                            <div class="mb-3">
                                <h3 class="font-bold text-slate-900 dark:text-cream text-lg leading-tight mb-1">{{ $product->name }}</h3>
                                <p class="text-xs text-slate-500 font-mono">{{ $product->sku }}</p>
                            </div>

                            <!-- Specs Pills -->
                            @if($product->specs)
                                <div class="flex flex-wrap gap-1 mb-4">
                                    @if(isset($product->specs['material']))
                                        <span class="px-2 py-0.5 bg-slate-50 dark:bg-neutral-700 text-slate-500 dark:text-slate-300 text-[10px] uppercase font-bold rounded">{{ $product->specs['material'] }}</span>
                                    @endif
                                    @if(isset($product->specs['shape']))
                                        <span class="px-2 py-0.5 bg-slate-50 dark:bg-neutral-700 text-slate-500 dark:text-slate-300 text-[10px] uppercase font-bold rounded">{{ $product->specs['shape'] }}</span>
                                    @endif
                                    @if(isset($product->specs['lens_width']))
                                        <span class="px-2 py-0.5 bg-slate-50 dark:bg-neutral-700 text-slate-500 dark:text-slate-300 text-[10px] uppercase font-bold rounded">{{ $product->specs['lens_width'] }}mm</span>
                                    @endif
                                </div>
                            @endif

                            <div class="mt-auto flex items-end justify-between border-t border-slate-50 dark:border-neutral-800 pt-4">
                                <div>
                                    <div class="text-xs text-slate-400 uppercase font-bold">Precio</div>
                                    <div class="text-xl font-extrabold text-brand-primary dark:text-brand-light">${{ number_format($product->price, 0) }}</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-xs text-slate-400 uppercase font-bold mb-0.5">Stock</div>
                                    <div class="{{ $product->stock_quantity < 5 ? 'text-red-500' : 'text-slate-700 dark:text-slate-300' }} font-bold text-sm">
                                        {{ $product->stock_quantity }} un.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions Overlay (Hover) -->
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center space-x-3 backdrop-blur-[2px]">
                            <button wire:click="edit({{ $product->id }})" class="bg-white text-slate-900 w-10 h-10 rounded-full flex items-center justify-center hover:bg-brand-primary hover:text-white transition-colors shadow-lg transform hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            <button wire:click="delete({{ $product->id }})" wire:confirm="¿Seguro que deseas eliminar?" class="bg-white text-red-500 w-10 h-10 rounded-full flex items-center justify-center hover:bg-red-500 hover:text-white transition-colors shadow-lg transform hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 text-slate-400 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-slate-900 dark:text-cream">No hay productos</h3>
                        <p class="text-slate-500">Intenta ajustar tu búsqueda o crea un nuevo producto.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="px-6 py-4 border-t border-slate-100 dark:border-neutral-800">
            {{ $products->links() }}
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
                <input wire:model.live="search" type="text" placeholder="Buscar productos..."
                    class="w-full pl-10 pr-4 py-3 border border-slate-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-slate-900 dark:text-cream rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-brand-primary">
            </div>
            <button wire:click="create"
                class="bg-brand-primary text-white w-12 h-12 flex items-center justify-center rounded-xl shadow-md hover:bg-brand-light transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </button>
        </div>

        @if (session()->has('message'))
            <div
                class="mb-4 px-4 py-3 bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 rounded-xl border border-green-100 dark:border-green-800">
                {{ session('message') }}
            </div>
        @endif

        <!-- Mobile Cards List -->
        <div class="space-y-4">
            @forelse($products as $product)
                <div
                    class="bg-white dark:bg-neutral-800 p-5 rounded-xl border border-slate-100 dark:border-neutral-700 shadow-sm relative">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h3 class="font-bold text-slate-900 dark:text-cream text-lg">{{ $product->name }}</h3>
                            <p class="text-xs text-slate-400">{{ $product->brand }} •
                                {{ $product->category ? $product->category->name : 'General' }}</p>
                        </div>
                        <span
                            class="px-2 py-1 bg-slate-100 dark:bg-neutral-700 rounded text-xs font-mono text-slate-600 dark:text-slate-300">
                            {{ $product->sku }}
                        </span>
                    </div>

                    <div class="flex justify-between items-end mb-4">
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 uppercase font-bold tracking-wider mb-1">
                                Stock</p>
                            <span
                                class="text-lg font-bold {{ $product->stock_quantity < 10 ? 'text-red-500' : 'text-slate-900 dark:text-cream' }}">
                                {{ $product->stock_quantity }} <span class="text-sm font-normal text-slate-400">unid.</span>
                            </span>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-slate-500 dark:text-slate-400 uppercase font-bold tracking-wider mb-1">
                                Precio</p>
                            <span
                                class="text-xl font-bold text-brand-primary dark:text-brand-light">${{ number_format($product->price, 2) }}</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 pt-3 border-t border-slate-100 dark:border-neutral-700">
                        <button
                            class="w-full py-2 rounded-lg bg-slate-50 dark:bg-neutral-700 text-slate-600 dark:text-slate-300 text-sm font-medium hover:bg-slate-100 dark:hover:bg-neutral-600 transition-colors">
                            Editar
                        </button>
                        <button
                            class="w-full py-2 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-sm font-medium hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors">
                            Eliminar
                        </button>
                    </div>
                </div>
            @empty
                <div
                    class="text-center py-12 text-slate-500 bg-white dark:bg-neutral-800 rounded-xl border border-slate-100 dark:border-neutral-800">
                    No se encontraron productos.
                </div>
            @endforelse
        </div>

        <div class="py-4">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Create Modal -->
    @if($showCreateModal)
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div
                class="bg-white dark:bg-neutral-900 rounded-2xl shadow-xl w-full max-w-lg overflow-hidden animate-fade-in border border-slate-100 dark:border-neutral-800">
                <div
                    class="px-6 py-4 border-b border-slate-100 dark:border-neutral-800 flex justify-between items-center bg-slate-50 dark:bg-neutral-800/50">
                    <h3 class="font-bold text-slate-800 dark:text-cream">Agregar Producto</h3>
                    <button wire:click="$set('showCreateModal', false)"
                        class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-2xl leading-none">&times;</button>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nombre</label>
                        <input wire:model="name" type="text"
                            class="w-full px-3 py-2 border border-slate-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-slate-900 dark:text-cream rounded-lg focus:ring-2 focus:ring-brand-primary focus:outline-none">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Marca</label>
                            <input wire:model="brand" type="text"
                                class="w-full px-3 py-2 border border-slate-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-slate-900 dark:text-cream rounded-lg focus:ring-2 focus:ring-brand-primary focus:outline-none">
                            @error('brand') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">SKU</label>
                            <input wire:model="sku" type="text"
                                class="w-full px-3 py-2 border border-slate-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-slate-900 dark:text-cream rounded-lg focus:ring-2 focus:ring-brand-primary focus:outline-none">
                            @error('sku') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Precio</label>
                            <input wire:model="price" type="number" step="0.01"
                                class="w-full px-3 py-2 border border-slate-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-slate-900 dark:text-cream rounded-lg focus:ring-2 focus:ring-brand-primary focus:outline-none">
                            @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Stock</label>
                            <input wire:model="stock_quantity" type="number"
                                class="w-full px-3 py-2 border border-slate-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-slate-900 dark:text-cream rounded-lg focus:ring-2 focus:ring-brand-primary focus:outline-none">
                            @error('stock_quantity') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Categoría</label>
                        <select wire:model="category_id"
                            class="w-full px-3 py-2 border border-slate-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-slate-900 dark:text-cream rounded-lg focus:ring-2 focus:ring-brand-primary focus:outline-none">
                            <option value="">Seleccionar...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Descripción</label>
                        <textarea wire:model="description"
                            class="w-full px-3 py-2 border border-slate-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-slate-900 dark:text-cream rounded-lg focus:ring-2 focus:ring-brand-primary focus:outline-none"></textarea>
                    </div>
                </div>
                <div
                    class="px-6 py-4 bg-slate-50 dark:bg-neutral-800/50 flex justify-end space-x-3 border-t border-slate-100 dark:border-neutral-800">
                    <button wire:click="$set('showCreateModal', false)"
                        class="px-4 py-2 border border-slate-300 dark:border-neutral-600 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-white dark:hover:bg-neutral-700 transition-colors">Cancelar</button>
                    <button wire:click="save"
                        class="px-4 py-2 bg-brand-primary text-white rounded-lg hover:bg-brand-light transition-colors">Guardar</button>
                </div>
            </div>
        </div>
    @endif
</div>