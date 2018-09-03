@extends('layouts/master_admin')

@section('title')
    Discos
@endsection

@section('content')
<div class="container">
    <div class="row">
        <a href="{{ action('BandasController@create') }}" class="btn btn-success pull-right" role="button">Agregar nueva Banda</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>B&#250;squeda</h3>
            {!! Form::open(['route' => 'bandas.buscar']) !!}

                <div class="row">
                    <div class="form-group col-md-3">
                        {!! Form::label('nombre', 'Nombre', ['class' => 'control-label']) !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-md-8">
                        {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ action('BandasController@index') }}" class="btn btn-danger" role="button">Eliminar filtro</a>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        <h3>Bandas</h3>
        <div class="col-md-6 col-md-offset-3">
            {!! $listaBandas->render() !!}
        </div>
        <table class="table table-responsive">
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
            @foreach ($listaBandas as $banda)
            @if ($banda->id != 1)
            <tr>
                <td>{{ $banda->nombre }}</td>
                <td>
                    <a href="{{ route('bandas.show', $banda->id) }}">Detalles</a> | <a href="{{ route('bandas.edit', $banda->id) }}">Editar</a> | <a href="{{ route('bandas.borrar', $banda->id) }}">Eliminar Banda</a>
                </td>
            </tr>
            @endif
            @endforeach
        </table>
    </div>
</div>
@endsection