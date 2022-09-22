<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\liquidacion;
use App\Models\Termino;
use App\Models\Tipo;
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
        if ($request->peso ==='1') {
            $valorplata=$request->valorag/31.1035;# code...
        }else{
            $valorplata=$request->valorag;
        }
        
        $input = $request->all()+['valorag'=>$valorplata];
        
        Termino::create(['valorag'=>$valorplata,]+$input);     

        return redirect()->route('terminos.index');
    }
}
