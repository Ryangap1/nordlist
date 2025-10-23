<?php

use App\Http\Controllers\categoriacontroller;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\PresentacionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\VentaController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class, 'index'])->name('panel');

Route::resource('categorias', categoriacontroller::class);

Route::resource('marcas', MarcaController::class);

Route::resource('presentaciones', PresentacionController::class)
->parameters(['presentaciones' => 'presentacion']);

Route::resource('productos', ProductoController::class);

Route::resource('clientes', ClienteController::class);

Route::resource('proveedores', ProveedorController::class)
->parameters(['proveedores' => 'proveedor']);

Route::resource('compras', CompraController::class);

Route::resource('ventas', VentaController::class);

Route::get('/login',[LoginController::class, 'index'])->name('login');

Route::post('/login',[LoginController::class, 'login']);

Route::get('/logout',[LogoutController::class, 'logout'])->name('logout');

Route::get('/401', function () {
    return view('pages.401');
});

Route::get('/404', function () {
    return view('pages.404');
});

Route::get('/500', function () {
    return view('pages.500');
});
