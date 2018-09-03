@extends('layouts/master_admin')

@section('title')
    Editar Pa&#237;s
@endsection

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h2>Editar Pa&#237;s</h2>
			{!! Form::model($pais, ['method' => 'PATCH', 'route' => ['paises.update', $pais->id]
			]) !!}
				<div class="form-group">
	                <label>Nombre</label>
	                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
	            </div>
	            <div>
	                {!! Form::submit('Editar', ['class' => 'btn btn-primary btn-block']) !!}
	                <a href="{{ action('PaisController@index') }}" class="btn btn-danger btn-block" role="button">Cancelar</a>
	            </div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop