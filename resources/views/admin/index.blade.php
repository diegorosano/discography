@extends('layouts/master_admin')

@section('title')
	Inicio
@endsection

@section('content')
<div class="container">
	<h2>Bienvenido {{ Auth::user()->name }}</h2>
</div>
@endsection