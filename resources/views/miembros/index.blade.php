@extends('layouts/master_user')

@section('title')
    Miembros
@endsection

@section('css')
<style type="text/css">
	.table
	{
		font-size: 12px;
	}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>B&#250;squeda</h3>
            {!! Form::open(['route' => 'miembros.buscar']) !!}
                <div class="row">
                    <div class="form-group col-md-2">
                        {!! Form::label('periodo', 'Periodo', ['class' => 'control-label']) !!}
                        {!! Form::text('periodo', null, ['class' => 'form-control', 'placeholder' => 'Periodo']) !!}
                    </div>
                    <div class="form-group col-md-2">
                        {!! Form::label('disco', 'Disco', ['class' => 'control-label']) !!}
                        {!! Form::text('disco', null, ['class' => 'form-control', 'placeholder' => 'Disco']) !!}
                    </div>
                    <div class="form-group col-md-2">
                        {!! Form::label('servicio', 'Servicio', ['class' => 'control-label']) !!}
                        {!! Form::text('servicio', null, ['class' => 'form-control', 'placeholder' => 'Servicio']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-8">
                        {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ action('MiembrosController@index') }}" class="btn btn-danger" role="button">Eliminar filtro</a>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
    	@if (count($listaPeriodos) == 0)
        	<h3>Sin periodos existentes</h3>
        @else
			<h2>Periodos</h2>
	        <div class="col-md-6 col-md-offset-3">
	            {!! $listaPeriodos->render() !!}
	        </div>
	        <table class="table table-responsive">
	            <tr>
	            	<th>Periodo</th>
	                <th>Disco</th>
	                <th>Servicio</th>
	                <th>Pais</th>
	                <th>Cantidad</th>
	                <th>Total</th>
	            </tr>
	            @foreach ($listaPeriodos as $periodo)
	            <tr>
	            	<td>{{ $periodo->periodo }}</td>
	            	@if ($periodo->disco_id != null)
	            	<td>{{ $periodo->disco->nombre }}</td>
	            	@else
	            		<td>Disco eliminado</td>
	            	@endif
	            	@if ($periodo->servicio_id != null)
	            	<td>{{ $periodo->servicio->nombre }}</td>
	            	@else
	            		<td>Servicio eliminado</td>
	            	@endif
	            	@if ($periodo->pais_id != null)
	            	<td>{{ $periodo->pais->nombre }}</td>
	            	@else
	            		<td>Pais eliminado</td>
	            	@endif
	            	<td>{{ $periodo->cantidad }}</td>
	            	<td>${{ $periodo->total }}</td>
	            </tr>
	            @endforeach
            </table>
        @endif
    </div>
</div>
@endsection