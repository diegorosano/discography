@extends('layouts/master_admin')

@section('title')
    Editar Banda
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {!! Form::model($banda, ['method' => 'PATCH', 'route' => ['bandas.update', $banda->id]
            ]) !!}
            <h2>Editar Banda</h2>
            <div class="form-group">
                <label>Nombre</label>
                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
            </div>
            <div class="form-group">
                    {!! Form::label('descripcion', 'Descripci&#243;n', ['class' => 'control-label']) !!}
                    {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Descripci&#243;n y/o Notas adicionales']) !!}
            </div>
            <div>
                {!! Form::submit('Editar', ['class' => 'btn btn-primary btn-block']) !!}
                <a href="{{ action('BandasController@index') }}" class="btn btn-danger btn-block" role="button">Cancelar</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection