<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\elementos;
use App\Models\LiquidacionDetalles;
use App\Models\Penalidad;
use App\Models\Termino;
use Illuminate\Http\Request;

class LiquidacionDetallesController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-penalidad')->only('index');
         $this->middleware('permission:crear-penalidad', ['only' => ['create','store']]);
         $this->middleware('permission:editar-penalidad', ['only' => ['edit','update']]);
         $this->middleware('permission:detalle-penalidad', ['only' => ['show']]);
    }
    public function index()
    {
        $liquidacionDetalles=LiquidacionDetalles::get();
        return view('liquidacion_detalles.index',compact('liquidacionDetalles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $terminos=Termino::get();
        $clientes=Cliente::get();
        $elementos=elementos::get();
        return view('liquidacion_detalles.create',compact('terminos','clientes','elementos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $input = $request->all();
        $proyecto = LiquidacionDetalles::create($input);
        foreach ($request->elemento_id as $key => $valor) {
            $results[] = array(
            "libre" => $request->libre[$key],
            "costo" => $request->costo[$key],
            "fraccion" => $request->fraccion[$key],
            "elemento_id" => $request->elemento_id[$key]);
        }
        $proyecto->Penalidades()->createMany($results);

        return redirect()->route('liquidacions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LiquidacionDetalles  $liquidacionDetalles
     * @return \Illuminate\Http\Response
     */
    public function show(LiquidacionDetalles $liquidacionDetalles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LiquidacionDetalles  $liquidacionDetalles
     * @return \Illuminate\Http\Response
     */
    public function edit(LiquidacionDetalles $liquidacion_detalle)
    {
        $terminos=Termino::get();
        $clientes=Cliente::get();
        $elementos=elementos::get();
        $penalidads=Penalidad::where('penalidads.liquidacion_detalles_id',$liquidacion_detalle->id)->get();
        return view('liquidacion_detalles.editar',compact('terminos','clientes','elementos','liquidacion_detalle','penalidads'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LiquidacionDetalles  $liquidacionDetalles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LiquidacionDetalles $liquidacion_detalle)
    {
        $input = $request->all();
        $borrar=Penalidad::where('penalidads.liquidacion_detalles_id',$liquidacion_detalle->id);
        $liquidacion_detalle->Penalidades()->delete($borrar); 
        foreach ($request->elemento_id as $key => $valor) {
            $results[] = array(
            "libre" => $request->libre[$key],
            "costo" => $request->costo[$key],
            "fraccion" => $request->fraccion[$key],
            "elemento_id" => $request->elemento_id[$key]);
        }
        $liquidacion_detalle->Penalidades()->createMany($results);
        $liquidacion_detalle->update($input);
        return redirect()->route('liquidacion_detalles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LiquidacionDetalles  $liquidacionDetalles
     * @return \Illuminate\Http\Response
     */
    public function destroy(LiquidacionDetalles $liquidacionDetalles)
    {
        //
    }
}
