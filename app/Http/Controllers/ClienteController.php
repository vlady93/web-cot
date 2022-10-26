<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-cliente')->only('index');
         $this->middleware('permission:crear-cliente', ['only' => ['create','store']]);
         $this->middleware('permission:editar-cliente', ['only' => ['edit','update']]);
         $this->middleware('permission:detalle-cliente', ['only' => ['show']]);
    }
    public function index()
    {
         $datas = Cliente::select('nombre','ap_paterno','ap_materno','ci')->get();;
    
        return view('cliente.index',compact('datas'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create');
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
            'ap_materno' => 'required',
            'ap_paterno' => 'required',
            'ci' => 'required',
        ]);
    
        Cliente::create($request->all());
     
        return redirect()->route('clientes.index')
                        ->with('Exito','Cliente registrado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('cliente.show',compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('cliente.editar',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required',
            'ap_materno' => 'required',
            'ap_paterno' => 'required',
            'ci' => 'required',
        ]);
    
        $cliente->update($request->all());
    
        return redirect()->route('clientes.index')
                        ->with('Exito','Cliente modificado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
    
        return redirect()->route('clientes.index')
                        ->with('Exito','Cliente eliminado correctamente');
    }
}
