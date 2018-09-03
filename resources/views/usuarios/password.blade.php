@extends('layouts/master_admin')

@section('title')
    Usuarios
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h2>Cambiar Contrase&#241;a</h2>
			{!! Form::open(['route' => 'usuarios/cambiar']) !!}
			{!! Form::hidden('id', $usuario->id) !!}
				<div class="form-group">
				    {!! Form::label('pass1', 'Nueva contrase&#241;a', ['class' => 'control-label']) !!}
				    {!! Form::password('password_nuevo', ['class'=> 'form-control']) !!}
				</div>
				<div class="form-group">
				    {!! Form::label('pass2', 'Repetir contrase&#241;a', ['class' => 'control-label']) !!}
				    {!! Form::password('password_nuevo_2', ['class'=> 'form-control']) !!}
				</div>

				{!! Form::submit('Actualizar Datos', ['class' => 'btn btn-primary btn-block']) !!}
				<a href="{{ action('UserController@index') }}" class="btn btn-danger btn-block" role="button">Cancelar</a>

			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop