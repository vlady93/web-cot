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

        tr {}

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
        LIQUIDACION DE PROFORMA</h3>
    <table border="1" id="" class="ml-4 " align="center">
        <tbody>
            <th>Nombre:</th>
            <td>{{ $clientes->cliente->nombre }} {{ $clientes->cliente->ap_paterno }}
                {{ $clientes->cliente->ap_paterno }}</td>
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
                                <td>{{ round($liquidacione->tmh - $liquidacione->tmh * ($liquidacione->humedad / 100), 3) }}
                                    Kg.</td>
                                <td></td>
                            </tr>
                            {{ $totms = round($liquidacione->tmh - $liquidacione->tmh * ($liquidacione->humedad / 100), 3) }}
                            <tr>
                                <th> Merma</th>
                                <td>{{ $termino->merma }}%</td>
                                <td>{{ round((($liquidacione->tmh - $liquidacione->tmh * ($liquidacione->humedad / 100)) * $termino->merma) / 100, 3) }}Kg.
                                </td>
                            </tr>
                            {{ $totalzz = round((($liquidacione->tmh - $liquidacione->tmh * ($liquidacione->humedad / 100)) * $termino->merma) / 100, 3) }}
                            <tr>
                                <th>Peso Pagable </th>
                                <td></td>
                                <td>{{ round($liquidacione->tmh - $liquidacione->tmh * ($liquidacione->humedad / 100) - $totalzz, 3) }}
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
        <thead>
            <tr>
                <th colspan="5">PAGOS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Ag Pagable</th>
                <td>{{ $vfinalag }}</td>
                <th>Pb Pagable</th>
                <td>{{ $pagable }}</td>
                <td></td>
            </tr>
            <tr>
                <th>Precio Pagable</th>
                <td>{{ $liquidacione->cot_pb }}</td>
                <th>Precio Pagable</th>
                <td>{{ $liquidacione->cot_ag }}</td>
                <td><strong>TOTAL</strong></td>
            </tr>
            {{ $totalpag = $vfinalag * $liquidacione->cot_pb }}{{ $totalpzn = $pagable * ($liquidacione->cot_ag / 100) }}
            {{ $totalpagos = $totalpzn + $totalpag }}
            <tr>
                <th>Total Pagable</th>
                <td>{{ $vfinalag * $liquidacione->cot_pb }}</td>
                <th>Total Pagable</th>
                <td>{{ $totalpzn }}</td>
                <th>{{ round($totalpagos, 2) }}</th>
            </tr>
        </tbody>
    </table>

    <table id="projectDetails" class="table" border="1" align="center">
        <thead>
            <tr><th colspan="6">Gastos de tratamiento</th></tr>
        </thead>
        <tbody>
            {{ $totalgt = 0 }}
            <tr>
                <th>MAQUILA</th>
                <th>Base</th>
                <th>Dif</th>
                <th>Costo</th>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>Escalador</th>
                <td>{{ $termino->base }}</td>
                @if ($liquidacione->cot_ag > $termino->base)
                    <td>{{ $liquidacione->cot_ag - $termino->base }}</td>
                    <td>{{ $termino->maquila }}</td>
                    <td>{{ ($liquidacione->cot_ag - $termino->base) * 0.15 }}</td>
                    <td>{{ ($liquidacione->cot_ag - $termino->base) * 0.15 + $termino->maquila }}
                    </td>
                @else
                    <td>0</td>
                    <td>0</td>
                @endif
                {{ ($totalgt = $liquidacione->cot_ag - $termino->base) * 0.15 + $termino->maquila }}
            </tr>
        </tbody>

    </table>
    {{-- Tabla de penalidades --}}
    <table id="projectDetails">
        <thead>
            <tr><th colspan="7">PENALIDADES</th></tr>
        </thead>
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
                    <td>{{ $sumaval = ($resultado['penalizable'] * $resultado['costo']) / $resultado['fraccion'] }}</td>
                    {{ $sumapenalidades += $sumaval }}
                </tr>
            @endforeach
            <tr>
                <td colspan="6">
                <td><strong>{{ $sumapenalidades }}</strong></td>
                </td>
            </tr>
            <tr>
                <th>TOTAL</th>
                <td></td>
                <td colspan="5">
                    {{ $totalpagos - $sumapenalidades - (($liquidacione->cot_ag - $termino->base) * 0.15 + $termino->maquila) }}
                </td>
                {{ $totalgastos = $totalpagos - $sumapenalidades - (($liquidacione->cot_ag - $termino->base) * 0.15 + $termino->maquila) }}
            </tr>
        </tbody>
    </table>
    {{-- Total por Tonelada --}}
    <table id="projectDetails" class="table" border="1" align="center">
        <tbody>
            {{ $totalportonelada = round($liquidacione->tmh - $liquidacione->tmh * ($liquidacione->humedad / 100) - $totalzz, 3) }}
            <tr>
                <th>Total por Tonelada</th>
                <td>{{ $valorbruto = $totalportonelada * $totalgastos }}</td>
            </tr>
        </tbody>
    </table>
    {{-- Valor de Flete Rollback --}}
    <table id="projectDetails" class="table" border="1" align="center">
        <thead>
            <th colspan="3">VALOR</th>
            <td>{{ $valorneto=$valorbruto- ($liquidacione->tmh * $termino->flete) - ($liquidacione->tmh * $termino->rollback) }}
            </td>
        </thead>
        <tbody>
            <tr>
                <th>Flete</th>
                <td>$us {{ $termino->flete }}</td>
                <td>TMH {{ $liquidacione->tmh }}</td>
                <td>{{$finflete= $liquidacione->tmh * $termino->flete }}</td>
            </tr>
            <tr>
                <th>Rollback</th>
                <td>$us {{ $termino->rollback }}</td>
                <td>TMH {{ $liquidacione->tmh }}</td>
                <td>{{ $finrollback=$liquidacione->tmh * $termino->rollback }}</td>
            </tr>
        </tbody>
    </table>
    {{-- Tabla de Regalias --}}
    <table id="projectDetails" class="table" border="1" align="center">
        <thead>
            <th colspan="3">REGALIAS</th>
        </thead>
        <tbody>
            <tr>
                <th>Regalias Zn </th>
                <td>3,00%</td>
                <td>{{ $regAg = 0.03 * $liquidacione->smc_pb * ($valorzn->val / 100) * $totms }}</td>
            </tr>
            <tr>
                <th>Regalias Ag</th>
                <td> 3,60%</td>
                <td>{{ $regZn = 0.036 * $liquidacione->smc_ag * ($valorag->valor / 31.1035) * $totms }}</td>
            </tr>
            {{ $regaliaAg = 0.06 * $liquidacione->smc_ag * ($valorag->valor / 31.1035) * $totms }}
            {{ $regaliaZn = 0.05 * $liquidacione->smc_pb * ($valorzn->val / 100) * $totms }}
            {{$fincomibol=$valorbruto*$comibol}}
            @if($comibol>0)
            <tr>
                <td>Comibol</td><td>{{$comibol}}</td><td>{{$valorbruto*$comibol}}</td>
              
            </tr>
            @endif
            {{$finfedecomin=$valorneto*$fedecomin}}
            @if($fedecomin>0)
            <tr>
                <td>Fedecomin</td><td>{{$fedecomin}}</td><td>{{$valorneto*$fedecomin}}</td>
            </tr>
            @endif
            {{$finfencomin=$valorneto*$fencomin}}
            @if($fencomin>0)
            <tr>
                <td>Fedecomin</td><td>{{$fencomin}}</td><td>{{$valorneto*$fencomin}}</td>
            </tr>
            @endif
            @if($termino->caja > 0)
            <tr>
                <td>Caja</td><td>{{$termino->caja*100}} %</td><td>{{$caja=$valorbruto*$termino->caja}}</td>
            </tr>
            @endif
            @if($liquidacione->valoradicional > 0)
            <tr>
                <td>{{$liquidacione->glosario}}</td><td></td><td>{{$liquidacione->valoradicional}}</td>
            </tr>
            @endif
            <tr>
                <th>Gastos de Exportación</th>
                <td></td>
                <td>{{$finrealizacion= $valorbruto * $termino->remesa + ($regaliaAg - $regAg) + ($regaliaZn - $regZn) }}</td>
            </tr>
            <tr>
                <td>Descuentos</td><td colspan="2">{{$totaldescuentos=$caja+$finflete+$finrollback+$regAg+$regZn+$fincomibol+$finfedecomin+$finfencomin+$finrealizacion+$liquidacione->valoradicional}}</td>
            </tr>
            <tr></tr>
            <tr>
                <td>Valor neto pagable: </td><td colspan="2">{{$valortotal=$valorbruto-$totaldescuentos}}</td>
            </tr>
            <tr>
                <td>{{$valortotal*$termino->pagable/100}}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
