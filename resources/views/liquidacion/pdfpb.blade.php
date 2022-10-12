<!DOCTYPE>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td {
            border: 1px solid #dddddd;
            text-align: left;
            font-size: 11px;
            padding: 4px;
        }

        td.resultado {
            border: 1px solid #dddddd;
            text-align: right;
            font-size: 11px;
            padding: 4px;
        }

        th {
            border: 1px solid #dddddd;
            text-align: left;
            font-size: 11px;
            padding: 4px;
        }

        tr.res {
            border: 1px solid #000000;
            text-align: right;
            font-size: 11px;
            padding: 4px;
            background-color: #cde3f7
        }

        thead {
            border: 2px solid #dddddd;
            background: #cde3f7;

        }

        h3 {
            color: #f7f1f1;
            font-weight: normal;
            font-size: 20px;
            font-family: sans-serif;
            background-color: #416f99;
        }
    </style>
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Reporte de Proyecto</title>

<body>
    {{-- Tabla de Datos de Cliente --}}
    <h3 class="card-title font-weight-bold p-3 mb-2 bg-dark text-white text-center" align="center">
        LIQUIDACION PROVISIONAL</h3>
    <table border="1" id="" class="ml-4 " align="center">
        <tbody>
            <tr>
                <th>CLIENTE:</th>
                <td>{{ $clientes->cliente->nombre }} {{ $clientes->cliente->ap_paterno }}
                    {{ $clientes->cliente->ap_paterno }}</td>
                <th>LOTE:</th>
                <td>{{ $liquidacione->lote }}</td>
            </tr>
            <tr>
                <th>COTIZACION Pb:</th>
                <td>{{ $liquidacione->cot_ag }}</td>
                <td></td>
                <td>{{ $liquidacione->smc_pb }}</td>
            </tr>
            <tr>
                <th>COTIZACION Ag:</th>
                <td>{{ $liquidacione->cot_pb }}</td>
                <td></td>
                <td>{{ $liquidacione->smc_ag }}</td>
            </tr>
        </tbody>
    </table>
    {{-- Tabla de Pagos Humedad Peso Neto --}}

    <table id="projectDetails" class="table" border="1" align="center">
        <tbody>
            <tr>
                <td>{{-- Tabla de calculo de la humedad --}}
                    <table id="projectDetails">
                        <tbody>
                            <tr>
                                <th>PESO NETO HUMEDO</th>
                                <td>{{ $liquidacione->tmh }} Kg.</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>HUMEDAD</th>
                                <td>{{ $liquidacione->humedad }} %</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>{{ $liquidacione->tmh - $liquidacione->tmh * ($liquidacione->humedad / 100) }}
                                    Kg.</td>
                                <td></td>
                            </tr>
                            {{ $totms = $liquidacione->tmh - $liquidacione->tmh * ($liquidacione->humedad / 100) }}
                            <tr>
                                <th> MERMA</th>
                                <td>{{ $termino->merma }}%</td>
                                <td>{{ (($liquidacione->tmh - $liquidacione->tmh * ($liquidacione->humedad / 100)) * $termino->merma) / 100 }}Kg.
                                </td>
                            </tr>
                            {{ $totalzz = (($liquidacione->tmh - $liquidacione->tmh * ($liquidacione->humedad / 100)) * $termino->merma) / 100 }}
                            <tr>
                                <th>Peso Pagable </th>
                                <td></td>
                                <td>{{ $liquidacione->tmh - $liquidacione->tmh * ($liquidacione->humedad / 100) - $totalzz }}
                                    Kg.</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td>{{-- Tabla de detalle de leyes --}}
                    <table id="projectDetails">
                        <tbody>
                            @foreach ($leyes as $leye)
                                @if ($leye->elemento->simbolo != 'H2O' && $leye->elemento->simbolo != 'As+Sb')
                                    <tr>
                                        <td>{{ $leye->elemento->simbolo }}</td>
                                        <td>{{ $leye->valor }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    {{-- Tabla de Pagos de Ag y Zn --}}
    <table id="projectDetails" class="table" border="1" align="center">
        <tbody>
            <tr>
                <th colspan="7">VALORACION DE PLATA/TON</th>
            </tr>
            <tr>
                <th>Ag.</th>
                <td>{{ $valorag->valor / 31.1035 }}</td>
                <td>{{ $termino->valorag }}</td>
                <td>{{ $valorag->valor / 31.1035 - $termino->valorag }}</td>
                <td>{{ $termino->porcentag }} %</td>
                <td>{{ $vfinalag }}</td>
                {{ $totalpag = $vfinalag * $liquidacione->cot_pb }}
                <td class="resultado"><strong>{{ $totalpag1 = round($totalpag,2)}}</strong></td>
            </tr>
            <tr>
                <th colspan="7">VALORACION DE PLOMO/TON</th>
            </tr>
            <tr>
                <th>Pb.</th>
                <td>{{ $valorpb->valor }}</td>
                <td>3 </td>
                <td>{{ $valorpb->valor - 3 }}</td>
                <td>{{ $termino->porcentag }} %</td>
                <td>{{ $pagable }}</td>
                {{ $totalpzn = $pagable * ($liquidacione->cot_ag / 100) }}
                <td class="resultado"><strong>{{$totalpzn1=round($totalpzn,2)}}</strong></td>
            </tr>

            {{ $totalpag = $vfinalag * $liquidacione->cot_pb }}{{ $totalpzn = $pagable * ($liquidacione->cot_ag / 100) }}
            {{ $totalpagos = $totalpzn + $totalpag }}
            <tr>
                <th>TOTAL PAGOS</th>
                <td class="resultado" colspan="5">US$</td>
                <td class="resultado"><strong>{{ $totalpagos1=round($totalpagos,2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <table id="projectDetails" class="table" border="1" align="center">
        <tbody>
            {{ $totalgt = 0 }}
            <tr>
                <th colspan="5">MAQUILA</th>
            </tr>
            <tr>
                <td>ACTUAL</td>
                <td>BASE</td>
                <td>ACT-BASE</td>
                <td>PENALIDAD</td>
                <td></td>
            </tr>
            <tr>
                <td>{{ $liquidacione->cot_ag }}</td>
                <td>{{ $termino->base }}</td>
                @if ($liquidacione->cot_ag > $termino->base)
                    <td>{{ $liquidacione->cot_ag - $termino->base }}</td>
                    <td>{{ $termino->escalador }}</td>
                    {{$maquila=($liquidacione->cot_ag - $termino->base) * 0.15 + $termino->maquila }} 
                    <td class="resultado">
                       
                        <strong>{{ $maquila1=round($maquila,2)}}</strong>
                    </td>
                @else
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                @endif
            </tr>

            {{ ($totalgt = $liquidacione->cot_ag - $termino->base) * 0.15 + $termino->maquila }}

            <tr>
                <th colspan="5">REFINACION PLATA</th>
            </tr>
            <tr>
                <td></td>
                <td>{{ $valorag->valor / 31.1035 }}</td>
                <td>{{ $termino->refincaion }}</td>
                {{ $refinacion = ($termino->refincaion * $valorag->valor) / 31.1035 }}
                <td colspan="3" class="resultado">
                    <strong>{{$refinacion1=round($refinacion,2)}}</strong>
                </td>
            </tr>
        </tbody>

    </table>
    {{-- Tabla de penalidades --}}
    <table id="projectDetails">
        <tr><th colspan="7">PENALIDADES</th></tr>
        {{ $sumaval = 0 }}
        {{ $sumapenalidades = 0 }}
        <tbody>
            @foreach ($resultados as $resultado)
                <tr>
                    <td>{{ $resultado['elemento'] }}</td>
                    <td>{{ $resultado['valor'] }}</td>
                    <td>{{ $resultado['libre'] }}</td>
                    <td>{{ $resultado['penalizable'] }}</td>
                    <td>{{ $resultado['costo'] }}</td>
                    <td>{{ $resultado['fraccion'] }}</td>
                    <td>{{ $sumaval = ($resultado['penalizable'] * $resultado['costo']) / $resultado['fraccion'] }}
                    </td>
                    {{ $sumapenalidades += $sumaval }}
                </tr>
            @endforeach
            <tr>
                <td colspan="6">
                <td class="resultado"><strong>{{ $sumapenalidades }}</strong></td>
                </td>
            </tr>
            <tr>
                <td>VALOR POR TMS</td>
                
                {{ $totalportonelada = $totalpagos - $refinacion - $sumapenalidades - (($liquidacione->cot_ag - $termino->base) * 0.15 + $termino->maquila) }}
                <td colspan="6" class="resultado"><strong>
                        {{ $totalpagos1 = round($totalportonelada,2) }}</strong>
                </td>
                {{ $totalgastos = $totalpagos - $refinacion - $sumapenalidades - (($liquidacione->cot_ag - $termino->base) * 0.15 + $termino->maquila) }}
            </tr>
        </tbody>
    </table>
    {{-- Total por Tonelada --}}
    <table id="projectDetails" class="table" border="1" align="center">
        <tbody>
            {{ $totalportonelada = $liquidacione->tmh - $liquidacione->tmh * ($liquidacione->humedad / 100) - $totalzz }}
            <tr class="res">
                <th><strong>VALOR BRUTO</strong></th>
                {{ $valorbruto = $totalportonelada * $totalgastos }}
                <td class="resultado"><strong>{{ $valorbruto1 = round($valorbruto,2) }}</strong></td>
            </tr>
        </tbody>
    </table>
    {{-- Valor de Flete Rollback --}}
    <table id="projectDetails" class="table" border="1" align="center">
        
        <tbody>
            <tr>
                <th>FLETE</th>
                <td>$us {{ $termino->flete }}</td>
                
                {{ $finflete = $liquidacione->tmh * $termino->flete }}
                <td  colspan="5" class="resultado">{{ $finflete1 = $finflete }}</td>
            </tr>
            <tr>
                <th>ROLLBACK</th>
                <td>$us {{ $termino->rollback }}</td>
                
                {{ $finrollback = $liquidacione->tmh * $termino->rollback }}
                <td colspan="5" class="resultado">{{ $finrollback1 = $finrollback }}</td>
            </tr>
            <tr class="res">
                <th >VALOR BRUTO DE COMPRA</th>
                {{ $valorneto = $valorbruto - $liquidacione->tmh * $termino->flete - $liquidacione->tmh * $termino->rollback }}
                <td class="resultado" colspan="6"><strong>{{ $valorneto1 =round ($valorneto,2) }}</strong>
                </td>
            </tr>
        </tbody>
    </table>
    {{-- Tabla de Regalias --}}
    <table id="projectDetails" class="table" border="1" align="center">
        <tbody>
            <tr>
                <td>REGALIAS Pb. </td>
                <td>3,00 %</td>
                <td class="resultado">{{ $regAg = 0.03 * $liquidacione->smc_pb * ($valorpb->valor / 100) * $totms }}</td>
            </tr>
            <tr>
                <td>REGALIAS Ag.</td>
                <td> 3,60 %</td>
                <td class="resultado">{{ $regZn = 0.036 * $liquidacione->smc_ag * ($valorag->valor / 31.1035) * $totms }}</td>
            </tr>
            {{ $regaliaAg = 0.06 * $liquidacione->smc_ag * ($valorag->valor / 31.1035) * $totms }}
            {{ $regaliaZn = 0.05 * $liquidacione->smc_pb * ($valorpb->valor / 100) * $totms }}
            {{ $fincomibol = $valorbruto * $comibol }}
            @if ($comibol > 0)
                <tr>
                    <td>COMIBOL</td>
                    <td>{{ $comibol  }} %</td>
                    <td class="resultado">{{ $valorbruto * $comibol/100 }}</td>

                </tr>
            @endif
            {{ $finfedecomin = $valorneto * $fedecomin/100 }}
            @if ($fedecomin > 0)
                <tr>
                    <td>FEDECOMIN</td>
                    <td>{{ $fedecomin  }} %</td>
                    <td class="resultado">{{ $valorneto * $fedecomin/100 }}</td>
                </tr>
            @endif
            {{ $finfencomin = $valorneto * $fencomin/100 }}
            @if ($fencomin > 0)
                <tr>
                    <td>FENCOMIN</td>
                    <td>{{ $fencomin  }} %</td>
                    <td class="resultado">{{ $valorneto * $fencomin/100 }}</td>
                </tr>
            @endif
            @if ($termino->caja > 0)
                <tr>
                    <td>CAJA</td>
                    <td>{{ $termino->caja  }} %</td>
                    <td class="resultado">{{ $caja = $valorbruto * $termino->caja/100 }}</td>
                </tr>
            @endif

            @if ($liquidacione->valoradicional > 0)
                <tr>
                    <td>{{ $liquidacione->glosario }}</td>
                    <td></td>
                    <td class="resultado">{{ $liquidacione->valoradicional }}</td>
                </tr>
            @endif
            <tr>
                <td>GASTOS DE EXPORTACION</td>
                <td></td>
                <td class="resultado">{{ $finrealizacion = $valorbruto * $termino->remesa + ($regaliaAg - $regAg) + ($regaliaZn - $regZn) + 350 }}
                </td>
            </tr>
            <tr>
                <td>TOTAL DESCUENTOS</td>
                <td colspan="2" class="resultado">
                    {{ $totaldescuentos = $caja + $finflete + $finrollback + $regAg + $regZn + $fincomibol + $finfedecomin + $finfencomin + $finrealizacion + $liquidacione->valoradicional }}
                </td>
            </tr>
            <tr></tr>
            <tr class="res">
                <th>VALOR NETO PAGABLE </th>
                <td colspan="2" class="resultado"><strong>{{ $valortotal = $valorbruto - $totaldescuentos }}</strong></td>
            </tr>
            <tr>
                <td>PAGABLE AL {{$termino->pagable}} %</td>
                <td colspan="2" class="resultado">{{ round(($valortotal * $termino->pagable/ 100),2) }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
