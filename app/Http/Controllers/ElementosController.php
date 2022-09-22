<?php

namespace App\Http\Controllers;

use App\Models\elementos;
use Illuminate\Http\Request;

class ElementosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('elemento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'simbolo' => 'required',
            
        ]);
    
        elementos::create($request->all());
     
        return redirect()->route('terminos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\elementos  $elementos
     * @return \Illuminate\Http\Response
     */
    public function show(elementos $elementos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\elementos  $elementos
     * @return \Illuminate\Http\Response
     */
    public function edit(elementos $elementos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\elementos  $elementos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, elementos $elementos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\elementos  $elementos
     * @return \Illuminate\Http\Response
     */
    public function destroy(elementos $elementos)
    {
        //
    }
}
