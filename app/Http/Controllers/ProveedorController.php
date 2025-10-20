<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdateProveedorRequest;
use App\Models\Documento;
use App\Models\Persona;
use App\Models\Proveedor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProveedorController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::with('persona.documento')->get();
        //dd($proveedores);
        return view('proveedor.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documentos = Documento::all();
        return view('proveedor.create', compact('documentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonaRequest $request)
    {
        try{
            DB::beginTransaction();
            $persona = Persona::create($request->validated());
            $persona->proveedor()->create([
                'persona_id' => $persona->id
            ]);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();

            //dd($e->getMessage());
        }

        return redirect()->route('proveedores.index')->with('success', 'Proveedor registrado');
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
    public function edit(Proveedor $proveedor)
    {
         $proveedor->load('persona.documento');

        //dd($proveedor);

        $documentos = Documento::all();

        return view('proveedor.edit', compact('proveedor','documentos'));   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProveedorRequest $request, Proveedor $proveedor)
    {
        try{
            DB::beginTransaction();

            Persona::where('id',$proveedor->persona->id)
            ->update($request->validated());

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }

        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';

        $persona = Persona::find($id);

        if($persona->estado == 1) {
            Persona::where('id',$persona->id)
                ->update([
                    'estado' => 0
                ]);
                $message = 'Proveedor eliminado';
        } else {
            Persona::where('id',$persona->id)
                ->update([
                    'estado' => 1
                ]);
                $message = 'Prooveedor restaurado';
        }
        

        return redirect()->route('proveedores.index')->with('success',$message);
    }
}
