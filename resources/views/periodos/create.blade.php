@extends('layouts/master_admin')

@section('title')
    Crear Periodo
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
                url: 'cargardiscos',
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
    @if(count($listaBandas) === 0)
        <div class="alert alert-danger" style="margin-top: 15px;">
            Debe agregar una banda antes de continuar.
            <a href="{{ action('BandasController@index') }}">Crear Banda</a>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {!! Form::open(['action' => 'PeriodosController@store']) !!}
            <h2>Nuevo Periodo</h2>
            <div class="form-group">
                {!! Form::label('periodo', 'Periodo', ['class' => 'control-label']) !!}
                {!! Form::input('text', 'periodo', '', ['class'=> 'form-control', 'placeholder' => 'Periodo']) !!}
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
                        <option value="{{ $servicio->id }}">{{ $servicio->nombre }} (${{ number_format($servicio->precio, 8, '.', ',') }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {!! Form::label('pais', 'Pais al que pertence', ['class' => 'control-label']) !!}
                <select class="form-control" name="pais_id">
                    @foreach ($listaPaises as $pais)
                        <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {!! Form::label('cantidad', 'Cantidad', ['class' => 'control-label']) !!}
                {!! Form::input('text', 'cantidad', '', ['class'=> 'form-control', 'placeholder' => 'Cantidad']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('estado', 'Estado de publicaci&#243;n', ['class' => 'control-label']) !!}
                <select class="form-control" name="estado">
                    <option value="pendiente">Pendiente</option>
                    <option value="listo">Listo</option>
                </select>
            </div>
            <div>
                @if(count($listaBandas) != 0)
                    {!! Form::submit('Crear', ['class' => 'btn btn-primary btn-block']) !!}
                    <a href="{{ action('PeriodosController@index') }}" class="btn btn-danger btn-block" role="button">Cancelar</a>
                @endif
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection