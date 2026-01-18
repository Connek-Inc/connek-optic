<x-app-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Dashboard</h1>
        <p class="text-slate-500">Bienvenido a OptiCoach Pro</p>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Card 1: Total Products -->
        <!-- Card 1: Total Products -->
        <div
            class="bg-white/70 dark:bg-neutral-900/70 backdrop-blur-md p-6 rounded-xl shadow-sm border border-slate-200/50 dark:border-neutral-800/50 flex items-center">
            <div class="p-3 bg-blue-50 rounded-full text-blue-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Productos</p>
                <p class="text-2xl font-bold text-slate-900">1,245</p>
            </div>
        </div>

        <!-- Card 2: Low Stock -->
        <!-- Card 2: Low Stock -->
        <div
            class="bg-white/70 dark:bg-neutral-900/70 backdrop-blur-md p-6 rounded-xl shadow-sm border border-slate-200/50 dark:border-neutral-800/50 flex items-center">
            <div class="p-3 bg-red-50 rounded-full text-red-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Stock Bajo</p>
                <p class="text-2xl font-bold text-slate-900">12</p>
            </div>
        </div>

        <!-- Card 3: Recent Sales -->
        <!-- Card 3: Recent Sales -->
        <div
            class="bg-white/70 dark:bg-neutral-900/70 backdrop-blur-md p-6 rounded-xl shadow-sm border border-slate-200/50 dark:border-neutral-800/50 flex items-center">
            <div class="p-3 bg-green-50 rounded-full text-green-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Ventas Hoy</p>
                <p class="text-2xl font-bold text-slate-900">$850.00</p>
            </div>
        </div>
    </div>

    <!-- Recent Activity / Table Section -->
    <!-- Recent Activity / Table Section -->
    <div
        class="bg-white/70 dark:bg-neutral-900/70 backdrop-blur-md rounded-xl shadow-sm border border-slate-200/50 dark:border-neutral-800/50 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-slate-800">Inventario Reciente</h2>
            <button class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Ver Todo</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase font-medium text-slate-500">
                    <tr>
                        <th class="px-6 py-3">Producto</th>
                        <th class="px-6 py-3">Categoría</th>
                        <th class="px-6 py-3 text-center">Stock</th>
                        <th class="px-6 py-3 text-right">Precio</th>
                        <th class="px-6 py-3">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-900">Ray-Ban Aviator</td>
                        <td class="px-6 py-4">Lentes de Sol</td>
                        <td class="px-6 py-4 text-center">45</td>
                        <td class="px-6 py-4 text-right">$150.00</td>
                        <td class="px-6 py-4"><span
                                class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">En Stock</span></td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-900">Oakley Holbrook</td>
                        <td class="px-6 py-4">Deportivo</td>
                        <td class="px-6 py-4 text-center">8</td>
                        <td class="px-6 py-4 text-right">$130.00</td>
                        <td class="px-6 py-4"><span
                                class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Bajo Stock</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-900">Lentes de Contacto Acuvue</td>
                        <td class="px-6 py-4">Lentes de Contacto</td>
                        <td class="px-6 py-4 text-center">120</td>
                        <td class="px-6 py-4 text-right">$45.00</td>
                        <td class="px-6 py-4"><span
                                class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">En Stock</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>