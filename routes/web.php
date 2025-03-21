<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

// Rotas do Site
Route::get('/', [App\Http\Controllers\Site\HomeController::class, 'index'])->name('site.home');
Route::get('/veiculo/{id}', [App\Http\Controllers\Site\VeiculoController::class, 'show'])->name('site.veiculo.show');
Route::post('/lead', [App\Http\Controllers\Site\LeadController::class, 'store'])->name('site.lead.store');

// Rotas para AJAX
Route::get('/modelos/{marca_id}', function($marca_id) {
    return App\Models\Modelo::where('marca_id', $marca_id)->get();
})->name('api.modelos');

// Rotas do Admin
Route::prefix('admin')->name('admin.')->group(function() {
    // Dashboard
    Route::get('/', function() {
        return view('admin.dashboard');
    })->name('dashboard');
    
    // Marcas
    Route::resource('marcas', App\Http\Controllers\Admin\MarcaController::class);
    
    // Modelos
    Route::resource('modelos', App\Http\Controllers\Admin\ModeloController::class);
    
    // Veículos
    Route::resource('veiculos', App\Http\Controllers\Admin\VeiculoController::class);
    Route::delete('fotos/{id}', [App\Http\Controllers\Admin\VeiculoController::class, 'deleteFoto'])->name('fotos.delete');
    
    // Leads
    Route::resource('leads', App\Http\Controllers\Admin\LeadController::class)->only(['index', 'show', 'destroy']);
});