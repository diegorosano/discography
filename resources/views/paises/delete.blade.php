@extends('layouts/master_admin')

@section('title')
    Borrar Pa&#237;s
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <h2>¿Esta seguro de querer borrar este Pa&#237;s?</h2>
            <h3>Nombre: {{ $pais->nombre }}</h3>
            <h3>¿Esta seguro de realizarlo?</h3>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['paises.destroy', $pais->id]
            ]) !!}
                {!! Form::submit('Eliminar', ['class' => 'btn btn-danger btn-block']) !!}
                <a href="{{ action('PaisController@index') }}" class="btn btn-primary btn-block" role="button">Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection