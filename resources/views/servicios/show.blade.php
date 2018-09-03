@extends('layouts/master_admin')

@section('title')
    Detalles del servicio
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">

            <h2>Detalles de {{ $servicio->nombre }}</h2>
            <p>Nombre: {{ $servicio->nombre }}</p>
            <p>Precio: {{ number_format($servicio->precio, 8, '.', ',') }}</p>
            <p>Descripci&#243;n: {{ $servicio->descripcion }}</p>
            <p>Acciones: <a href="{{ route('servicios.edit', $servicio->id) }}">Editar</a> | <a href="{{ route('servicios.borrar', $servicio->id) }}">Eliminar Servicio</a></p>
            <br>
            <p><a href="{{ route('servicios.index') }}">Volver</a></p>
        </div>
    </div>
</div>
@endsection