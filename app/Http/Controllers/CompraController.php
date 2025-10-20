<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompraRequest;
use App\Models\Comprobante;
use App\Models\Producto;
use App\Models\Proveedor;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;

class CompraController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('compra.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedor::wherehas('persona',function($query){
            $query->where('estado',1);
        })->get();
        $comprobantes = Comprobante::all();
        $productos = Producto::all();
        return view('compra.create',compact('proveedores','comprobantes','productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompraRequest $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
