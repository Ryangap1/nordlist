<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePresentacionRequest;
use App\Http\Requests\UpdatePresentacionRequest;
use App\Models\Caracteristica;
use App\Models\Presentacion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PresentacionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-presentacion|crear-presentacion|editar-presentacion|eliminar-presentacion', ['only' => ['index']]);
        $this->middleware('permission:crear-presentacion', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-presentacion', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-presentacion', ['only' => ['destroy']]);
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presentaciones = Presentacion::with('caracteristica')->latest()->get();

        return view('presentacion.index',['presentaciones' => $presentaciones]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('presentacion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePresentacionRequest $request)
    {
        //dd($request);
        try{
            DB::beginTransaction();
            $caracteristica = Caracteristica::create($request->validated());
            $caracteristica->presentacion()->create([
                'caracteristica_id' => $caracteristica->id
            ]);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }

        return redirect()->route('presentaciones.index')->with('success','Presentación registrada');

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
    public function edit(presentacion $presentacion)
    {
        //dd($presentacion);

        return view('presentacion.edit',['presentacion'=>$presentacion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePresentacionRequest $request, presentacion $presentacion)
    {
        Caracteristica::where('id',$presentacion->caracteristica->id)
        ->update($request->validated());

        return redirect()->route('presentaciones.index')->with('success','Presentación actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //dd($id);

        $message = '';

        $presentacion = Presentacion::find($id);

        if($presentacion->caracteristica->estado == 1) {
            Caracteristica::where('id',$presentacion->caracteristica->id)
                ->update([
                    'estado' => 0
                ]);
                $message = 'Presentación eliminada';
        } else {
            Caracteristica::where('id',$presentacion->caracteristica->id)
                ->update([
                    'estado' => 1
                ]);
                $message = 'Presentación restaurada';
        }
        

        return redirect()->route('presentaciones.index')->with('success',$message);
    }
}
