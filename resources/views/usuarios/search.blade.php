@extends('layouts/master_admin')

@section('title')
    Usuarios
@endsection

@section('content')
<div class="container">
    <div class="row">
        <a href="{{ action('UserController@create') }}" class="btn btn-success pull-right" role="button">Agregar nuevo Usuario</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>B&#250;squeda</h3>
            {!! Form::open(['route' => 'usuarios/search']) !!}

                <div class="row">
                    <div class="form-group col-md-3">
                        {!! Form::label('nombre', 'Nombre', ['class' => 'control-label']) !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                    </div>
                    <div class="form-group col-md-3">
                        {!! Form::label('banda', 'Banda', ['class' => 'control-label']) !!}
                        <select class="form-control" name="banda_id">
                            <option value="0">Elija...</option>
                            @foreach ($listaBandas as $banda)
                                <option value="{{ $banda->id }}">{{ $banda->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-md-8">
                        {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ action('UserController@index') }}" class="btn btn-danger" role="button">Eliminar filtro</a>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        <h3>Usuarios</h3>
        <div class="col-md-6 col-md-offset-3">
            {!! $listaUsuarios->appends($parametrosQuery)->render() !!}
        </div>
        <table class="table table-responsive">
            <tr>
                <th>Nombre</th>
                <th>eMail</th>
                <th>Rol</th>
                <th>Banda</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            @foreach ($listaUsuarios as $usuario)
            <tr>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->rol }}</td>
                <td>{{ $usuario->banda }}</td>
                @if ($usuario->estado == 'activo')
                    <td>Activo</td>
                @else
                    <td>No Activo</td>
                @endif
                <td>
                    <a href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a> | <a href="{{ route('cambiarpass', $usuario->id) }}">Cambiar Contrase&#241;a</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection