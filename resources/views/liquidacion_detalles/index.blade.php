@extends('layouts.admin')
@section('title', 'Gestión de clientes')
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
                            <h4>Lista de Penalidades</h4>
                            <a class="nav-link" href="{{ route('liquidacion_detalles.create') }}">
                                <span class="btn btn-success btn-sm "> Crear Nueva Penalidad</span>
                            </a>
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
                                                    <th class="sorting_asc">Apellidos </th>
                                                    <th class="sorting_asc">Termino </th>
                                                    <th class="sorting_asc">Editar </th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($liquidacionDetalles as $liquidacion_detalle)
                                                    <tr>
                                                        <td>{{ $liquidacion_detalle->cliente->nombre }}</td>
                                                        <td>{{ $liquidacion_detalle->cliente->ap_paterno }} {{ $liquidacion_detalle->cliente->ap_materno }}</td>
                                                        <td>{{ $liquidacion_detalle->termino->nombre }}</td>
                                                        <td><a class="nav-link" href={{route('liquidacion_detalles.edit',$liquidacion_detalle)}}><i data-feather="edit"></i></a></td>
                                                        
                                                        
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
    </div>
    @endsection
    @section('scripts')

        <script src={{ asset('otika/assets/bundles/datatables/datatables.min.js') }}></script>
        <script src={{ asset('otika/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}></script>
        <!-- Page Specific JS File -->
        <script src={{ asset('otika/assets/js/page/datatables.js') }}></script>
    @endsection
