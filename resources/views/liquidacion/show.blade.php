@extends('layouts.admin')
@section('title', 'Registro de liquidaciones')
@section('styles')
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card card-secondary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 mr-2">
                            <h4>Registro de liquidación</h4>
                        </div>

                        <div class="row">


                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{ $liquidacion }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($files as $file)
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <img src="{{ asset($file->url) }}" class=" mx-auto d-block w-100 " width="200px"
                                        height="200px" alt="...">
                                </div>
                                <strong>{{$file->liquidacion_id}}</strong>
                            @endforeach
                        </div>

                    </div>
                </div>
                <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Logo</label>
                        <input type="file" name="url">
                        <input type="text" name="nombre">
                        <input type="text" name="liquidacion_id" value="{{ $liquidacion->id }}">
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" id="guardar"class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    </div>
    </div>
    </div>
@endsection
@section('scripts')

@endsection
