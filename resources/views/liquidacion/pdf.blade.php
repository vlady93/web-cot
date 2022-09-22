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
            padding: 8px;
        }

        th {
            border: 1px solid #dddddd;
            text-align: left;
            font-size: 11px;
            padding: 8px;
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
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title font-weight-bold p-3 mb-2 bg-dark text-white text-center" align="center">
                        LIQUIDACION DE PROFORMA</h3>
                    <table border="1" id="" class="ml-4 " align="center">
                        <tbody>
                            <tr id="" class="">
                                <th>Cliente:</th>
                                <td>{{ $termino->cliente->nombre }} {{ $termino->cliente->ap_paterno }}</td>
                                <th>Lote:</th>
                                <td>{{ $liquidacion->lote }}</td>
                            </tr>
                            <tr id="" class="">
                            <tr id="" class="">
                                <th>Cotización PB:</th>
                                <td>{{ $liquidacion->cot_pb }} </td>
                                <th> PB:</th>
                                <td>{{ $liquidacion->cot_pb }} </td>
                            </tr>
                            <tr id="" class="">
                            <tr id="" class="">

                                <th>Cotización AG:</th>
                                <td>{{ $liquidacion->cot_ag }}</td>
                                <th> AG:</th>
                                <td>{{ $liquidacion->cot_ag }}</td>
                            </tr>
                            </tr>
                            </tr>
                        </tbody>
                  
                    </table>
                    <div class="form-group col-md-6 ">
                        <div class="table-responsive col-md-6">
                            <table id="projectDetails" class="table" border="1" align="center">
                                
                                <tbody>
                                    <tr>
                                        <td colspan="3">
                                            <table id="projectDetails">

                                                <tbody>
                                                    <tr><th>PESO NETO HUMEDO</th><td>{{ $liquidacion->tmh }} Kg.</td></tr>
                                                    <tr><th>HUMEDAD</th><td>{{ $liquidacion->humedad }} %</td></tr>
                                                    <tr>
                                                        <td></td>
                                                        
                                                        <td>{{ round($liquidacion->tmh - $liquidacion->tmh * ($liquidacion->humedad / 100), 3) }}

                                                            Kg.</td>
                                                        {{ $totms = round($liquidacion->tmh - $liquidacion->tmh * ($liquidacion->humedad / 100), 3) }}
                                                        <td>
                                                    </tr>
                                                    <tr>
                                                        <th> Merma</th>
                                                        <td>{{ $termino->merma }}%</td>
                                                        <td colspan="2">
                                                            {{ round((($liquidacion->tmh - $liquidacion->tmh * ($liquidacion->humedad / 100)) * $termino->merma) / 100, 3) }}
                                                            Kg.</td>
                                                        {{ $totalzz = round((($liquidacion->tmh - $liquidacion->tmh * ($liquidacion->humedad / 100)) * $termino->merma) / 100, 3) }}
                                                    </tr>
                                                    <tr>
                                                        <th>Peso Pagable </th>
                                                        <td></td>
                                                        <td colspan="2">
                                                            {{ round($liquidacion->tmh - $liquidacion->tmh * ($liquidacion->humedad / 100) - $totalzz, 3) }}
                                                            Kg.</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>

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
                        </div>
                    </div>
                    <div class="form-group col-md-6 ">
                        <div class="table-responsive col-md-6">
                            <table id="projectDetails" class="table" border="1" align="center">
                                <thead>
                                    <tr>

                                        <th colspan="5">PAGOS</th>


                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Ag Pagable</th>
                                        <td>{{ $vfinalag }}</td>
                                        <th>Zn Pagable</th>
                                        <td>{{ $pagable }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Precio Pagable</th>
                                        <td>{{ $liquidacion->cot_pb }}</td>
                                        <th>Precio Pagable</th>
                                        <td>{{ $liquidacion->cot_ag }}</td>
                                        <td><strong>TOTAL</strong></td>
                                    </tr>
                                    {{ $totalpag = $vfinalag * $liquidacion->cot_pb }}{{ $totalpzn = $pagable * ($liquidacion->cot_ag / 100) }}
                                    {{ $totalpagos = $totalpzn + $totalpag }}
                                    <tr>
                                        <th>Total Pagable</th>
                                        <td>{{ round($totalpag, 2) }}</td>
                                        <th>Total Pagable</th>
                                        <td>{{ round($totalpzn, 2) }}</td>
                                        <th>{{ round($totalpagos, 2) }}</th>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="form-group col-md-6 ">
                        <div class="table-responsive col-md-6">
                            <table id="projectDetails" class="table" border="1" align="center">
                                <thead>
                                    <tr>

                                        <th>PENALIDADES</th>
                                        <th>VALOR</th>
                                        <th>lIBRE</th>
                                        <th>PENALIZABLE</th>
                                        <th>COSTO</th>
                                        <th>FRACCIÓN</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    {{ $totalpen = 0 }}
                                    {{ $totalli = 0 }}
                                    {{ $totallinea = 0 }}
                                    @foreach ($penalidades as $penalidad)
                                        <tr>
                                            <td>{{ $penalidad->ele }}</td>
                                            <td>{{ $penalidad->elemento }}</td>
                                            <td>{{ $penalidad->libre }}</td>

                                            @if ($penalidad->ele === 'Zn')
                                                @if ($penalidad->elemento < $penalidad->libre)
                                                    {{ $totalli = $penalidad->libre - $penalidad->elemento }}
                                                    <td>{{ $penalidad->libre - $penalidad->elemento }}</td>
                                                @else
                                                    <td>0</td>
                                                @endif
                                            @elseif ($penalidad->elemento > $penalidad->libre)
                                                @if ($penalidad->ele === 'H2O')
                                                    {{ $totalli = 1 }}
                                                    <td>1</td>
                                                @else
                                                    {{ $totalli = $penalidad->elemento - $penalidad->libre }}
                                                    <td>{{ $penalidad->elemento - $penalidad->libre }}</td>
                                                @endif
                                            @else
                                                <td>0</td>
                                                {{-- @elseif($penalidad->elemento > $penalidad->libre)
                                                    {{$totalli=$penalidad->elemento-$penalidad->libre}}
                                                     <td>{{$penalidad->elemento-$penalidad->libre}}</td>
                                                     @else
                                                     <td>0</td> --}}
                                            @endif


                                            {{ $penalidad->elemento - $penalidad->libre }}<td>{{ $penalidad->costo }}
                                            </td>
                                            <td>{{ $penalidad->fraccion }}</td>
                                            <td>{{ ($totalli * $penalidad->costo) / $penalidad->fraccion }}</td>
                                        </tr>
                                        {{ $totallinea = ($totalli * $penalidad->costo) / $penalidad->fraccion }}
                                        {{ $totalpen += $totallinea }}
                                        {{ $totalli = 0 }}
                                    @endforeach
                                    <tr>
                                        <td>TOTAL:</td>
                                        <td colspan="6"> <strong>{{ $totalpen }}</strong></td>
                                    </tr>

                                </tbody>
                            </table>
                            </td>
                            </tr>


                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group col-md-6 ">
                        <div class="table-responsive col-md-6">
                            <table id="projectDetails" class="table" border="1" align="center">
                                <thead>
                                    <tr>

                                        <th colspan="6">Gastos de tratamiento</th>


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
                                        @if ($liquidacion->cot_ag > $termino->base)
                                            <td>{{ $liquidacion->cot_ag - $termino->base }}</td>
                                            <td>{{ $termino->maquila }}</td>
                                            <td>{{ ($liquidacion->cot_ag - $termino->base) * 0.15 }}</td>
                                            <td>{{ ($liquidacion->cot_ag - $termino->base) * 0.15 + $termino->maquila }}
                                            </td>
                                        @else
                                            <td>0</td>
                                            <td>0</td>
                                        @endif
                                        {{ ($totalgt = $liquidacion->cot_ag - $termino->base) * 0.15 + $termino->maquila }}
                                    </tr>
                                    <tr>
                                        <th>TOTAL</th>
                                        <td colspan="5">
                                            {{ $totalpagos - $totalpen - (($liquidacion->cot_ag - $termino->base) * 0.15 + $termino->maquila) }}
                                        </td>
                                    </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
