<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/usuarios')->group(function () {
    Route::get('/auth', [\App\Http\Controllers\UsuariosController::class, 'verifyUser'])->name('index.usuarios');
    Route::get('/delete/{id}', [\App\Http\Controllers\UsuariosController::class, 'destroy'])->name('delete.usuario');
    Route::post('/register', [\App\Http\Controllers\UsuariosController::class, 'store'])->name('store.usuario');
    Route::post('/edit/{id}', [\App\Http\Controllers\UsuariosController::class, 'update'])->name('update.usuario');
});

Route::prefix('/turmas')->group(function () {
    Route::get('/', [\App\Http\Controllers\TurmaController::class, 'index'])->name('index.turmas');
    Route::post('/create', [\App\Http\Controllers\TurmaController::class, 'store'])->name('store.turmas');
    Route::get('/delete/{id}', [\App\Http\Controllers\TurmaController::class, 'destroy'])->name('delete.turmas');
    Route::post('/edit/{id}', [\App\Http\Controllers\TurmaController::class, 'update'])->name('update.turmas');
});

Route::prefix('/avaliacao')->group(function () {
    Route::get('/', [\App\Http\Controllers\AvaliacaoController::class, 'index'])->name('index.avaliacao');
    Route::post('/create', [\App\Http\Controllers\AvaliacaoController::class, 'store'])->name('store.avaliacao');
    Route::get('/delete/{id}', [\App\Http\Controllers\AvaliacaoController::class, 'destroy'])->name('delete.avaliacao');
    Route::post('/edit/{id}', [\App\Http\Controllers\AvaliacaoController::class, 'update'])->name('update.avaliacao');
});
