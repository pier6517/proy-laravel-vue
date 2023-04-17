<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RolController extends Controller
{
    function __construct()
    
    {
        $this->middleware('permission:ver-rol|crear-rol|editar-rol|borrar-rol',['only'=>['index']]);
        $this->middleware('permission:crear-rol',['only'=>['create','store']]);
        $this->middleware('permission:editar-rol',['only'=>['edit','update']]);
        $this->middleware('permission:borrar-rol',['only'=>['destroy']]);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles =Role::all();
        
        return view('dashboard.roles.index',['roles' => $roles]);

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission=Permission::get();
        return view('dashboard.roles.create',['permission'=>$permission]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required','permission' =>'required']);
        $role= Role::create(['name'=>$request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index');

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
    public function edit($id)
    {
        $role = Role::find($id);
        $permission=Permission::get();
        $rolePermissions=DB::table('role_has_permissions')->where('role_has_permissions.role_id',$id)
        
        //metodo plunk, recupera todos lso valores de clave determinada  $id
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();
        return view('dashboard.roles.edit',compact('role','permission','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name'=>'required',
            'permission'=>'required'
        ]);

        $role= Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rol=Role::find($id);
        $encontro=$rol->users->count(); 
        if ($encontro==0){
        DB::table('roles')->where('id',$id)->delete();
        return redirect()->route('roles.index');
        } else {
            return redirect()->route('roles.index')->with('error' , 'este rol no puede ser eliminado');
            

        }

    }
}
