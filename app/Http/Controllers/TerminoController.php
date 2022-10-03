<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Termino;
use App\Models\Tipo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TerminoController extends Controller
{
    public function index(){
        
        $terminos=Termino::get();
        return view('termino.index',compact('terminos'));
    }

    public function create()
    {
        $clientes=Cliente::get();
        $tipos=Tipo::get();
        return view('termino.create',compact('clientes','tipos'));
    }
    public function store(Request $request)
    {
        $valorplata=0;
        $valorminimoplata=0;
        $date=Carbon::now('America/Lima');
        if ($request->medida ==='1') {
            $valorminimoplata=$request->minimoag/31.1035;# code...
        }else{
            $valorminimoplata=$request->minimoag;
        }
        if ($request->peso ==='1') {
            $valorplata=$request->valorag/31.1035;# code...
        }else{
            $valorplata=$request->valorag;
        }
        $valorremesa=$request->remesa/100;
        $input = $request->all();
        $input['nombre'] = 'Termino '.$request->nombre.' '.$date->format('d-M-Y');
        Termino::create(['valorag'=>$valorplata,'minimoag'=>$valorminimoplata,'remesa'=>$valorremesa]+$input);     

        return redirect()->route('terminos.index');
    }
}
