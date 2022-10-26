@extends('layouts.admin')
@section('title', 'Gestión de liquidaciones')
@section('styles')
    <link href={{ asset('otika/assets/bundles/datatables/datatables.min.css') }} rel="stylesheet">
    <link
        href={{ asset('otika/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}rel="stylesheet">
@section('content')

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 mr-2">
                            <h4>Lista de Liquidaciones</h4>
                        
                        </div>
                        <div class="table-responsive">
                            <div id="table-1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped dataTable no-footer" id="table-1" role="grid"
                                            aria-describedby="table-1_info">
                                            <thead>
                                                <tr>
                                                    <th class="sorting_asc">Cliente</th>
                                                    <th class="sorting_asc">N° Lote</th>
                                                    <th class="sorting_asc">Material</th>
                                                    <th class="sorting_asc">Fecha</th>
                                                    <th class="sorting_asc">TMH</th>
                                                    <th class="sorting_asc">Tipo</th>
                                                    <th class="sorting_asc">Estado</th>
                                                    <th class="sorting_asc">Editar</th>
                                                    <th class="sorting_asc">Pdf</th>
                                                    <th class="sorting_asc">Documentos</th>
                                                
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($liquidacions as $liquidacion)
                                                <tr>
                                                    <td>{{ $liquidacion->cliente->nombre }} {{ $liquidacion->cliente->ap_paterno }}</td>
                                                    <td>{{ $liquidacion->lote}}</td>
                                                    <td>{{ $liquidacion->termino->tipo->nombre}}</td>
                                                    <td>{{ \Carbon\Carbon::parse($liquidacion->fecha)->format('d/m/y') }}</td>
                                                    <td>{{$liquidacion->tmh}}</td>
                                                    <td>{{$liquidacion->observacion}}</td>
                                                    @if ($liquidacion->estado == 'PROVISIONAL')
                                                    <td><a class="btn btn-warning btn-sm ">{{$liquidacion->estado}}</a></td>
                                                    @else
                                                    <td><a class="btn btn-success btn-sm ">{{$liquidacion->estado}}</a></td>
                                                    @endif
                                                    
                                                    <td><a class="nav-link" href={{route('liquidacions.edit', $liquidacion )}}><i data-feather="edit"></i></a></td>
                                                   @if ($liquidacion->termino->tipo_id!='1')
                                                   <td><a class="badge badge-danger" href={{route('liquidacion.pruebapdf',$liquidacion)}}>pdf</a></td>
                                                   @else
                                                   <td><a class="badge badge-info" href={{route('liquidacion.pruebapdf1',$liquidacion)}}>pdf</a></td>
                                                   @endif
                                                   <td><a class="nav-link" href={{route('liquidacions.show', $liquidacion )}}><i data-feather="camera"></i></a></td>
                                                  
                                                    
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@section('scripts')

<script src={{ asset('otika/assets/bundles/datatables/datatables.min.js') }}></script>
<script src={{ asset('otika/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}></script>
<!-- Page Specific JS File -->
<script src={{ asset('otika/assets/js/page/datatables.js') }}></script>
@endsection
