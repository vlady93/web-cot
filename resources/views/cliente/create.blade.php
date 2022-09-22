@extends('layouts.admin')
@section('title', 'Registro de clientes')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('clientes.store') }}" method="POST">
                        @csrf
                      <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 mr-2">
                            <h4>Registro de Cliente</h4>
                            <a class="nav-link" href="{{ route('clientes.index') }}">
                                <span class="btn btn-info btn-sm "> Volver </span>
                            </a>
                        </div>
                        <div class="form-group">
                          <label><strong>Nombre</strong></label>
                          <input type="text" name="nombre" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label><strong>Apellido Paterno</strong></label>
                          <input type="text" name="ap_paterno" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label><strong>Apellido Materno</strong></label>
                          <input type="texy" name="ap_materno" class="form-control">
                        </div>
                        <div class="form-group mb-0">
                          <label><strong>Cedula de Identidad</strong></label>
                          <input type="number" class="form-control" name="ci" required="">
                        </div>
                      </div>
                      <div class="card-footer text-right">
                        <button class="btn btn-primary">Registrar</button>
                      </div>
                    </form>
                  </div>
                
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
