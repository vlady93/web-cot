@extends('cliente.layout')
 
@section('content')
    <div class="row" style="margin-top: 5rem;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Listado de Clientes</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('clientes.create') }}"> Crear nuevo cliente</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Cedula de Identidad</th>
            <th width="280px">Acción</th>
        </tr>
        @foreach ($data as $key => $value)
        <tr>
           
            <td>{{ $value->nombre }}</td>
            <td>{{ $value->ap_paterno }}</td>
            <td>{{ $value->ap_materno }}</td>
            <td>{{ $value->ci }}</td>
            
            <td>
                <form action="{{ route('clientes.destroy',$value->id) }}" method="POST">   
                    <a class="btn btn-info" href="{{ route('clientes.show',$value->id) }}">Ver</a>    
                    <a class="btn btn-primary" href="{{ route('clientes.edit',$value->id) }}">Editar</a>   
                    @csrf
                    @method('DELETE')      
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>  
    {!! $data->links() !!}      
@endsection
