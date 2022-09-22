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
                            <th>Nombre:</th>
                            <td>{{ $clientes->cliente->nombre }} {{ $clientes->cliente->ap_paterno }}
                                {{ $clientes->cliente->ap_paterno }}</td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-md-6 ">
        <div class="table-responsive col-md-6">
            <table id="projectDetails" class="table" border="1" align="center">
                <tbody>
                <tr>
                    <td>
                        <table id="projectDetails">

                            <tbody>
                                <tr><th>PESO NETO HUMEDO</th><td>{{ $liquidacione->tmh }} Kg.</td><td></td></tr>
                                <tr><th>HUMEDAD</th><td>{{ $liquidacione->humedad }} %</td><td></td></tr>
                                <tr>
                                    <td></td>
                                    
                                    <td>{{ round($liquidacione->tmh - $liquidacione->tmh * ($liquidacione->humedad / 100), 3) }}

                                        Kg.</td>
                                    {{ $totms = round($liquidacione->tmh - $liquidacione->tmh * ($liquidacione->humedad / 100), 3) }}
                                    <td></td>
                                </tr>
                                <tr>
                                    <th> Merma</th>
                                    <td>{{ $termino->merma }}%</td>
                                    <td colspan="2">
                                        {{ round((($liquidacione->tmh - $liquidacione->tmh * ($liquidacione->humedad / 100)) * $termino->merma) / 100, 3) }}
                                        Kg.</td>
                                    {{ $totalzz = round((($liquidacione->tmh - $liquidacione->tmh * ($liquidacione->humedad / 100)) * $termino->merma) / 100, 3) }}
                                </tr>
                                <tr>
                                    <th>Peso Pagable </th>
                                    <td></td>
                                    <td colspan="2">
                                        {{ round($liquidacione->tmh - $liquidacione->tmh * ($liquidacione->humedad / 100) - $totalzz, 3) }}
                                        Kg.</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
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

                        <th colspan="5" >PAGOS</th>


                </thead>
                <tbody>
                    <tr><th>Ag Pagable</th><td>{{($vfinalag) }}</td><th>Pb Pagable</th><td>{{($pagable)}}</td><td></td></tr>
                    <tr><th>Precio Pagable</th><td>{{$liquidacione->cot_pb}}</td><th>Precio Pagable</th> <td>{{$liquidacione->cot_ag}}</td><td><strong>TOTAL</strong></td></tr>
                   {{$totalpag=($vfinalag)*$liquidacione->cot_pb}}{{$totalpzn=$pagable*($liquidacione->cot_ag/100)}} {{$totalpagos=$totalpzn+$totalpag}}
                    <tr><th>Total Pagable</th><td>{{($totalpag)}}</td><th>Total Pagable</th><td>{{($totalpzn)}}</td><th>{{round($totalpagos,2)}}</th></tr>
                </tbody>

            </table>
        </div>
    </div>
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
                @if ($liquidacione->cot_ag > $termino->base)
                    <td>{{ $liquidacione->cot_ag - $termino->base }}</td>
                    <td>{{ $terminoe->maquila }}</td>
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
    <table id="projectDetails">
        <thead>
            <tr>

                <th colspan="7" >PENALIDADES</th>
            </tr>

        </thead>
        {{$sumaval=0}}
        {{$sumapenalidades=0}}
        <tbody>
           @foreach ($resultados as $resultado )
               <tr><td>{{$resultado['elemento']}}</td><td>{{$resultado['valor']}}</td><td>{{$resultado['libre']}}</td>
                <td>{{$resultado['penalizable']}}</td><td>{{$resultado['costo']}}</td><td>{{$resultado['fraccion']}}</td>
                <td>{{$sumaval=$resultado['penalizable'] * $resultado['costo'] / $resultado['fraccion']}}</td>
                {{$sumapenalidades+=$sumaval}}
            </tr>
           
            
           @endforeach
<tr><td colspan="6"><td><strong>{{$sumapenalidades}}</strong></td></td></tr>
<tr>
    <th>TOTAL</th>
    <td colspan="5">
        {{ $totalpagos - $sumapenalidades - (($liquidacione->cot_ag - $termino->base) * 0.15 + $termino->maquila) }}
    </td>
</tr>
        </tbody>
    </table>
</body>

</html>
