<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\elementos;
use App\Models\leyes;
use App\Models\liquidacion;
use App\Models\LiquidacionDetalles;
use App\Models\Penalidad;
use App\Models\Termino;
use App\Services\PdfBuilderService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LiquidacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $liquidacions=LiquidacionDetalles::join('liquidacions','liquidacions.liquidacion_detalles_id','liquidacion_detalles.id')->get();
        return view('liquidacion.index',compact('liquidacions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $liquidaciones=LiquidacionDetalles::get();
        $elementos=elementos::get();
        
        return view('liquidacion.create', compact('liquidaciones','elementos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        if ($request->medidaznpb ==='1') {
            $nacional=$request->smc_pb*2204.62;
        }else{
            $nacional=$request->smc_pb;
        }

        $input = $request->all();
        $input['fecha']= Carbon::now('America/Lima');
        $humedad=elementos::where("nombre","humedad")->select("id")->first();
        $as=elementos::where("nombre","Arsenico")->select("id")->first();
        $sb=elementos::where("nombre","Antimonio")->select("id")->first();
        $assb=elementos::where("simbolo","As+Sb")->select("id")->first();
        $hume=$humedad['id'];
        $results[] = ['elemento_id' => $hume,'valor'=> $request->humedad];
        
        $proyecto = liquidacion::create(['smc_pb'=>$nacional]+$input);
        foreach ($request->elemento_id as $key => $valor) {
            $results[] = array("elemento_id" => $request->elemento_id[$key],
            "valor" => $request->valor[$key]);
        }
        $suma=0;
        foreach($results as $res){
            if($res['elemento_id'] === strval($as['id'])|| $res['elemento_id'] === strval($sb['id']) ){
                $suma=$suma+$res['valor'];
            }
        }
        $results[] = ['elemento_id' => $assb['id'],'valor'=> $suma];
        $proyecto->LeyesDetalle()->createMany($results);
        LiquidacionDetalles::where('id',$request->liquidacion_detalles_id)->update(array('estado'=>'PROVISIONAL'));
        

        return redirect()->route('liquidador.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function show( $liquidacion)
    {
        $liquidaciones = liquidacion::join("leyes","leyes.liquidacion_id","=","liquidacions.id")
        ->join("elementos","elementos.id","=","leyes.elemento_id")
        ->select("elementos.simbolo","leyes.valor","liquidacions.id as id_li","elementos.id")
        ->where("liquidacions.id","=" ,$liquidacion)
        ->get();
        $id_liqui=$liquidacion;
  
        return view('liquidacion.show', compact('liquidaciones','id_liqui'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function edit( liquidacion $liquidacion)
    {
        
        $liquidaciones=LiquidacionDetalles::get();
        $elementos=elementos::get();
        $leyes=leyes::where('leyes.liquidacion_id',$liquidacion->id)->get();
        return view('liquidacion.editar', compact('liquidaciones','elementos','liquidacion','leyes'));
       
    }

   
    
    public function update(Request $request, liquidacion $liquidacion)
    {
        $liquidacion->upadte($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(liquidacion $liquidacion)
    {
        //
    }
    public function PagableZn($liquidacion){

    }
    public function pdf(liquidacion $liquidacion)
    {
        $liquidacion=liquidacion::where('id',$liquidacion->id)->first();
        $leyes=leyes::where('liquidacion_id',$liquidacion->id)->get();
        $termino=Termino::join("liquidacions","liquidacions.termino_id","=","terminos.id")
        ->where("terminos.id",$liquidacion->id)->first();
       
        $penalidades=Penalidad::join("elementos","elementos.id","=","penalidads.elemento_id")
        ->where('liquidacion_id',$liquidacion->id)
        ->select('elementos.simbolo as ele','elemento','libre','costo','fraccion')
        ->get();
        
        
        $pagable=0;
        $valorzn=leyes::join('elementos',"elementos.id","=","leyes.elemento_id")
        ->where('liquidacion_id',$liquidacion->id)
        ->where('elementos.nombre','Zinc')
        ->select('leyes.valor')
        ->first();
        $vfinalzn=(($valorzn->valor)-8);
        
        $znpagable=$valorzn->valor*0.85;
       
        if($vfinalzn>$znpagable){
            $pagable=$znpagable;
        }else{
            $pagable=$vfinalzn;
        }
        $valorag=leyes::join('elementos',"elementos.id","=","leyes.elemento_id")
        ->where('liquidacion_id',$liquidacion->id)
        ->where('elementos.nombre','Plata')
        ->select('leyes.valor')
        ->first();
       ;
        
        $valoragoz=$valorag->valor/31.1035;
        $valoragm=$valoragoz-$termino->valorag;
        $vfinalag=$valoragm*($termino->porcentag/100);
       
        $pdf = Pdf::loadView('liquidacion.pdf', compact('liquidacion','leyes','termino','penalidades','pagable','vfinalag'));

        return $pdf->stream('Reporte_de_compraf');
    }
    public function pdfpb(liquidacion $liquidacion)
    {
        $liquidacion=liquidacion::where('id',$liquidacion->id)->first();
        $leyes=leyes::where('liquidacion_id',$liquidacion->id)->get();
        $termino=Termino::join("liquidacions","liquidacions.termino_id","terminos.id")
        ->where("terminos.id",$liquidacion->id)->first();
        
       $penalidades=Penalidad::join("elementos","elementos.id","=","penalidads.elemento_id")
        ->where('liquidacion_id',$liquidacion->id)
        ->select('elementos.simbolo as ele','elemento','libre','costo','fraccion')
        ->get();
        $pagable=0;
        $valorzn=leyes::join('elementos',"elementos.id","=","leyes.elemento_id")
        ->where('liquidacion_id',$liquidacion->id)
        ->where('elementos.nombre','Plomo')
        ->select('leyes.valor')
        ->first();

        $vfinalpb=(($valorzn->valor)-3);
        
        $znpagable=$vfinalpb*0.95;
       
        if($vfinalpb>$znpagable){
            $pagable=$znpagable;
        }else{
            $pagable=$vfinalpb;
        }
        $valorag=leyes::join('elementos',"elementos.id","=","leyes.elemento_id")
        ->where('liquidacion_id',$liquidacion->id)
        ->where('elementos.nombre','Plata')
        ->select('leyes.valor')
        ->first();
      
        
        $valoragoz=$valorag->valor/31.1035;
        $valoragm=$valoragoz-$termino->valorag;
        $vfinalag=$valoragm*($termino->porcentag/100);
        

        //refinacion
        
       
        $pdf = Pdf::loadView('liquidacion.pdfpb', compact('liquidacion','leyes','termino','penalidades','pagable','vfinalag','valoragoz'));

        return $pdf->stream('Reporte_de_compraf');
    }
    public function pruebapdf(liquidacion $liquidacion,PdfBuilderService $pdfBuilderService)
    {   
        $clientes=LiquidacionDetalles::where('id',$liquidacion->id)->first();
        $leyes=leyes::join('liquidacions','liquidacions.id','leyes.liquidacion_id')
               ->where('liquidacions.liquidacion_detalles_id',$liquidacion->liquidacion_detalles_id)->get();
        $termino=Termino::join('liquidacion_detalles','liquidacion_detalles.termino_id','terminos.id')
        ->where('liquidacion_detalles.id',$liquidacion->liquidacion_detalles_id)->first();
        $liquidacione=liquidacion::where('liquidacion_detalles_id',$liquidacion->liquidacion_detalles_id)->first();
        $valorag = leyes::join('elementos', "elementos.id", "=", "leyes.elemento_id")
            ->where('liquidacion_id', $liquidacion->id)
            ->where('elementos.nombre', 'Plata')
            ->select('leyes.valor')
            ->first();
        $valorzn=leyes::join('elementos',"elementos.id","=","leyes.elemento_id")
            ->where('liquidacion_id',$liquidacion->id)
            ->where('elementos.nombre','Zinc')
            ->select('leyes.valor as val')
            ->first();
        $comibol=$pdfBuilderService->calcularEmpresa($termino->comibol);
        $fedecomin=$pdfBuilderService->calcularEmpresa($termino->fedecomin);
        $fencomin=$pdfBuilderService->calcularEmpresa($termino->fencomin);
        $pagable=$pdfBuilderService->calcularZinc($liquidacion);
        $vfinalag=$pdfBuilderService->calcularAg($liquidacion);
        $resultados=$pdfBuilderService->calculoPenalidadesZn($liquidacion);
      
        $pdf = Pdf::loadView('liquidacion.pruebapdf',compact('leyes','clientes','pagable','vfinalag','liquidacione','resultados','termino','valorag','valorzn','comibol','fedecomin','fencomin'));

        return $pdf->stream('Reporte_de_compraf');
    }
    public function pruebapdf1(liquidacion $liquidacion,PdfBuilderService $pdfBuilderService)
    {   
        $clientes=LiquidacionDetalles::where('id',$liquidacion->id)->first();
        $leyes=leyes::join('liquidacions','liquidacions.id','leyes.liquidacion_id')
               ->where('liquidacions.liquidacion_detalles_id',$liquidacion->liquidacion_detalles_id)->get();
        $termino=Termino::join('liquidacion_detalles','liquidacion_detalles.termino_id','terminos.id')
        ->where('liquidacion_detalles.id',$liquidacion->liquidacion_detalles_id)->first();
        $liquidacione=liquidacion::where('liquidacion_detalles_id',$liquidacion->liquidacion_detalles_id)->first();
        $valorag=$pdfBuilderService->valor($liquidacion,'Plata');  
        $valorpb=$pdfBuilderService->valor($liquidacion,'Plomo');  
        $comibol=$pdfBuilderService->calcularEmpresa($termino->comibol);
        $fedecomin=$pdfBuilderService->calcularEmpresa($termino->fedecomin);
        $fencomin=$pdfBuilderService->calcularEmpresa($termino->fencomin);
        $pagable=$pdfBuilderService->calcularPlomo($liquidacion);
        $vfinalag=$pdfBuilderService->calcularAg($liquidacion);
        $resultados=$pdfBuilderService->calculoPenalidades($liquidacion);
        
      
        $pdf = Pdf::loadView('liquidacion.pdfpb',compact('leyes','clientes','pagable','vfinalag','liquidacione','resultados','termino','valorag','valorpb','comibol','fedecomin','fencomin'));

        return $pdf->stream('Reporte_de_compraf');
    }

}
