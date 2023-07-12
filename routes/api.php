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
    Route::post('/auth', [\App\Http\Controllers\UsuariosController::class, 'verifyUser'])->name('index.usuarios');
    Route::post('/register', [\App\Http\Controllers\UsuariosController::class, 'store'])->name('store.usuario');
    Route::post('/edit/{id}', [\App\Http\Controllers\UsuariosController::class, 'update'])->name('update.usuario');
    Route::get('/delete/{id}', [\App\Http\Controllers\UsuariosController::class, 'destroy'])->name('delete.usuario');
});
