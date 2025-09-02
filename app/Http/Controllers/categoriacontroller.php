<?php

namespace App\Http\Controllers;

use App\Http\Requests\storecategoriarequest;
use App\Models\Caracteristicas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class categoriacontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('categoria.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storecategoriarequest $request)
    {
        dd($request);
        try{
            DB::beingtransaction();
            $caracteristica = Caracteristicas::create($request->validated());
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        
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
