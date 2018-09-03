@extends('layouts/master_admin')

@section('title')
    Editar Disco
@endsection

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h2>Editar Usuario</h2>
			{!! Form::model($disco, ['method' => 'PATCH', 'route' => ['discos.update', $disco->id], 'accept-charset'=>'UTF-8', 'enctype' => 'multipart/form-data']) !!}
	            <div class="form-group">
	                {!! Form::label('nombre', 'Nombre', ['class' => 'control-label']) !!}
	                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
	            </div>
	            <div class="form-group">
	                {!! Form::label('anio', 'A&#241;o', ['class' => 'control-label']) !!}
	                {!! Form::text('anio', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
	            </div>
	            <div class="form-group">
	                {!! Form::label('bandas', 'Banda a la que pertence', ['class' => 'control-label']) !!}
	                <select class="form-control" name="banda_id">
	                    @foreach ($listaBandas as $banda)
	                        <option value="{{ $banda->id }}" <?php if($banda->id == $disco->banda_id) { echo 'selected'; } ?>>{{ $banda->nombre }}</option>
	                    @endforeach
	                </select>
	            </div>
	            <div class="form-group">
            		<label class="control-label">Car&#225;tula</label>
            		<input type="file" class="form-control" name="archivo" >
            	</div>

				{!! Form::submit('Actualizar Datos', ['class' => 'btn btn-primary btn-block']) !!}
				<a href="{{ action('DiscosController@index') }}" class="btn btn-danger btn-block" role="button">Cancelar</a>

			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop