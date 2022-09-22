@extends('layouts.admin')
@section('title', 'Registro de Elementos')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
@section('content')
    <div class="details">

        <div class="recentOrders">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="cardHeader">
                        <h2>Registro de Terminos</h2>
                        <a class="btn btn-primary" href="{{ route('elementos.index') }}"> Volver</a>

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

            <form action="{{ route('elementos.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nombre de elemento:</strong>
                            <input type="text" name="nombre" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Simbolo</strong>
                            <input type="text"   name="simbolo" class="form-control">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </div>


            </form>
        </div>
    </div>
    @endsection
@endsection
@section('scripts')
    
@endsection
