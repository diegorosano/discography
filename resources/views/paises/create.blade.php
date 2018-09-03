@extends('layouts/master_admin')

@section('title')
    Crear Pa&#237;s
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {!! Form::open(['action' => 'PaisController@store']) !!}
            <h2>Nuevo Pa&#237;s</h2>
            <div class="form-group">
                <label>Nombre</label>
                {!! Form::input('text', 'nombre', '', ['class'=> 'form-control', 'placeholder' => 'Nombre']) !!}
            </div>
            <div>
                {!! Form::submit('Crear', ['class' => 'btn btn-primary btn-block']) !!}
                <a href="{{ action('PaisController@index') }}" class="btn btn-danger btn-block" role="button">Cancelar</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection