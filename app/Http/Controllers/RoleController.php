<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct()
    {
    $this->middleware('permission:ver-rol')->only('index');
         $this->middleware('permission:crear-rol', ['only' => ['create','store']]);
         $this->middleware('permission:editar-rol', ['only' => ['edit','update']]);
         $this->middleware('permission:detalle-rol', ['only' => ['show']]);
         $this->middleware('permission:borrar-rol', ['only' => ['destroy']]);
    }
    public function index()
    {
        $roles=Role::get();
        return view('role.index',compact('roles'));
    }
    public function create()
    {
        $permission=Permission::get();
        return view('roles.crear',compact('permission'));
    }
    public function store(Request $request)
    {
        $this->validate($request,['name' => 'required','permission'=>'required']);
        $role=Role::create(['name'=>$request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index');
    }
    public function show(Role $role)
    {
        return view('role.show', compact('role'));
    }
    public function edit(Role $role)
    {
        $role=Role::find($role->id);
        $permission=Permission::get();
        $rolePermissions =DB::table('role_has_permissions')->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        
        return view('role.edit',compact('role','permission','rolePermissions'));
    }
    public function update(Request $request, Role $role)
    {
        $this->validate($request,['name' => 'required','permission'=>'required']);
        $role=Role::find($role->id);
        $role->name=$request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index');
    }
    public function destroy(Role $role)
    {
        $role->delete();
        return back();
    }
}
