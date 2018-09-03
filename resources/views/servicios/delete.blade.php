@extends('layouts/master_admin')

@section('title')
    Borrar Servicio
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <h2>¿Esta seguro de querer borrar este Servicio?</h2>
            <p>Nombre: {{ $servicio->nombre }}</p>
            <p>Precio: {{ number_format($servicio->precio, 8, '.', ',') }}</p>
            <p>Descripci&#243;n: {{ $servicio->descripcion }}</p>
            <h3>¿Esta seguro de realizarlo?</h3>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['servicios.destroy', $servicio->id]
            ]) !!}
                {!! Form::submit('Eliminar', ['class' => 'btn btn-danger btn-block']) !!}
                <a href="{{ action('ServiciosController@index') }}" class="btn btn-primary btn-block" role="button">Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection