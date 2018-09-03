@extends('layouts/master_user')

@section('title')
    Cambio de clave
@endsection

@section('content')

<div class="container">
	<div class="row">
		<a href="{{ action('PagesController@index') }}" class="btn btn-success pull-right">Volver al inicio</a>
	</div>
	<div class="row">
		<div class="col-md-3 col-md-offset-2">
			<img src="{{ asset('images/avatar') . '/' . Auth::user()->avatar }}" class="img-responsive">
		</div>
		<div class="col-md-5">
			<h2>Cambiar avatar</h2>
			{!! Form::open(['route' => 'cambioavatar', 'accept-charset'=>'UTF-8', 'enctype' => 'multipart/form-data']) !!}
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            	<div class="form-group">
            		<label class="control-label">Nueva foto de perfil</label>
            		<input type="file" class="form-control" name="archivo" >
            	</div>

            	<div class="form-group">
            		<button type="submit" class="btn btn-primary btn-block">Actualizar foto de perfil</button>
            	</div>
			{!! Form::close() !!}
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h2>Cambiar Contrase&#241;a</h2>
			{!! Form::open(['route' => 'usuarios/cambioclave']) !!}
			{!! Form::hidden('id', Auth::user()->id) !!}
				<div class="form-group">
				    {!! Form::label('pass0', 'Antigua contrase&#241;a', ['class' => 'control-label']) !!}
				    {!! Form::password('password_viejo', ['class'=> 'form-control']) !!}
				</div>
				<div class="form-group">
				    {!! Form::label('pass0', 'Nueva contrase&#241;a', ['class' => 'control-label']) !!}
				    {!! Form::password('password_nuevo', ['class'=> 'form-control']) !!}
				</div>
				<div class="form-group">
				    {!! Form::label('pass2', 'Repetir contrase&#241;a', ['class' => 'control-label']) !!}
				    {!! Form::password('password_nuevo_2', ['class'=> 'form-control']) !!}
				</div>

				{!! Form::submit('Actualizar Datos', ['class' => 'btn btn-primary btn-block']) !!}
				<a href="{{ action('PagesController@index') }}" class="btn btn-danger btn-block" role="button">Cancelar</a>

			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop