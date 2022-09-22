<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\elementos;
use App\Models\LiquidacionDetalles;
use App\Models\Termino;
use Illuminate\Http\Request;

class LiquidacionDetallesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('liquidacion_detalles.index');
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
            $results[] = array("elemento" => $request->elemento[$key],
            "libre" => $request->libre[$key],
            "costo" => $request->costo[$key],
            "fraccion" => $request->fraccion[$key],
            "elemento_id" => $request->elemento_id[$key]);
        }
        $proyecto->Penalidades()->createMany($results);

        return redirect()->route('liquidaciones.index');
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
    public function edit(LiquidacionDetalles $liquidacionDetalles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LiquidacionDetalles  $liquidacionDetalles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LiquidacionDetalles $liquidacionDetalles)
    {
        //
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
