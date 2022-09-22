@extends('layouts.admin')
@section('title', 'Gestión de clientes')
@section('styles')
@section('content')


    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Lista de Clientes</h2>
                <a href="{{ route('clientes.create') }}" class="btnm ">Nuevo cliente</a>

            </div>
            <table class="table">
                <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Apellido Paterno</td>
                        <td>Apellido Materno</td>
                        <td>Cedula de Identidad</td>
                        <td>Cedula de Identidad</td>
                    </tr>
                </thead>

                <tbody>
                    


                </tbody>
            </table>
        </div>



    </div>
@endsection
@endsection
@section('scripts')
@endsection