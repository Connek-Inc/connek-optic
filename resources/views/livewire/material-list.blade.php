<div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-slate-800">Materiales y Lentes</h2>

        <div class="flex items-center space-x-4">
            <input wire:model.live="search" type="text" placeholder="Buscar material..."
                class="px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
            <button wire:click="create"
                class="bg-teal-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-teal-700 transition-colors">
                + Nuevo Material
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="px-6 py-4 bg-green-50 text-green-700 border-b border-green-100">
            {{ session('message') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-xs uppercase font-medium text-slate-500">
                <tr>
                    <th class="px-6 py-3">Nombre</th>
                    <th class="px-6 py-3">Tipo</th>
                    <th class="px-6 py-3 text-center">Stock</th>
                    <th class="px-6 py-3 text-right">Precio</th>
                    <th class="px-6 py-3 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100" wire:poll.10s>
                @forelse($materials as $material)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-900">
                            {{ $material->name }}
                            @if($material->description)
                                <p class="text-xs text-slate-400 font-normal">{{ $material->description }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 rounded-full text-xs font-medium 
                                        {{ $material->type === 'lens' ? 'bg-blue-50 text-blue-600' : 'bg-orange-50 text-orange-600' }}">
                                {{ $material->type === 'lens' ? 'Lente' : ($material->type === 'frame' ? 'Montura' : ucfirst($material->type)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="{{ $material->stock < 10 ? 'text-red-600 font-bold' : 'text-slate-900' }}">
                                {{ $material->stock }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">${{ number_format($material->price, 2) }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <button wire:click="edit({{ $material->id }})"
                                class="text-slate-400 hover:text-slate-600">Editar</button>
                            <button wire:click="delete({{ $material->id }})"
                                wire:confirm="¿Seguro que deseas eliminar este material?"
                                class="text-red-400 hover:text-red-600">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                            No se encontraron materiales.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-slate-100">
        {{ $materials->links() }}
    </div>

    <!-- Create/Edit Modal -->
    @if($showCreateModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md overflow-hidden animate-fade-in">
                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                    <h3 class="font-bold text-slate-800">{{ $isEditing ? 'Editar Material' : 'Agregar Material' }}</h3>
                    <button wire:click="$set('showCreateModal', false)"
                        class="text-slate-400 hover:text-slate-600">&times;</button>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nombre</label>
                        <input wire:model="name" type="text"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:outline-none">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Tipo</label>
                            <select wire:model="type"
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:outline-none">
                                <option value="lens">Lente</option>
                                <option value="frame">Montura</option>
                                <option value="contact_lens">Lente de contacto</option>
                                <option value="accessory">Accesorio</option>
                                <option value="material_lens">Material de Lente</option>
                                <option value="lens_index">Índice</option>
                                <option value="lens_option">Opción Lente</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Stock</label>
                            <input wire:model="stock" type="number"
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:outline-none">
                            @error('stock') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Precio</label>
                        <input wire:model="price" type="number" step="0.01"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:outline-none">
                        @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Descripción</label>
                        <textarea wire:model="description"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:outline-none"></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 bg-slate-50 flex justify-end space-x-3">
                    <button wire:click="$set('showCreateModal', false)"
                        class="px-4 py-2 border border-slate-300 rounded-lg text-slate-600 hover:bg-white transition-colors">Cancelar</button>
                    <button wire:click="save"
                        class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">Guardar</button>
                </div>
            </div>
        </div>
    @endif
</div>