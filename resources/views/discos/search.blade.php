@extends('layouts/master_admin')

@section('title')
    Discos
@endsection

@section('content')
<div class="container">
    <div class="row">
        <a href="{{ action('DiscosController@create') }}" class="btn btn-success pull-right" role="button">Agregar nuevo Disco</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>B&#250;squeda</h3>
            {!! Form::open(['route' => 'discos.buscar']) !!}

                <div class="row">
                    <div class="form-group col-md-3">
                        {!! Form::label('nombre', 'Nombre', ['class' => 'control-label']) !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                    </div>
                    <div class="form-group col-md-2">
                        {!! Form::label('desde', 'A&#241;o desde', ['class' => 'control-label']) !!}
                        {!! Form::text('desde', null, ['class' => 'form-control', 'placeholder' => 'Desde']) !!}
                    </div>
                    <div class="form-group col-md-2">
                        {!! Form::label('hasta', 'A&#241;o hasta', ['class' => 'control-label']) !!}
                        {!! Form::text('hasta', null, ['class' => 'form-control', 'placeholder' => 'Hasta']) !!}
                    </div>
                    <div class="form-group col-md-3">
                        {!! Form::label('banda', 'Nombre de la banda', ['class' => 'control-label']) !!}
                        {!! Form::text('banda', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-8">
                        {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ action('DiscosController@index') }}" class="btn btn-danger" role="button">Eliminar filtro</a>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        <h3>Bandas</h3>
        <div class="col-md-6 col-md-offset-3">
            {!! $listaDiscos->appends($parametrosQuery)->render() !!}
        </div>
        <table class="table table-responsive">
            <tr>
                <th>Nombre</th>
                <th>A&#241;o</th>
                <th>Banda</th>
                <th>Acciones</th>
            </tr>
            @foreach ($listaDiscos as $disco)
            @if ($disco->id != 1)
            <tr>
                <td>{{ $disco->nombre }}</td>
                <td>{{ $disco->anio }}</td>
                <td>{{ $disco->banda }}</td>
                <td>
                    <a href="{{ route('discos.show', $disco->id) }}">Detalles</a> | <a href="{{ route('discos.edit', $disco->id) }}">Editar</a> | <a href="{{ route('discos.borrar', $disco->id) }}">Eliminar Disco</a>
                </td>
            </tr>
            @endif
            @endforeach
        </table>
    </div>
</div>
@endsection