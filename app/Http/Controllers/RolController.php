<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{
    function __construct()
    {
        //$this->middleware('permission:ver-rol|crear-rol|editar-rol|eliminar-rol', ['only' => ['index']]);
        //$this->middleware('permission:crear-rol', ['only' => ['create', 'store']]);
        //$this->middleware('permission:editar-rol', ['only' => ['edit', 'update']]);
        //$this->middleware('permission:eliminar-rol', ['only' => ['destroy']]);
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return view('rol.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permisos = Permission::all();
        return view('rol.create', compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);

        try{
            DB::beginTransaction();

            //CREAR ROL
            $rol = Role::create(['name' => $request->name]);

            //ASIGNAR PERMISOS
             $rol->syncPermissions(array_map(fn($val)=>(int)$val, $request->input('permission')));

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();

            //dd($e);
        }

        return redirect()->route('roles.index')->with('success','Rol registrado');
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
    public function edit(Role $role)
    {
        $permisos = Permission::all();

        return view('rol.edit', compact('role','permisos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id,
            'permission' => 'required'
        ]);

        try{
            DB::beginTransaction();

            //ACTUALIZAR ROL
            Role::where('id',$role->id)
            ->update([
                'name' => $request->name
            ]);

            //ACTUALIZAR LOS PERMISOS
            //$role->syncPermissions($request->permission);

            $role->syncPermissions(array_map(fn($val)=>(int)$val, $request->input('permission')));

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }

        return redirect()->route('roles.index')->with('success','Rol editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::where('id',$id)->delete();

        return redirect()->route('roles.index')->with('success','Rol eliminado');
    }
}
