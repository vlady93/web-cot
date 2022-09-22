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
                            <div class="form-group">
                                <label for="tipo_id">Tipo de Material</label>
                                <select class="form-control" name="tipo_id" id="tipo_id" required>
                                    <option value="" disabled selected>Selecccione Material</option>
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }} 
                                            </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h4>Peso</h4>
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="form-group col-4 col-md-4 col-lg-4">
                                            <label><strong>Merma</strong></label>
                                            <input type="number" name="merma" class="form-control" required="">
                                        </div>

                                        <div class="form-group col-2 col-md-2 col-lg-2">
                                            <label><strong>Deducción Unitaria Ag</strong></label>
                                            <input type="number" name="valorag" class="form-control" required="">
                                            
                                        </div>
                                        <div class="form-group col-2 col-md-2 col-lg-2">
                                            
                                                <label><strong>Medida</strong></label>
                                                <select class="custom-select" id="inputGroupSelect01" name="peso">
                                                   
                                                <option value="" disabled selected>Seleccione</option>
                                                  <option value="1">Gramos</option>
                                                  <option value="2">Onzas</option>
                                                </select>
                                             
                                        </div>
                                        <div class="form-group col-4 col-md-4 col-lg-4">
                                            <label><strong> Porcentaje Pagable Ag</strong></label>
                                            <input type="number" name="porcentag" class="form-control" required="">
                                        </div>
                                        <br><br><br><br><br>
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
                                            <input type="number" name="maquila" class="form-control" required="">
                                        </div>
                                        <div class="form-group col-4 col-md-4 col-lg-4">
                                            <label><strong>Base</strong></label>
                                            <input type="number" name="base" class="form-control" required="">
                                        </div>
                                        <div class="form-group col-4 col-md-4 col-lg-4">
                                            <label><strong>Escalador</strong></label>
                                            <input type="number" name="escalador" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="card-footer">
                                            <h6 class="text-dark">Refinación</h6>
                                            <div class="form-group">
                                                <label><strong>Costo</strong></label>
                                                <input type="number" name="refincaion" class="form-control" required="">
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
                                    <h4>Transporte y Manipuleo</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                    <div class="form-group col-4 col-md-4 col-lg-4">
                                        <label><strong>Flete</strong></label>
                                        <input type="number" name="flete" class="form-control" required="">
                                    </div>
                                    <div class="form-group col-4 col-md-4 col-lg-4">
                                        <label><strong>Rollback</strong></label>
                                        <input type="number" name="rollback" class="form-control" required="">
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
                                    <div class="form-group col-3 col-md-3 col-lg-3">

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="defaultCheck1" value="0.01" name="comibol">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Comibol
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-3 col-md-3 col-lg-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="defaultCheck2" value="0.01" name="fedecomin"">
                                            <label class="form-check-label" for="defaultCheck2">
                                                Fedecomin
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-3 col-md-3 col-lg-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="defaultCheck3" value="0.40" name="fencomin">
                                            <label class="form-check-label" for="defaultCheck3">
                                                Fencomin
                                            </label>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group col-3 col-md-3 col-lg-3">
                                        <label><strong>Remesa</strong></label>
                                        <input type="number" name="remesa" class="form-control" required="">
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

    {{-- <div class="details">

        <div class="recentOrders">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="cardHeader">
                        <h2>Registro de Terminos</h2>
                        <a class="btn btn-primary" href="{{ route('terminos.index') }}"> Volver</a>

                    </div>
                </div>
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
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <form action="{{ route('terminos.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="cliente_id">Liquidaciones</label>
                            <select class="form-control" name="cliente_id" id="cliente_id" required>
                                <option value="" disabled selected>Selecccione un cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->ap_paterno }}
                                        {{ $cliente->ap_materno }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="tipo_id">Material</label>
                        <select class="form-control" name="tipo_id" id="tipo_id" required>
                            <option value="" disabled selected>Selecccione el material</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>Merma:</strong>
                            <input type="number" step="0.01" name="merma" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>Plata Ag (Oz):</strong>
                            <input type="number" step="0.01" name="valorag" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>Plata %:</strong>
                            <input type="number" step="0.01" name="porcentag" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>Maquila :</strong>
                            <input type="number" step="0.01" name="maquila" class="form-control">
                        </div>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>Base:</strong>
                            <input type="number" step="0.01" name="base" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>Refinación:</strong>
                            <input type="number" step="0.01" name="refincaion" class="form-control">
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </div>


                </form>
            </div>
        </div>
    </div> --}}
@endsection
@section('scripts')
@endsection
