@extends('layouts/master_admin')

@section('title')
    Crear Banda
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {!! Form::open(['action' => 'BandasController@store']) !!}
            <h2>Nueva Banda</h2>
            <div class="form-group">
                <label>Nombre</label>
                {!! Form::input('text', 'nombre', '', ['class'=> 'form-control', 'placeholder' => 'Nombre']) !!}
            </div>
            <div class="form-group">
                    {!! Form::label('descripcion', 'Descripci&#243;n', ['class' => 'control-label']) !!}
                    {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Descripci&#243;n y/o Notas adicionales']) !!}
            </div>
            <div>
                {!! Form::submit('Crear', ['class' => 'btn btn-primary btn-block']) !!}
                <a href="{{ action('BandasController@index') }}" class="btn btn-danger btn-block" role="button">Cancelar</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection