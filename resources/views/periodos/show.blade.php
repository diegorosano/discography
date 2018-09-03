@extends('layouts/master_admin')

@section('title')
    Detalles del periodo
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Detalles del periodo</h2>
            <p>Periodo: {{ $periodo->periodo }}</p>
            @if ($periodo->banda_id != null)
                <p>Banda: {{ $periodo->banda->nombre }}</p>
            @else
                <p><strong>Banda eliminada</strong></p>
            @endif
            @if ($periodo->disco_id != null)
               <p>Disco: {{ $periodo->disco->nombre }}</p>
            @else
                <p><strong>Disco eliminado</strong></p>
            @endif
            @if ($periodo->servicio_id != null)
                <p>Servicio: {{ $periodo->servicio->nombre }} (${{ number_format($periodo->servicio->precio, 8, '.', ',') }})</p>
            @else
                <p><strong>Servicio eliminado</strong></p>
            @endif
            @if ($periodo->pais_id != null)
                <p>Pais: {{ $periodo->pais->nombre }}</p>
            @else
                <p><strong>Pais eliminado</strong></p>
            @endif
            <p>Cantidad: {{ $periodo->cantidad }}</p>
            <p>Total: ${{ number_format($periodo->total, 8, '.', ',') }}</p>
            <p>Estado: {{ $periodo->estado }}</p>
            <p>Acciones: <a href="{{ route('periodos.edit', $periodo->id) }}">Editar</a> | <a href="{{ route('periodos.borrar', $periodo->id) }}">Eliminar Periodo</a></p>
            <br>
            <p><a href="{{ route('periodos.index') }}">Volver</a></p>
        </div>
    </div>
</div>
@endsection