@extends('layouts/master_admin')

@section('title')
    Detalles de {{ $disco->nombre }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <a href="{{ action('DiscosController@index') }}" class="btn btn-success pull-right">Volver</a>
    </div>
    <div class="row">
        <h2>Detalles de {{ $disco->nombre }}</h2>
        <div class="col-md-2">
            <img src="{{ asset('images/caratulas') . '/' . $disco->portada }}" class="img-responsive">
        </div>
        <div class="col-md-8">
            <p>Nombre: {{ $disco->nombre }}</p>
            <p>A&#241;o: {{ $disco->anio }}</p>
            @if ($disco->banda_id != null)
            <p>Banda: {{ $disco->banda->nombre }}</p>
            @else
                <p>Banda eliminada</p>
            @endif
        </div>
    </div>
</div>
@endsection