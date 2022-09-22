@extends('layouts.admin')
@section('title', 'Gestión de clientes')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
@section('content')
    <div class="details col-lg-12">
        <div class="recentOrders ">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            
        </div>
    </div>
    
    

    <div class="details">
        <div class="recentOrders">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="cardHeader">
                        <h2>Registro de Liquidación</h2>
                        <a class="btn btn-primary" href=""> Volver</a>

                    </div>
                </div>
            </div>


            <form action="{{ route('penalidades.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>Elementos</strong>
                            <select class="form-control" name="liquidacion_id" id="liquidacion_id">
                                <option value="" disabled selected>Seleccionar</option>
                                @foreach ($liquidaciones as $liquidacion)
                                    @if ($liquidacion->simbolo != 'As' and
                                        $liquidacion->simbolo != 'Sb' and
                                        $liquidacion->simbolo != 'Pb' and
                                        $liquidacion->simbolo != 'Ag')
                                        <option
                                            value="{{ $liquidacion->id }}_{{ $liquidacion->valor }}_{{ $liquidacion->id_li }}">
                                            {{ $liquidacion->simbolo }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2>
                        <div class="form-group">
                        <strong>Valor:</strong>
                        <input type="text" name="valor" id="valor" class="form-control">
                    </div>
                    <div hidden class="col-xs-2 col-sm-2 col-md-2>
                            <div class="form-group">
                        <input type="hidden" name="id_li" id="id_li" class="form-control">
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>Libre:</strong>
                            <input type="number" name="libre" id="libre" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>Costo:</strong>
                            <input type="number" name="costo" id="costo" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>Fracción:</strong>
                            <input type="number" name="fraccion" id="fraccion" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong> </strong>
                            <br>
                            <button type="button" id="agregar" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <h4 class="card-title">Listado de Elemetos</h4>
                        <div class="table-responsive col-md-12">
                            <table id="detalles" class="table">
                                <thead>
                                    <tr>
                                        <th>Eliminar</th>
                                        <th>Elemento añadido</th>
                                        <th>Valor</th>
                                        <th>Libre</th>
                                        <th>Costo</th>
                                        <th>Fracción</th>
                                    </tr>
                                </thead>
                                <tfoot>

                                </tfoot>
                                <tbody class="tbody" id="tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" id="guardar"class="btn btn-primary">Registrar</button>
                </div>
        </div>


        </form>
    </div>
    </div>

    {{-- <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="table-responsive col-md-12">
                            <table id="detalles" class="table">
                                <thead>
                                    <tr>
                                        <th>Ensayo</th>
                                        <th>Valor</th>
                                        <th>Libre</th>
                                        <th>Penalizable</th>
                                        <th>Fracción</th>
                                    </tr>
                                </thead>
                                
                                <tbody class="tbody" id="tbody">
                                    <tr><th><input hidden type="text" name="elemento[]" value="{{$vasbs}}">{{$vasbs}}</th><td>{{$suma}}</td><td> <input type="number"step="0.01"  name="libre[]"> </td>
                                        <td> <input type="number" step="0.01"  name="costo[]"> </td>
                                        <td> <input type="number" step="0.01"  name="fraccion[]"> </td><td ><input type="text" hidden name ="liquidacion_id[]"value="{{$id_liqui}} "></td></tr>
                                    @foreach ($liquidaciones as $liquidacion)
                                    @if ($liquidacion->simbolo != 'As' and $liquidacion->simbolo != 'Sb')
                                    <tr><th> <input hidden type="text" name="elemento[]" value="{{$liquidacion->simbolo}}"> {{$liquidacion->simbolo}}</th><td>{{$liquidacion->valor}}</td><td> <input type="number" step="0.01"  name="libre[]"> </td>
                                        <td> <input type="number" step="0.01"  name="costo[]"> </td>
                                        <td> <input type="number" step="0.01"  name="fraccion[]"> </td><td > <input type="text" hidden name ="liquidacion_id[]" value="{{$id_liqui}}"> </td></tr>          
                                    @endif
                                  
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </div> --}}

    </div>

@endsection
@endsection
@section('scripts')
<script>
    let carrito = ['Penalidades']
    $(document).ready(function() {
        $("#agregar").click(function() {
            agregar();
        });
    });
    var cont = 1;

    $("#guardar").hide();
    $("#liquidacion_id").change(mostrarValores);

    function mostrarValores() {
        datosPenalidad = document.getElementById('liquidacion_id').value.split('_');
        $("#valor").val(datosPenalidad[1]);
        $("#id_li").val(datosPenalidad[2]);
    }

    function agregar() {
        datosPenalidad = document.getElementById('liquidacion_id').value.split('_');
        liquidacion_id = datosPenalidad[0];
        penalidad = $("#liquidacion_id option:selected").text();
        valor = $("#valor").val();
        id_li = $("#id_li").val();
        libre = $("#libre").val();
        costo = $("#costo").val();
        fraccion = $("#fraccion").val();

        console.log(carrito);
        if (liquidacion_id != "" && valor >= 0 && libre >= 0 && costo >= 0 && fraccion >= 0) {
            addCarrito(liquidacion_id);
        } else {
            Swal.fire({
                type: 'error',
                text: 'Rellene todos los campos del detalle de la venta.',
            })
        }
    }

    /*  function limpiar() {
         $("#cantidad").val("");
         $("#discount").val("0");
     }

     function totales() {
         $("#total").html("Bs.- " + total.toFixed(2));

         total_pagar = total;
         $("#total_pagar_html").html("Bs.- " + total_pagar.toFixed(2));
         $("#total_pagar").val(total_pagar.toFixed(2));
     }

     function evaluar() {
         if (total > 0) {
             $("#guardar").show();
         } else {
             $("#guardar").hide();
         }
     } */

    /* function eliminar(index) {
        total = total - subtotal[index];

        total_pagar_html = total
        $("#total").html(total);
        $("#total_pagar_html").html(total_pagar_html);
        $("#total_pagar").val(total_pagar_html.toFixed(2));
        $("#fila" + index).remove();
        evaluar();
    } */
    function eliminar(e) {
        const btnd = e.target
        const tr = btnd.closest('.ItemMaterial')
        const obtner = tr.querySelector('.obre').value;
        const index = tr.querySelector('.index').value;
        console.log(obtner)
        for (let i = 0; i < carrito.length; i++) {
            if (carrito[i] === obtner) {
                carrito.splice(i, 1)

            }
        }
        total = total - subtotal[index];
        console.log(typeof(subtotal[index]))
        totalg = total.toFixed(2);
        console.log(totalg)
        total_pagar_html = totalg;
        console.log(typeof(total))
        $("#total").html(totalg);
        $("#total_pagar_html").html(total_pagar_html);
        $("#total_pagar").val(total_pagar_html);
        tr.remove()
        console.log(carrito)
        evaluar();
    }

    function addCarrito(liquidacion_id) {
        for (let i = 0; i < carrito.length; i++) {
            if (carrito[i] === liquidacion_id) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Ya registro ese Material. !!',

                })

                return null;
            }
        }
        carrito.push(liquidacion_id);

        renderCarrito();
    }

    function renderCarrito() {
        const tabletr = document.createElement('tr');
        tabletr.classList.add('ItemMaterial')
        const cart =
       `<td><button type="button" class="btn delete btn-danger btn-sm"><i class="fa fa-times fa-2x"></i></button></td>
        <td><input type="hidden" name="liquidacion_id[]" class="obre" value=${liquidacion_id}>${penalidad}</td> 
        <td><input type="hidden" name="id_li[]" class="obre" value=${id_li}></td>
        <td><input type="hidden" name="elemento[]  class="obre" value=${valor}><input class="form-control" type="number" step="0.01" value=${parseFloat(valor).toFixed(2)} disabled> </td>
        <td> <input type="hidden" name="libre[]" value=${parseFloat(libre).toFixed(2)}>  <input class="form-control" type="number" value=${parseFloat(libre).toFixed(2)} disabled> </td>
        <td> <input type="hidden" name="costo[]" value=${parseFloat(costo).toFixed(2)}>  <input class="form-control" type="number" value=${parseFloat(costo).toFixed(2)} disabled> </td>
        <td> <input type="hidden" name="fraccion[]" value=${parseFloat(fraccion).toFixed(2)}>  <input class="form-control" type="number" value=${parseFloat(fraccion).toFixed(2)} disabled> </td>
        <td><input type="hidden" name="index" class="index" value=${cont}></td>`;
        tabletr.innerHTML = cart;

        tabletr.querySelector('.delete').addEventListener('click', eliminar)
        cont++;

        $('#detalles').append(tabletr)
        $("#guardar").show();
    }
</script>

@endsection
