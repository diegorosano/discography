@extends('layouts/master_admin')

@section('title')
    Detalles de la Banda
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">

            <h2>Detalles de la banda</h2>
            <p>Nombre: {{ $banda->nombre }}</p>
            <p>Descripci&#243;n: {{ $banda->descripcion }}</p>
            <h3>Integrantes</h3>
            <ul>
            @if (count($miembros) != 0)
                @foreach ($miembros as $miembro)
                <li>{{ $miembro->name }}</li>
                @endforeach
            @else
                <li>Sin integrantes asignados</li>
            @endif                 
            </ul>
        </div>
    </div>
</div>
@endsection