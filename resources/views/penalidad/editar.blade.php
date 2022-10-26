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
                            <h4>Modificar Penalidades</h4>
                        </div>
                        <form action="{{ route('penalidades.update', $penalidad) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong>Liquidaciones</strong>
                                        {{-- <select class="form-control" name="liquidacion_detalles_id" required>          
                                            @foreach ($penalidads as $penalidad)
                                                <option value="{{ $liquidacione->id }}"
                                                    @if ($liquidacione->id == $liquidacion->liquidaciones_detalle_id) selected @endif>
                                                    {{ $liquidacione->cliente->nombre }}
                                                </option>
                                            @endforeach
                                        </select> --}}
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
                                                
                                                <tbody class="tbody" id="tbody">
                                                    @foreach ($leyes as $ley )
                                                        @if ($ley->elemento->simbolo != 'H2O' && $ley->elemento->simbolo != 'As+Sb' )
                                                        <tr class="ItemElemento">
                                                            <td><button type="button" data-elemento="{{$ley->elemento_id}}"
                                                                class="delete btn btn-danger btn-sm" id="delete" ><i class="fa fa-times fa-2x"></i></button></td>
                                                            <td class="valor"><input type="hidden" id="elemento" name="elemento_id[]"  class="elemen" value="{{$ley->elemento_id}}">{{$ley->elemento->simbolo}}</td><td> <input type="number" name="valor[]" class="form-control"  value="{{$ley->valor}}"></td></td>
                                                        </tr>
                                                        @endif
                                                    @endforeach
                                                    
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
            </div>
        </div>
    </div>
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
        $("tbody tr").each(function(el){
            var tds = $(this).find("td");
            var objeto=tds.find("#elemento").val();
            
            carrito.push(objeto);
        });
        $("tbody tr").each(function(el){
            var tds = $(this).find("button").on("click",eliminar) ;    
        });
        
        
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
            console.log(btnd);
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
            } else {
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

            if (algunoMarcado) {
                $('#glosario').show();
                $('#valoradicional').show();
            } else {
                $('#valoradicional').hide();
                $('#glosario').hide();
            }
        }
    </script>
@endsection
