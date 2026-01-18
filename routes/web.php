<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\ProductList;
use App\Livewire\NewClientWizard;
use App\Livewire\MaterialList;
use App\Livewire\ClientList;
use App\Livewire\ClientDetail;
use App\Livewire\SaleList;

use App\Livewire\Auth\Login;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/login', Login::class)->name('login');

Route::get('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login');
})->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/inventario', ProductList::class)->name('inventario');
    Route::get('/categorias', App\Livewire\CategoryList::class)->name('categorias');
    Route::get('/materiales', MaterialList::class)->name('materiales');
    Route::get('/clientes', ClientList::class)->name('clientes');
    Route::get('/clientes/{client}', ClientDetail::class)->name('clientes.show');
    Route::get('/facturas', SaleList::class)->name('facturas');
    Route::get('/nouveau-client', NewClientWizard::class)->name('nouveau.client');
    Route::get('/promociones', App\Livewire\PromotionList::class)->name('promociones');

    Route::get('/print/prescription/{client}', function (App\Models\Client $client) {
        return view('print.prescription', ['client' => $client]);
    })->name('print.prescription');
});

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es', 'fr'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');
