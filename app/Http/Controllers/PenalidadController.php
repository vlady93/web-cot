<?php

namespace App\Http\Controllers;

use App\Models\liquidacion;
use App\Models\Penalidad;
use Illuminate\Http\Request;

class PenalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penalidad.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    $results=[];
    foreach ($request->liquidacion_id as $key => $id_liqui) {
            $results[] = array( "elemento" => $request->elemento[$key],
            "libre" => $request->libre[$key],
            "costo" => $request->costo[$key],
            "fraccion" => $request->fraccion[$key],
            "liquidacion_id" => $request->id_li[$key],
            "elemento_id" => $request->liquidacion_id[$key],);
        }
       
        Penalidad::insert($results);  

        return redirect()->route('liquidaciones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penalidad  $penalidad
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penalidad  $penalidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Penalidad $penalidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penalidad  $penalidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penalidad $penalidad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penalidad  $penalidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penalidad $penalidad)
    {
        //
    }
}
