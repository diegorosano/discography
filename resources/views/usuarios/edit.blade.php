@extends('layouts/master_admin')

@section('title')
    Usuarios
@endsection

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h2>Editar Usuario</h2>
			{!! Form::model($usuario, ['method' => 'PATCH', 'route' => ['usuarios.update', $usuario->id]
			]) !!}
				<div class="form-group">
	                <label>Nombre</label>
	                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
	            </div>
	            <div class="form-group">
	                <label>Rol</label>
	                {!! Form::select('rol', ['administrador' => 'Administrador', 'miembro' => 'Miembro'], null, ['class' => 'form-control' , 'placeholder' => 'Seleccione un rol']) !!}
	            </div>
	            <div class="form-group">
	                {!! Form::label('banda', 'Banda', ['class' => 'control-label']) !!}
	                <select class="form-control" name="banda_id">
	                    @foreach ($listaBandas as $banda)
	                        <option value="{{ $banda->id }}" <?php if($banda->id == $usuario->banda_id) { echo 'selected'; } ?>>{{ $banda->nombre }}</option>
	                    @endforeach
	                </select>
	            </div>
	            <div class="form-group">
                    {!! Form::label('activo', 'Estado', ['class' => 'control-label']) !!}
                    {!! Form::select('estado', ['activo' => 'Activo', 'no activo' => 'No Activo'], null, ['class' => 'form-control' , 'placeholder' => 'Seleccione si esta activo']) !!}
                </div>
				{!! Form::submit('Actualizar Datos', ['class' => 'btn btn-primary btn-block']) !!}
				<a href="{{ action('UserController@index') }}" class="btn btn-danger btn-block" role="button">Cancelar</a>

			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop