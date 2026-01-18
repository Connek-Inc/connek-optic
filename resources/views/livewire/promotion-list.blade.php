<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-slate-800 dark:text-cream">Gestión de Promociones</h2>
        <button wire:click="create"
            class="bg-brand-primary text-white px-4 py-2 rounded-lg hover:bg-brand-light transition-colors">
            + Nueva Promoción
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 relative">
            {{ session('message') }}
        </div>
    @endif

    <div
        class="bg-white dark:bg-neutral-900 rounded-xl shadow-sm border border-slate-200 dark:border-neutral-800 overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200 dark:divide-neutral-800">
            <thead class="bg-slate-50 dark:bg-neutral-800/50">
                <tr>
                    <th
                        class="px-6 py-3 text-left text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                        Nombre</th>
                    <th
                        class="px-6 py-3 text-left text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                        Precio</th>
                    <th
                        class="px-6 py-3 text-left text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                        Tipo</th>
                    <th
                        class="px-6 py-3 text-left text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                        Estado</th>
                    <th
                        class="px-6 py-3 text-right text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                        Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-neutral-900 divide-y divide-slate-200 dark:divide-neutral-800">
                @forelse($promotions as $promo)
                    <tr class="hover:bg-slate-50 dark:hover:bg-neutral-800/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-900 dark:text-cream">{{ $promo->name }}</span>
                                <span
                                    class="text-xs text-slate-500 dark:text-slate-400">{{ Str::limit($promo->description, 40) }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-brand-primary font-bold">${{ number_format($promo->price, 2) }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 py-1 text-xs rounded-full bg-slate-100 dark:bg-neutral-800 text-slate-600 dark:text-slate-300 capitalize">
                                {{ $promo->type }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="toggleStatus({{ $promo->id }})"
                                class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none {{ $promo->active ? 'bg-green-500' : 'bg-slate-200 dark:bg-neutral-700' }}">
                                <span aria-hidden="true"
                                    class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $promo->active ? 'translate-x-5' : 'translate-x-0' }}"></span>
                            </button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="edit({{ $promo->id }})"
                                class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-200 mr-4">Editar</button>
                            <button wire:click="delete({{ $promo->id }})" wire:confirm="Are you sure?"
                                class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-200">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-slate-500 dark:text-slate-400">
                            No hay promociones registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                    wire:click="$set('showModal', false)"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div
                    class="inline-block align-bottom bg-white dark:bg-neutral-900 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white dark:bg-neutral-900 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-slate-900 dark:text-cream" id="modal-title">
                                    {{ $isEditing ? 'Editar Promoción' : 'Nueva Promoción' }}
                                </h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-slate-700 dark:text-slate-300">Nombre</label>
                                        <input type="text" wire:model="name"
                                            class="mt-1 block w-full rounded-md border-slate-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
                                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-slate-700 dark:text-slate-300">Precio</label>
                                        <input type="number" step="0.01" wire:model="price"
                                            class="mt-1 block w-full rounded-md border-slate-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
                                        @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-slate-700 dark:text-slate-300">Descripción</label>
                                        <textarea wire:model="description" rows="2"
                                            class="mt-1 block w-full rounded-md border-slate-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50"></textarea>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tipo</label>
                                        <select wire:model="type"
                                            class="mt-1 block w-full rounded-md border-slate-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
                                            <option value="simple">Simple</option>
                                            <option value="progressif">Progresivo</option>
                                            <option value="other">Otro</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-slate-700 dark:text-slate-300">Características
                                            (una por línea)</label>
                                        <textarea wire:model="featuresText" rows="4"
                                            placeholder="Lentes Anti-reflejo&#10;Montura Incluida"
                                            class="mt-1 block w-full rounded-md border-slate-300 dark:border-neutral-700 dark:bg-neutral-800 dark:text-white shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50"></textarea>
                                        <p class="text-xs text-slate-500 mt-1">Escribe cada característica en una nueva
                                            línea.</p>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" wire:model="active"
                                            class="rounded border-slate-300 text-brand-primary shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-slate-700 dark:text-slate-300">Activo</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 dark:bg-neutral-800/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" wire:click="save"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-brand-primary text-base font-medium text-white hover:bg-brand-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary sm:ml-3 sm:w-auto sm:text-sm">
                            Guardar
                        </button>
                        <button type="button" wire:click="$set('showModal', false)"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 dark:border-neutral-700 shadow-sm px-4 py-2 bg-white dark:bg-neutral-800 text-base font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>