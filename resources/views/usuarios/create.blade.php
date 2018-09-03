@extends('layouts/master_admin')

@section('title')
    Crear Usuario
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {!! Form::open(['action' => 'UserController@store']) !!}
            <h2>Nuevo Usuario</h2>
            <div class="form-group">
                <label>Nombre</label>
                {!! Form::input('text', 'name', '', ['class'=> 'form-control', 'placeholder' => 'Nombre']) !!}
            </div>
            <div class="form-group">
                <label>Email</label>
                {!! Form::email('email', '', ['class'=> 'form-control', 'placeholder' => 'eMail']) !!}
            </div>
            <div class="form-group">
                <label>Contrase&#241;a</label>
                {!! Form::password('password', ['class'=> 'form-control', 'placeholder' => 'Contrase&#241;a']) !!}
            </div>
            <div class="form-group">
                <label>Confirmar contrase&#241;a</label>
                {!! Form::password('password_confirmation', ['class'=> 'form-control', 'placeholder' => 'Confirmar contrase&#241;a']) !!}
            </div>
            <div class="form-group">
                <label>Rol</label>
                {!! Form::select('rol', ['administrador' => 'Administrador', 'miembro' => 'Miembro'], null, ['class' => 'form-control' , 'placeholder' => 'Seleccione un rol']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('banda', 'Banda a la que pertenece', ['class' => 'control-label']) !!}
                <select class="form-control" name="banda_id">
                    @foreach ($listaBandas as $banda)
                        <option value="{{ $banda->id }}">{{ $banda->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                    {!! Form::label('activo', 'Estado', ['class' => 'control-label']) !!}
                    {!! Form::select('activo', ['activo' => 'Activo', 'no activo' => 'No Activo'], null, ['class' => 'form-control' , 'placeholder' => 'Seleccione si esta activo']) !!}
                </div>
            <div>
                {!! Form::submit('Crear', ['class' => 'btn btn-primary btn-block']) !!}
                <a href="{{ action('UserController@index') }}" class="btn btn-danger btn-block" role="button">Cancelar</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection