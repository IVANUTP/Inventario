<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\categoriaontroller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\productoontroller;
use App\Http\Controllers\Reportes;
use Illuminate\Support\Facades\Route;


Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/', function () {
    return view('welcome');
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/categorias', [categoriaontroller::class, 'index'])->name('inicio');
    Route::post('/categorias', [categoriaontroller::class, 'store'])->name('categorias.store');
    Route::put('/categorias/{id}', [categoriaontroller::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{id}', action: [categoriaontroller::class, 'destroy'])->name('categorias.destroy');
    Route::get('/productos', [productoontroller::class, 'index'])->name('productos');
    Route::post('/productos', [productoontroller::class, 'store'])->name('productos.store');
    Route::put('/productos/{id}', [productoontroller::class, 'update'])->name('productos.update');
    Route::delete('/productos/{id}', [productoontroller::class, 'destroy'])->name('productos.destroy');
    Route::get('/reportes', [Reportes::class, 'index'])->name('reportes');
Route::get('/reportes/excel', [Reportes::class, 'exportarExcel'])->name('reportes.excel');
});

