<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\RelatorioController;


//Login / Registro


Route::get('/', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- Recuperação de Senha ---
Route::get('/recuperar', [AuthController::class, 'showForgotForm']);
Route::post('/enviar-link-recuperacao', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update');

// --- Usuário Logado (Dashboard e Agendamento) ---
Route::middleware(['auth.session'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rota para o calendário buscar os agendamentos (JSON)
    Route::get('/api/agendamentos', [AgendamentoController::class, 'api']);

    Route::get('/agendar', [AgendamentoController::class, 'create'])->name('agendar.create');
    Route::post('/agendar', [AgendamentoController::class, 'store'])->name('agendar.store');
    
    // Edição rápida pelo próprio usuário
    Route::get('/agendamentos/{id}/edit', [AgendamentoController::class, 'edit']);
    Route::put('/agendamentos/{id}', [AgendamentoController::class, 'update']);
});


//Admin


Route::middleware(['auth.session','admin'])->group(function () {

    Route::get('/clientes',[ClienteController::class,'index'])->name('clientes.index');
    Route::get('/clientes/create',[ClienteController::class,'create'])->name('clientes.create');
    Route::post('/clientes',[ClienteController::class,'store'])->name('clientes.store');

    Route::get('/clientes/{id}/edit',[ClienteController::class,'edit'])->name('clientes.edit');
    Route::put('/clientes/{id}',[ClienteController::class,'update'])->name('clientes.update');
    Route::delete('/clientes/{id}',[ClienteController::class,'destroy'])->name('clientes.destroy');

    Route::get('/agendamentos',[AgendamentoController::class,'index'])->name('agendamentos.index');
    Route::get('/agendamentos/{id}/edit',[AgendamentoController::class,'edit'])->name('agendamentos.edit');
    Route::put('/agendamentos/{id}',[AgendamentoController::class,'update'])->name('agendamentos.update');
    Route::delete('/agendamentos/{id}',[AgendamentoController::class,'destroy'])->name('agendamentos.destroy');
    Route::get('/api/agendamentos',[AgendamentoController::class,'api']);

    Route::get('/relatorios', [RelatorioController::class,'index'])->name('relatorios.index');
    Route::post('/relatorios/gerar', [RelatorioController::class,'gerar'])->name('relatorios.gerar');

});