@extends('layouts/master_admin')

@section('title')
    Crear Disco
@endsection

@section('content')
<div class="container">
    @if(count($listaBandas) === 0)
        <div class="alert alert-danger" style="margin-top: 15px;">
            Debe agregar una banda antes de continuar.
            <a href="{{ action('BandasController@index') }}">Crear Banda</a>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {!! Form::open(['action' => 'DiscosController@store']) !!}
            <h2>Nuevo disco</h2>
            <div class="form-group">
                {!! Form::label('nombre', 'Nombre', ['class' => 'control-label']) !!}
                {!! Form::input('text', 'nombre', '', ['class'=> 'form-control', 'placeholder' => 'Nombre']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('anio', 'A&#241;o', ['class' => 'control-label']) !!}
                {!! Form::input('text', 'anio', '', ['class'=> 'form-control', 'placeholder' => 'A&#241;o']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('bandas', 'Banda a la que pertence', ['class' => 'control-label']) !!}
                <select class="form-control" name="banda_id">
                    @foreach ($listaBandas as $banda)
                        <option value="{{ $banda->id }}">{{ $banda->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                @if(count($listaBandas) != 0)
                    {!! Form::submit('Crear', ['class' => 'btn btn-primary btn-block']) !!}
                    <a href="{{ action('DiscosController@index') }}" class="btn btn-danger btn-block" role="button">Cancelar</a>
                @endif
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection