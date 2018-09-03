@extends('layouts/master_admin')

@section('title')
    Servicios
@endsection

@section('content')
<div class="container">
    <div class="row">
        <a href="{{ action('ServiciosController@create') }}" class="btn btn-success pull-right" role="button">Agregar nuevo Servicio</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>B&#250;squeda</h3>
            {!! Form::open(['route' => 'servicios/buscar']) !!}

                <div class="row">
                    <div class="form-group col-md-3">
                        {!! Form::label('nombre', 'Nombre', ['class' => 'control-label']) !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                    </div>
                    <div class="form-group col-md-3">
                        {!! Form::label('menor', 'Precio menor que', ['class' => 'control-label']) !!}
                        {!! Form::text('menor', null, ['class' => 'form-control', 'placeholder' => 'Menor que...']) !!}
                    </div>
                    <div class="form-group col-md-3">
                        {!! Form::label('mayor', 'Precio mayor que', ['class' => 'control-label']) !!}
                        {!! Form::text('mayor', null, ['class' => 'form-control', 'placeholder' => 'Mayor que...']) !!}
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-md-8">
                        {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ action('ServiciosController@index') }}" class="btn btn-danger" role="button">Eliminar filtro</a>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        <h3>Servicios</h3>
        <div class="col-md-6 col-md-offset-3">
            {!! $listaServicios->render() !!}
        </div>
        <table class="table table-responsive">
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
            @foreach ($listaServicios as $servicio)
            @if ($servicio->id != 1)
            <tr>
                <td>{{ $servicio->nombre }}</td>
                <td>${{ number_format($servicio->precio, 8, '.', ',') }}</td>
                <td>
                    <a href="{{ route('servicios.show', $servicio->id) }}">Detalles</a> | <a href="{{ route('servicios.edit', $servicio->id) }}">Editar</a> | <a href="{{ route('servicios.borrar', $servicio->id) }}">Eliminar Servicio</a>
                </td>
            </tr>
            @endif
            @endforeach
        </table>
    </div>
</div>
@endsection