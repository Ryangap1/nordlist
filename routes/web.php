<?php

use App\Http\Controllers\categoriacontroller;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\PresentacionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('template');
});

Route::view('/panel', 'panel.index')->name('panel');

Route::resource('categorias', categoriacontroller::class);

Route::resource('marcas', MarcaController::class);

Route::resource('presentaciones', PresentacionController::class)
->parameters(['presentaciones' => 'presentacion']);

Route::resource('productos', ProductoController::class);

Route::resource('clientes', ClienteController::class);

Route::resource('proveedores', ProveedorController::class)
->parameters(['proveedores' => 'proveedor']);

Route::resource('compras', CompraController::class);

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/401', function () {
    return view('pages.401');
});

Route::get('/404', function () {
    return view('pages.404');
});

Route::get('/500', function () {
    return view('pages.500');
});
