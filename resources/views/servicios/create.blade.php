@extends('layouts/master_admin')

@section('title')
    Crear Servicio
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {!! Form::open(['action' => 'ServiciosController@store']) !!}
            <h2>Nuevo Servicio</h2>
            <div class="form-group">
                    {!! Form::label('nombre', 'Nombre', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre del servicio']) !!}
            </div>
            <div class="form-group">
                    {!! Form::label('precio', 'Precio', ['class' => 'control-label']) !!}
                    {!! Form::text('precio', null, ['class' => 'form-control', 'placeholder' => 'Precio del servicio']) !!}
            </div>
            <div class="form-group">
                    {!! Form::label('descripcion', 'Descripci&#243;n', ['class' => 'control-label']) !!}
                    {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Descripci&#243;n y/o Notas adicionales']) !!}
            </div>
            <div>
                {!! Form::submit('Crear', ['class' => 'btn btn-primary btn-block']) !!}
                <a href="{{ action('ServiciosController@index') }}" class="btn btn-danger btn-block" role="button">Cancelar</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection