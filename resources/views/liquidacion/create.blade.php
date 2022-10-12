@extends('layouts.admin')
@section('title', 'Registro de liquidaciones')
@section('styles')
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card card-secondary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 mr-2">
                            <h4>Registro de liquidación</h4>
                        </div>
                        <form action="{{ route('liquidador.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Liquidaciones</strong>
                                        <select class="form-control" name="liquidacion_detalles_id" id="liquidacion_detalles_id">
                                            <option value="" disabled selected>Seleccione Liquidación</option>
                                            @foreach ($liquidaciones as $liquidacion)
                                                <option data-target="{{ $liquidacion->id }}" value="{{ $liquidacion->id }}">
                                                   Liquidación de {{ $liquidacion->cliente->nombre }} {{ $liquidacion->cliente->ap_paterno }} {{ $liquidacion->termino->tipo->nombre}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Nombre Lote:</strong>
                                        <input type="text" name="lote" class="form-control">
                                    </div>
                                </div>


                                <div class="col-xs-2 col-sm-2 col-md-2">
                                    <div class="form-group">
                                        <strong>Oficial Zn/Pb:</strong>
                                        <input type="number" name="cot_ag" step="0.01" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2">
                                    <div class="form-group">
                                        <strong>Oficial Ag:</strong>
                                        <input type="number" name="cot_pb" step="0.01" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2">
                                    <div class="form-group">
                                        <strong>Nacional Zn/Pb:</strong>
                                        <input type="number" name="smc_pb" step="0.01" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-2 col-md-2 col-lg-2">
                                            
                                    <label><strong>Medida</strong></label>
                                    <select class="custom-select" id="inputGroupSelect01" name="medidaznpb">
                                       
                                    <option value="" disabled selected>Seleccione</option>
                                      <option value="1">Lb</option>
                                      <option value="2">Ton</option>
                                    </select>
                                 
                            </div>
                                <div class="col-xs-2 col-sm-2 col-md-2">
                                    <div class="form-group">
                                        <strong>Nacional Ag:</strong>
                                        <input type="number" name="smc_ag" step="0.01" class="form-control">
                                    </div>
                                </div>

                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong>TMH:</strong>
                                        <input type="number" name="tmh" step="0.01" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong>H<small>2</small>O:</strong>
                                        <input type="number" name="humedad" step="0.01" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-3 col-md-3 col-lg-3" >
                                    <br>
                                    <div class="form-check">
                                        <input class="form-check-input miOpcion" type="checkbox" id="defaultCheck3" onclick="formAdicional()">
                                        <label class="form-check-label" for="defaultCheck3">
                                            <strong>Añadir otros Gastos:</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4" id="glosario">
                                    <div class="form-group">
                                        <strong>Glosario:</strong>
                                        <input type="text" name="glosario"class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4" id="valoradicional">
                                    <div class="form-group">
                                        <strong>Monto adicional:</strong>
                                        <input type="number" name="valoradicional" step="0.01" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Elementos</strong>
                                        <select class="form-control" name="elemento_id" id="elemento_id">
                                            <option value="" disabled selected>Seleccione Elemento</option>
                                            @foreach ($elementos as $elemento)
                                                <option data-target="{{ $elemento->id }}" value="{{ $elemento->id }}">
                                                    {{ $elemento->nombre }} {{ $elemento->simbolo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <strong>Valor:</strong>
                                        <input type="number" name="valor" id="valor" step="0.01"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <strong> </strong>
                                        <br>
                                        <button type="button" id="agregar" class="btn btn-primary">Agregar
                                            Elemento</button>
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
            </div></div></div>
            @endsection
            @section('scripts')
                <script>
                    let carrito = ['Elementos']
                    $(document).ready(function() {
                        $("#agregar").click(function() {
                            agregar();
                        });
                    });
                    $("#guardar").hide();
                    $("#elemento_id").change(mostrarValores);

                    function mostrarValores() {
                        datosElementos = document.getElementById('elemento_id').value;

                    }

                    function agregar() {
                        datosElementos = document.getElementById('elemento_id').value;
                        console.log(datosElementos);
                        elemento_id = datosElementos;
                        console.log(elemento_id);
                        elemento = $("#elemento_id option:selected").text();
                        valor = $("#valor").val();
                        console.log(elemento);
                        console.log(carrito);
                        if (elemento_id != " " && elemento_id > 0 && valor != " ") {

                            addCarrito(elemento_id);

                        } else {
                            console.log("Error");
                        }

                        $("#guardar").show();
                    }

                    /*  */

                    function eliminar(e) {
                        const btnd = e.target
                        const tr = btnd.closest('.ItemElemento')
                        const obtner = tr.querySelector('.elemen').value;
                        console.log(obtner)
                        for (let i = 0; i < carrito.length; i++) {
                            if (carrito[i] === obtner) {
                                carrito.splice(i, 1)

                            }
                        }
                        tr.remove()
                        console.log(carrito)
                    }

                    function addCarrito(elemento_id) {
                        for (let i = 0; i < carrito.length; i++) {
                            if (carrito[i] === elemento_id) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Oops...',
                                    text: 'Ya registro ese Obrero. !!',

                                })

                                return null;
                            }
                        }
                        carrito.push(elemento_id);

                        renderCarrito();
                    }

                    function renderCarrito() {
                        console.log("Ingreso con exito");
                        const tabletr = document.createElement('tr');
                        tabletr.classList.add('ItemElemento')
                        const cart =
                            `<td><button type="button" data-elemento=${elemento_id}
                 class="delete btn btn-danger btn-sm" ><i class="fa fa-times fa-2x"></i></button></td>
                <td class="valor"><input type="hidden" id="elemento" name="elemento_id[]" class="elemen" value=${elemento_id}>${elemento}</td><td> <input type="hidden" name="valor[]" value=${valor}>${valor} </td>`;
                        tabletr.innerHTML = cart;
                        $('#detalles').append(tabletr)
                        tabletr.querySelector('.delete').addEventListener('click', eliminar)
                    }
                </script>

<script>
    $("#refinacion").hide();
function destino() {
 var url = document.getElementById('tipo_id').value

 if (url != "2") {
   $("#refinacion").show();
 }else{
   $("#refinacion").hide();
 }
}
</script>
<script>
   $("#valoradicional").hide();
   $("#glosario").hide();
    function formAdicional() {
  var elementos = $('input.miOpcion');
  var algunoMarcado = elementos.toArray().find(function(elemento) {
     return $(elemento).prop('checked');
  });
  
  if(algunoMarcado) {
    $('#glosario').show();
    $('#valoradicional').show();
  } else {
    $('#valoradicional').hide();
    $('#glosario').hide();
  }
}
</script>
            @endsection
