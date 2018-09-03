@extends('layouts/master_admin')

@section('title')
    Borrar Disco
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <h3>¿Esta seguro de querer borrar este Disco?</h3>
            <p>Nombre: {{ $disco->nombre }}</p>
            <p>A&#241;o: {{ $disco->anio }}</p>
            <p>Banda: {{ $disco->banda->nombre }}</p>
            <h3>¿Esta seguro de realizarlo?</h3>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['discos.destroy', $disco->id]
            ]) !!}
                {!! Form::submit('Eliminar', ['class' => 'btn btn-danger btn-block']) !!}
                <a href="{{ action('DiscosController@index') }}" class="btn btn-primary btn-block" role="button">Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection