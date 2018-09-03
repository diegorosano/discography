@extends('layouts/master_admin')

@section('title')
    Editar Periodo
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
        });

        $("#bandas").change(function(){
            $("#discos").empty();

            $.ajax({
                type: 'POST',
                url: 'cargardiscos2',
                data: {banda : $("#bandas").val()},
                dataType: 'json',
                success: function (data){
                    if (data.length == 0)
                    {
                         $("#discos").append($("<option></option>").attr("value", '1').text('Sin asignar'));
                    }
                    else
                    {
                        $.each(data, function(key,value) {
                            $("#discos").append($("<option></option>")
                                .attr("value", value.id).text(value.nombre));
                        }); 
                    }
                },
                error: function (ajaxContext) {
                    alert('ERROR... que hiciste? ¬¬')
                }
            });
        });
    });
</script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {!! Form::model($periodo, ['method' => 'PATCH', 'route' => ['periodos.update', $periodo->id]
            ]) !!}
            <h2>Editar Periodo</h2>
            <div class="form-group">
                {!! Form::label('periodo', 'Periodo', ['class' => 'control-label']) !!}
                {!! Form::text('periodo', null, ['class' => 'form-control', 'placeholder' => 'Periodo']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('bandas', 'Banda a la que pertence', ['class' => 'control-label']) !!}
                <select class="form-control" name="banda_id" id="bandas">
                    @foreach ($listaBandas as $banda)
                        <option value="{{ $banda->id }}">{{ $banda->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {!! Form::label('disco', 'Disco', ['class' => 'control-label']) !!}
                <select class="form-control" name="disco_id" id="discos">
                    <option value="1">Seleccione una banda para ver discos disponibles</option>
                </select>
            </div>
            <div class="form-group">
                {!! Form::label('servicio', 'Servicio al que pertence', ['class' => 'control-label']) !!}
                <select class="form-control" name="servicio_id">
                    @foreach ($listaServicios as $servicio)
                        <option value="{{ $servicio->id }}" <?php if($servicio->id == $periodo->servicio_id) { echo 'selected'; }?>>{{ $servicio->nombre }} (${{ number_format($servicio->precio, 8, '.', ',') }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {!! Form::label('pais', 'Pais al que pertence', ['class' => 'control-label']) !!}
                <select class="form-control" name="pais_id">
                    @foreach ($listaPaises as $pais)
                        <option value="{{ $pais->id }}" <?php if($pais->id == $periodo->pais_id) { echo 'selected'; }?>>{{ $pais->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {!! Form::label('cantidad', 'Cantidad', ['class' => 'control-label']) !!}
                {!! Form::text('cantidad', null, ['class' => 'form-control', 'placeholder' => 'Cantidad']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('estado', 'Estado de publicaci&#243;n', ['class' => 'control-label']) !!}
                <select class="form-control" name="estado">
                    <option value="pendiente" <?php if($periodo->estado == 'pendiente') { echo 'selected'; }?>>Pendiente</option>
                    <option value="listo" <?php if($periodo->estado == 'listo') { echo 'selected'; }?>>Listo</option>
                </select>
            </div>
            <div>
                {!! Form::submit('Editar', ['class' => 'btn btn-primary btn-block']) !!}
                <a href="{{ action('PeriodosController@index') }}" class="btn btn-danger btn-block" role="button">Cancelar</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection