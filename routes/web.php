<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/usuarios/');
});

Route::prefix('/usuarios')->group(function () {
    Route::get('/', [\App\Http\Controllers\UsuariosController::class, 'index'])->name('index.usuarios');
    Route::post('/auth', [\App\Http\Controllers\UsuariosController::class, 'verifyUser'])->name('auth.usuarios');
    Route::get('/register-user', [\App\Http\Controllers\UsuariosController::class, 'register'])->name('register.usuario');
    Route::delete('/delete/{id}', [\App\Http\Controllers\UsuariosController::class, 'destroy'])->name('delete.usuario');
    Route::post('/register', [\App\Http\Controllers\UsuariosController::class, 'store'])->name('store.usuario');
    Route::put('/edit/{id}', [\App\Http\Controllers\UsuariosController::class, 'update'])->name('update.usuario');
});

Route::prefix('/turmas')->group(function () {
    Route::get('/', [\App\Http\Controllers\TurmaController::class, 'index'])->name('index.turmas');
    Route::post('/create', [\App\Http\Controllers\TurmaController::class, 'store'])->name('store.turmas');
    Route::delete('/delete/{id}', [\App\Http\Controllers\TurmaController::class, 'destroy'])->name('delete.turmas');
    Route::put('/edit/{id}', [\App\Http\Controllers\TurmaController::class, 'update'])->name('update.turmas');
});

Route::prefix('/avaliacao')->group(function () {
    Route::get('/', [\App\Http\Controllers\AvaliacaoController::class, 'index'])->name('index.avaliacao');
    Route::post('/create', [\App\Http\Controllers\AvaliacaoController::class, 'store'])->name('store.avaliacao');
    Route::delete('/delete/{id}', [\App\Http\Controllers\AvaliacaoController::class, 'destroy'])->name('delete.avaliacao');
    Route::put('/edit/{id}', [\App\Http\Controllers\AvaliacaoController::class, 'update'])->name('update.avaliacao');
});
