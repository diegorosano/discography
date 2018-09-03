@extends('layouts/master_admin')

@section('title')
    Borrar Banda
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <h2>¿Esta seguro de querer borrar esta Banda?</h2>
            <p>Nombre: {{ $banda->nombre }}</p>
            <p>Descripci&#243;n: {{ $banda->descripcion }}</p>
            <h3>¿Esta seguro de realizarlo?</h3>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['bandas.destroy', $banda->id]
            ]) !!}
                {!! Form::submit('Eliminar', ['class' => 'btn btn-danger btn-block']) !!}
                <a href="{{ action('BandasController@index') }}" class="btn btn-primary btn-block" role="button">Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection