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

                        <form action="{{ route('liquidador.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Elementos</strong>
                                        <select class="form-control" name="liquidacion_detalles_id" id="liquidacion_detalles_id">
                                            <option value="" disabled selected>Seleccione Elemento</option>
                                            @foreach ($liquidaciones as $liquidacion)
                                                <option data-target="{{ $liquidacion->id }}" value="{{ $liquidacion->id }}">
                                                    {{ $liquidacion->id }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="lote"class="font-weight-bold">Nombre Lote:</label>
                                        <input type="text" name="lote" class="form-control">
                                    </div>
                                </div>


                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <strong>Cotización Nacional Zn:</strong>
                                        <input type="number" name="cot_ag" step="0.01" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-34">
                                    <div class="form-group">
                                        <strong>Cotización Nacional Ag:</strong>
                                        <input type="number" name="cot_pb" step="0.01" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <strong>Cotización Oficial Zn:</strong>
                                        <input type="number" name="smc_pb" step="0.01" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <strong>Cotización Oficial Ag:</strong>
                                        <input type="number" name="smc_ag" step="0.01" class="form-control">
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>TMH:</strong>
                                        <input type="number" name="tmh" step="0.01" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>H<small>2</small>O:</strong>
                                        <input type="number" name="humedad" step="0.01" class="form-control">
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




            @endsection
