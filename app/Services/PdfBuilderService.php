<?php

namespace App\Services;

use App\Models\leyes;
use App\Models\liquidacion;
use App\Models\LiquidacionDetalles;
use App\Models\Penalidad;
use Illuminate\Support\Collection;

class PdfBuilderService
{

    public function elemento($liquidacion): string
    {
        $clientes = LiquidacionDetalles::where('id', $liquidacion->id)->first();
        $valorag = leyes::join('elementos', "elementos.id", "=", "leyes.elemento_id")
            ->where('liquidacion_id', $liquidacion->id)
            ->where('elementos.nombre', 'Plata')
            ->select('leyes.valor')
            ->first();


        $valoragoz = $valorag->valor / 31.1035;
        $valoragm = $valoragoz - $clientes->termino->valorag;
        $vfinalag = $valoragm * ($clientes->termino->porcentag / 100);

        return number_format($vfinalag, 10);
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
                            'totalrow'=> ($ley->valor - $penalidad->libre)*$penalidad->costo/$penalidad->fraccion
                        ]);
                    }else{
                        $resultado->push([
                            'elemento' => $penalidad->simbolo, 'valor' => $ley->valor,
                            'libre' => $penalidad->libre, 'costo' => $penalidad->costo,
                            'fraccion' => $penalidad->fraccion,
                            'penalizable' => 0,
                            'totalrow'=> 0]);
                    }
                }
            }
        }
        return $resultado;
    }
}
