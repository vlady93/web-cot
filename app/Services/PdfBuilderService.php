<?php

namespace App\Services;

use App\Models\leyes;
use App\Models\liquidacion;
use App\Models\LiquidacionDetalles;
use App\Models\Penalidad;
use App\Models\Termino;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PdfBuilderService
{

    public function calcularAg($liquidacion): string
    {
        $valorag = leyes::join('elementos', "elementos.id", "=", "leyes.elemento_id")
            ->where('liquidacion_id', $liquidacion->id)
            ->where('elementos.nombre', 'Plata')
            ->select('leyes.valor')
            ->first();
        $termino = Termino::join('liquidacion_detalles','liquidacion_detalles.termino_id','terminos.id')
        ->where('liquidacion_detalles.id',$liquidacion->liquidacion_detalles_id)->first();
        $valoragoz = $valorag->valor / 31.1035;
        $valoragm = $valoragoz - $termino->valorag;
        $vfinalag = $valoragm * ($termino->porcentag / 100);
        
        if($valoragoz > $termino->minimoag){
            $vfinalag=$vfinalag;
        }else{
            $vfinalag=0;
        }
        return number_format($vfinalag, 10);
    }
    public function calcularZinc($liquidacion){
        $valorzn=leyes::join('elementos',"elementos.id","=","leyes.elemento_id")
        ->where('liquidacion_id',$liquidacion->id)
        ->where('elementos.nombre','Zinc')
        ->select('leyes.valor as val')
        ->first();
        
        $vfinalzn=(($valorzn->val)-8);
        
        $znpagable=$valorzn->val*0.85;
       
        if($vfinalzn>$znpagable){
            $pagable=$znpagable;
        }else{
            $pagable=$vfinalzn;
        } 
        return $pagable;
    }
    public function CalcularPlomo($liquidacion){
        $valorzn=leyes::join('elementos',"elementos.id","=","leyes.elemento_id")
        ->where('liquidacion_id',$liquidacion->id)
        ->where('elementos.nombre','Plomo')
        ->select('leyes.valor as val')
        ->first();
        
        $vfinalzn=(($valorzn->val)-3);
        
        $znpagable=$vfinalzn*0.95;
       
        if($vfinalzn>$znpagable){
            $pagable=$znpagable;
        }else{
            $pagable=$vfinalzn;
        } 
        return $pagable;
    }

    public function calculoPenalidades($liquidacion): object
    {
        $resultado = collect();
        $leyes = leyes::join('liquidacions', 'liquidacions.id', 'leyes.liquidacion_id')->where('liquidacions.liquidacion_detalles_id', '6')->get();
        $penalidades = Penalidad::join('liquidacion_detalles', 'liquidacion_detalles.id', 'penalidads.liquidacion_detalles_id')
            ->join('elementos', 'elementos.id', 'penalidads.elemento_id')
            ->where('liquidacion_detalles.id', $liquidacion->liquidacion_detalles_id)->get();

        foreach ($penalidades as  $penalidad) {
            foreach ($leyes as $ley) {
                if ($penalidad->simbolo === $ley->elemento->simbolo) {
                    if ($ley->valor > $penalidad->libre) {
                        $resultado->push([
                            'elemento' => $penalidad->simbolo, 'valor' => $ley->valor,
                            'libre' => $penalidad->libre, 'costo' => $penalidad->costo,
                            'fraccion' => $penalidad->fraccion,
                            'penalizable' => $ley->valor - $penalidad->libre,
                            'totalrow' => ($ley->valor - $penalidad->libre) * $penalidad->costo / $penalidad->fraccion
                        ]);
                    } else {
                        $resultado->push([
                            'elemento' => $penalidad->simbolo, 'valor' => $ley->valor,
                            'libre' => $penalidad->libre, 'costo' => $penalidad->costo,
                            'fraccion' => $penalidad->fraccion,
                            'penalizable' => 0,
                            'totalrow' => 0
                        ]);
                    }
                }
            }
        }
        return $resultado;
    }
    public function calculoPenalidadesZn($liquidacion): object
    {
        $resultado = collect();
        /* $valores=Penalidad::join('liquidacion_detalles','liquidacion_detalles.id','penalidads.liquidacion_detalles_id')
        ->join('liquidacions','liquidacions.liquidacion_detalles_id','liquidacion_detalles.id')
        ->join('leyes','leyes.liquidacion_id','liquidacions.id')
        ->join('elementos','elementos.id','leyes.elemento_id')
        ->orWhere('elementos.id','penalidads.elemento_id')
        ->where('liquidacion_detalles.id','3');
        dd($valores); */

        $valores=DB::select('select elementos.simbolo,leyes.valor , penalidads.libre, penalidads.costo 
        , penalidads.fraccion 
        from penalidads 
        inner join liquidacion_detalles on liquidacion_detalles.id = penalidads.liquidacion_detalles_id 
        inner join liquidacions on liquidacions.liquidacion_detalles_id = liquidacion_detalles.id 
        inner join leyes on leyes.liquidacion_id = liquidacions.id 
        inner join elementos on elementos.id = leyes.elemento_id 
        where leyes.elemento_id=penalidads.elemento_id and liquidacion_detalles.id = ?',[$liquidacion->liquidacion_detalles_id]);

        foreach ($valores as  $valor) {
            if($valor->simbolo === 'Zn'){
                if($valor->libre > $valor->valor){
                    $resultado->push([
                        'elemento' => $valor->simbolo, 'valor' => $valor->valor,
                        'libre' => $valor->libre, 'costo' => $valor->costo,
                        'fraccion' => $valor->fraccion,
                        'penalizable' => $valor->libre - $valor->valor,
                        'totalrow' => ($valor->valor - $valor->libre) * $valor->costo / $valor->fraccion
                    ]);
                }else{
                    $resultado->push([
                        'elemento' => $valor->simbolo, 'valor' => $valor->valor,
                        'libre' => $valor->libre, 'costo' => $valor->costo,
                        'fraccion' => $valor->fraccion,
                        'penalizable' => 0,
                        'totalrow' => 0
                    ]);
                }
            }
            if($valor->simbolo === 'H2O'){
                if($valor->libre < $valor->valor){
                    $resultado->push([
                        'elemento' => $valor->simbolo, 'valor' => $valor->valor,
                        'libre' => $valor->libre, 'costo' => $valor->costo,
                        'fraccion' => 1,
                        'penalizable' =>1,
                        'totalrow' => ($valor->valor - $valor->libre) * 10.50 / 1
                    ]);
                }else{
                    $resultado->push([
                        'elemento' => $valor->simbolo, 'valor' => $valor->valor,
                        'libre' => $valor->libre, 'costo' => $valor->costo,
                        'fraccion' => $valor->fraccion,
                        'penalizable' => 0,
                        'totalrow' => 0
                    ]);
                }
            }
            if($valor->simbolo !='Zn'&&$valor->simbolo !='H2O'){
                if ($valor->valor > $valor->libre && $valor->simbolo != 'Zn' && $valor->simbolo != 'H2O') {
                    $resultado->push([
                        'elemento' => $valor->simbolo, 'valor' => $valor->valor,
                        'libre' => $valor->libre, 'costo' => $valor->costo,
                        'fraccion' => $valor->fraccion,
                        'penalizable' => $valor->valor - $valor->libre,
                        'totalrow' => ($valor->valor - $valor->libre) * $valor->costo / $valor->fraccion
                    ]);
                } else {
                    $resultado->push([
                        'elemento' => $valor->simbolo, 'valor' => $valor->valor,
                        'libre' => $valor->libre, 'costo' => $valor->costo,
                        'fraccion' => $valor->fraccion,
                        'penalizable' => 0,
                        'totalrow' => 0
                    ]);
                }
     
            }
            
        }
            
        return $resultado;
    }
    public function calcularEmpresa($empresa): string{
        $valorempresa=0;
            if($empresa > 0){
                $valorempresa=$empresa;
         }  else{
                $valorempresa;
         }
         return $valorempresa;
    }
}
