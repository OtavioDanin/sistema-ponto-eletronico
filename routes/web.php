<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\TimeRecordController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\IsAdminMiddleware;

// Rotas públicas (Breeze cuida da maioria)
Route::get('/', function () {
    return view('welcome');
});

// Rotas que exigem autenticação
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard principal (decide o que mostrar)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rotas de Perfil (Breeze) - Alterar Senha
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rota para funcionário registrar o ponto
    Route::post('/time-records', [TimeRecordController::class, 'store'])->name('time-records.store');

    // --- ROTAS DE ADMINISTRADOR ---
    Route::middleware(IsAdminMiddleware::class)->prefix('admin')->name('admin.')->group(function () {
        // CRUD de Funcionários
        Route::resource('employees', EmployeeController::class);

        // Visualização e filtro de pontos
        Route::get('time-records', [TimeRecordController::class, 'index'])->name('time-records.index');
    });
});


require __DIR__ . '/auth.php';
