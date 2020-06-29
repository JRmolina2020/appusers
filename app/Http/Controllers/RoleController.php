<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {;
        if (!$request->ajax()) return redirect('/');
        $roles = Role::with('permissions:id,name')->orderBy('id', 'desc')->get();
        return response()->json($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $roles = Role::create([
            'name' => $request['name'],

        ]);
        return response()->json(['message' => 'El rol ha sido creado'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $roles = Role::find($id);
        $roles->fill([
            'name' => request('name'),
        ])->save();
        $roles->syncPermissions($request['permissions']);
        return response()->json(['message' => 'El rol ha sido modificado'], 201);
    }
}