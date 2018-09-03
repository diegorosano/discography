@extends('layouts/master_admin')

@section('title')
    Paises
@endsection

@section('content')
<div class="container">
    <div class="row">
        <a href="{{ action('PaisController@create') }}" class="btn btn-success pull-right" role="button">Agregar nuevo Pa&#237;s</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>B&#250;squeda</h3>
            {!! Form::open(['route' => 'paises.buscar']) !!}

                <div class="row">
                    <div class="form-group col-md-3">
                        {!! Form::label('nombre', 'Nombre', ['class' => 'control-label']) !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-md-8">
                        {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ action('PaisController@index') }}" class="btn btn-danger" role="button">Eliminar filtro</a>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        <h3>Paises</h3>
        <div class="col-md-6 col-md-offset-3">
            {!! $listaPaises->render() !!}
        </div>
        <table class="table table-responsive">
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
            @foreach ($listaPaises as $pais)
            @if ($pais->id != 1)
            <tr>
                <td>{{ $pais->nombre }}</td>
                <td>
                    <a href="{{ route('paises.edit', $pais->id) }}">Editar</a> | <a href="{{ route('paises.borrar', $pais->id) }}">Eliminar Pa&#237;s</a>
                </td>
            </tr>
            @endif
            @endforeach
        </table>
    </div>
</div>
@endsection