<!DOCTYPE html>
<html>
<head>
    <title>No encontrado</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row margin-top">
        <div class="col-md-6 col-md-offset-3">
            <img src="{{ asset('images/logo.jpg') }}" class="img-responsive">
            <h3>ERROR 404 - P&#225;gina no encontrada</h3>
            <p>Este error se debe a que no se ha encontrado la pagina que usted est&#225; solicitando. Si piensa que esto es un error, por favor, comun&#237;quese con el administrador.</p>
            <p><a href="{{ action('PagesController@index') }}" class="btn btn-success pull-right">Volver a inicio</a></p>
        </div>
    </div>
</div>
</body>
</html>
