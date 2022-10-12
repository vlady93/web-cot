@extends('layouts.admin')
@section('title', 'Registro de Terminos')
@section('styles')

@section('content')
    <div class="section-body">
        <form action="{{ route('terminos.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3>Registro de Terminos</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="row">
                                <div class="form-group col-6 col-md-6 col-lg-6">
                                    <label for="tipo_id">Tipo de Material</label>
                                    <select class="form-control" name="tipo_id" id="tipo_id" required
                                        onchange="destino()">
                                        <option value="" disabled selected>Selecccione Material</option>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-4 col-md-4 col-lg-4">
                                    <label><strong>Nombre de Termino:</strong></label>
                                    <input type="text" name="nombre" class="form-control" required>
                                </div>
                            </div>
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h4>Peso</h4>
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="form-group col-4 col-md-4 col-lg-4">
                                            <label><strong>Merma</strong></label>
                                            <input type="number" name="merma" class="form-control" required=""
                                                placeholder="%">
                                        </div>

                                        <div class="form-group col-4 col-md-4 col-lg-4">
                                            <label><strong>Deducción Unitaria Ag</strong></label>
                                            <input type="number" name="valorag" step="0.01" class="form-control"
                                                required="" placeholder="Gr/Oz">

                                        </div>
                                        <div class="form-group col-4 col-md-4 col-lg-4">

                                            <label><strong>Medida</strong></label>
                                            <select class="custom-select" id="inputGroupSelect01" name="peso">

                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">Gramos</option>
                                                <option value="2">Onzas</option>
                                            </select>

                                        </div>
                                        <div class="form-group col-4 col-md-4 col-lg-4">
                                            <label><strong> Porcentaje Pagable Ag</strong></label>
                                            <input type="number" name="porcentag" class="form-control" required=""
                                                placeholder="%">
                                        </div>
                                        <div class="form-group col-4 col-md-4 col-lg-4">
                                            <label><strong>Valor Minimo Ag</strong></label>
                                            <input type="number" name="minimoag" step="0.01" class="form-control"
                                                required="" placeholder="Gr/Oz">

                                        </div>
                                        <div class="form-group col-4 col-md-4 col-lg-4">

                                            <label><strong>Medida</strong></label>
                                            <select class="custom-select" id="inputGroupSelect01" name="medida">

                                                <option value="" disabled selected>Seleccione</option>
                                                <option value="1">Gramos</option>
                                                <option value="2">Onzas</option>
                                            </select>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Gastos de Tratamiento</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-4 col-md-4 col-lg-4">
                                            <label><strong>Maquila</strong></label>
                                            <input type="number" step="0.01" name="maquila" class="form-control"
                                                required="">
                                        </div>
                                        <div class="form-group col-4 col-md-4 col-lg-4">
                                            <label><strong>Base</strong></label>
                                            <input type="number" name="base" class="form-control" required="">
                                        </div>
                                        <div class="form-group col-4 col-md-4 col-lg-4">
                                            <label><strong>Escalador</strong></label>
                                            <input type="number" name="escalador" step="0.01"class="form-control"
                                                required="">
                                        </div>
                                    </div>

                                    <div class="row" id="refinacion">
                                        <div class="card-footer">
                                            <h6 class="text-dark">Refinación</h6>
                                            <div class="form-group">
                                                <label><strong>Costo</strong></label>
                                                <input type="number" name="refincaion" class="form-control" step="0.01">
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Transporte y Manipuleoo</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-4 col-md-4 col-lg-4">
                                            <label><strong>Flete</strong></label>
                                            <input type="number" name="flete" class="form-control" required=""
                                                step="0.01">
                                        </div>
                                        <div class="form-group col-4 col-md-4 col-lg-4">
                                            <label><strong>Rollback</strong></label>
                                            <input type="number" name="rollback" class="form-control" required=""
                                                step="0.01">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Descunetos Nacionales</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-2 col-md-2 col-lg-2">
                                            <div class="form-check">
                                                <input class="form-check-input miOpcion" type="checkbox" id="defaultCheck1" onclick="formComibol()">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Comibol
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-2 col-md-2 col-lg-2"id="comibol">
                                            <input type="number" name="comibol" class="form-control" value="1"
                                                step="0.01">
                                        </div>
                                        

                                        <div class="form-group col-2 col-md-2 col-lg-2">
                                            <div class="form-check">
                                                <input class="form-check-input miFedecomin" type="checkbox" id="defaultCheck2"
                                                      onclick="formFedecomin()">
                                                <label class="form-check-label" for="defaultCheck2">
                                                    Fedecomin
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-2 col-md-2 col-lg-2"id="fedecomin">
                                            <input type="number" name="fedecomin" class="form-control" value="1"
                                                step="0.01">
                                        </div>
                                        <div class="form-group col-2 col-md-2 col-lg-2">
                                            <div class="form-check">
                                                <input class="form-check-input miFencomin" type="checkbox" id="defaultCheck3"
                                                     onclick="formFencomin()">
                                                <label class="form-check-label" for="defaultCheck3">
                                                    Fencomin
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-2 col-md-2 col-lg-2"id="fencomin">
                                            <input type="number" name="fencomin" class="form-control" value="0.4"
                                                step="0.01">
                                        </div>
                                        <div class="form-group col-2 col-md-2 col-lg-2">
                                            <div class="form-check">
                                                <input class="form-check-input miCaja" type="checkbox" id="defaultCheck4"
                                                     onclick="formCaja()">
                                                <label class="form-check-label" for="defaultCheck4">
                                                    Caja
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-2 col-md-2 col-lg-2"id="caja">
                                            <input type="number" name="caja" class="form-control" value="1.8"
                                                step="0.01">
                                        </div>
                                    </div>
                                   
                                    <div class="row">
                                        <div class="form-group col-3 col-md-3 col-lg-3">
                                            <label><strong>Remesa</strong></label>
                                            <input type="number" name="remesa" class="form-control" required=""
                                                step="0.01">
                                        </div>
                                        <div class="form-group col-3 col-md-3 col-lg-3">
                                            <label><strong>Pagable al %</strong></label>
                                            <input type="number" name="pagable" class="form-control" required=""
                                             step="0.01">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </div>

            </div>
    </div>
    </form>
    </div>

@endsection
@section('scripts')
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
        $("#comibol").hide();
     function formComibol() {
       var elementos = $('input.miOpcion');
       var algunoMarcado = elementos.toArray().find(function(elemento) {
          return $(elemento).prop('checked');
       });
       
       if(algunoMarcado) {
         $('#comibol').show();
       } else {
         $('#comibol').hide();
       }
     }
     </script>
     <script>
        $("#fedecomin").hide();
     function formFedecomin() {
       var elementos = $('input.miFedecomin');
       var algunoMarcado = elementos.toArray().find(function(elemento) {
          return $(elemento).prop('checked');
       });
       
       if(algunoMarcado) {
         $('#fedecomin').show();
       } else {
         $('#fedecomin').hide();
       }
     }
     </script>
     <script>
        $("#fencomin").hide();
     function formFencomin() {
       var elementos = $('input.miFencomin');
       var algunoMarcado = elementos.toArray().find(function(elemento) {
          return $(elemento).prop('checked');
       });
       
       if(algunoMarcado) {
         $('#fencomin').show();
       } else {
         $('#fencomin').hide();
       }
     }
     </script>
     <script>
        $("#caja").hide();
     function formCaja() {
       var elementos = $('input.miCaja');
       var algunoMarcado = elementos.toArray().find(function(elemento) {
          return $(elemento).prop('checked');
       });
       
       if(algunoMarcado) {
         $('#caja').show();
       } else {
         $('#caja').hide();
       }
     }
     </script>
@endsection
