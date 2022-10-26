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
                            <h4>Lista de Clientes</h4>
                            <a class="nav-link" href="{{ route('clientes.create') }}">
                                <span class="btn btn-success btn-sm "> Nuevo Cliente</span>
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
                                                    <th class="sorting_asc">Nombre</th>
                                                    <th class="sorting_asc">Apellido Paterno</th>
                                                    <th class="sorting_asc">Apellido Materno</th>
                                                    <th class="sorting_asc">Cedula de Identidad</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($datas as $data)
                                                    <tr>
                                                        <td>{{ $data->nombre }}</td>
                                                        <td>{{ $data->ap_paterno }}</td>
                                                        <td>{{ $data->ap_materno }}</td>
                                                        <td>{{ $data->ci }}</td>
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
