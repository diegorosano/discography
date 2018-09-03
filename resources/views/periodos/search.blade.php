@extends('layouts/master_admin')

@section('title')
    Periodos
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
        <a href="{{ action('PeriodosController@create') }}" class="btn btn-success pull-right" role="button">Agregar nuevo periodo</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>B&#250;squeda</h3>
            {!! Form::open(['route' => 'periodos.buscar']) !!}
                <div class="row">
                    <div class="form-group col-md-2">
                        {!! Form::label('periodo', 'Periodo', ['class' => 'control-label']) !!}
                        {!! Form::text('periodo', null, ['class' => 'form-control', 'placeholder' => 'Periodo']) !!}
                    </div>
                    <div class="form-group col-md-2">
                        {!! Form::label('banda', 'Banda', ['class' => 'control-label']) !!}
                        {!! Form::text('banda', null, ['class' => 'form-control', 'placeholder' => 'Banda']) !!}
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
                    <div class="form-group col-md-2">
                        {!! Form::label('pais', 'Pais', ['class' => 'control-label']) !!}
                        {!! Form::text('pais', null, ['class' => 'form-control', 'placeholder' => 'Pais']) !!}
                    </div>
                    <div class="form-group col-md-2">
                        {!! Form::label('estado', 'Estado', ['class' => 'control-label']) !!}
                        <select class="form-control" name="estado">
                        	<option value="0">Seleccione</option>
                        	<option value="pendiente">Pendiente</option>
                        	<option value="listo">Listo</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-8">
                        {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ action('PeriodosController@index') }}" class="btn btn-danger" role="button">Eliminar filtro</a>
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
	            {!! $listaPeriodos->appends($parametrosQuery)->render() !!}
	        </div>
	        <table class="table table-responsive">
	            <tr>
	            	<th>Periodo</th>
	                <th>Banda</th>
	                <th>Disco</th>
	                <th>Servicio</th>
	                <th>Pais</th>
	                <th>Cantidad</th>
	                <th>Total</th>
	                <th>Estado</th>
	                <th>Acciones</th>
	            </tr>
	            @foreach ($listaPeriodos as $periodo)
	            <tr>
	            	<td>{{ $periodo->periodo }}</td>
	            	@if ($periodo->banda != null)
	            	<td>{{ $periodo->banda }}</td>
	            	@else
	            		<td>Banda eliminada</td>
	            	@endif
	            	@if ($periodo->disco != null)
	            	<td>{{ $periodo->disco }}</td>
	            	@else
	            		<td>Disco eliminado</td>
	            	@endif
	            	@if ($periodo->servicio != null)
	            	<td>{{ $periodo->servicio }}</td>
	            	@else
	            		<td>Servicio eliminado</td>
	            	@endif
	            	@if ($periodo->pais != null)
	            	<td>{{ $periodo->pais }}</td>
	            	@else
	            		<td>Pais eliminado</td>
	            	@endif
	            	<td>{{ $periodo->cantidad }}</td>
	            	<td>${{ $periodo->total }}</td>
	            	<td>{{ $periodo->estado }}</td>
	            	<td><a href="{{ route('periodos.show', $periodo->id) }}">Detalles</a> | <a href="{{ route('periodos.edit', $periodo->id) }}">Editar</a> | <a href="{{ route('periodos.borrar', $periodo->id) }}">Eliminar</a></td>
	            </tr>
	            @endforeach
            </table>
        @endif
    </div>
</div>
@endsection