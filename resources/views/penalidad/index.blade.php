@extends('layouts.admin')
@section('title', 'Gestión de clientes')
@section('styles')
@section('content')


    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Lista de Penalidades</h2>
                <a href="{{ route('liquidacion_detalles.create') }}" class="btnm ">Nuevo cliente</a>

            </div>
            <table class="table">
                <thead>
                    <tr>
                        <td>Cliente</td>
                        <td>Termino</td>
                        <td>Acciones</td>
                        
                    </tr>
                </thead>

                <tbody>
                    @foreach ($penalidads as $penalidad )
                        <tr>
                            <td>{{$penalidad->cliente->nombre}} {{$penalidad->cliente->ap_paterno}} {{$penalidad->cliente->ap_materno}}</td>
                            <td>{{$penalidad->termino->nombre}}</td>
                            <td><a class="nav-link" href={{route('liquidaciondetalles.edit',$penalidad)}}><i data-feather="edit"></i></a></td>
                            
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>



    </div>
@endsection
@endsection
@section('scripts')
@endsection