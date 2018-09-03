@extends('layouts/master_admin')

@section('title')
    Borrar Periodo
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <h2>¿Esta seguro de querer borrar este Servicio?</h2>
            <p>Periodo: {{ $periodo->periodo }}</p>
            <p>Banda: {{ $periodo->banda->nombre }}</p>
            <p>Disco: {{ $periodo->disco->nombre }}</p>
            <p>Servicio: {{ $periodo->servicio->nombre }} (${{ number_format($periodo->servicio->precio, 8, '.', ',') }})</p>
            <p>Pais: {{ $periodo->pais->nombre }}</p>
            <p>Cantidad: {{ $periodo->cantidad }}</p>
            <p>Total: ${{ number_format($periodo->total, 8, '.', ',') }}</p>
            <p>Estado: {{ $periodo->estado }}</p>
            <h3>¿Esta seguro de realizarlo?</h3>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['periodos.destroy', $periodo->id]
            ]) !!}
                {!! Form::submit('Eliminar', ['class' => 'btn btn-danger btn-block']) !!}
                <a href="{{ action('PeriodosController@index') }}" class="btn btn-primary btn-block" role="button">Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection