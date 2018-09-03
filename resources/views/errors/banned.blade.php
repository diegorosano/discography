<!DOCTYPE html>
<html>
<head>
	<title>Usuario inactivo</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<div class="container">
	<div class="row margin-top">
		<div class="col-md-6 col-md-offset-3">
			<img src="{{ asset('images/logo.jpg') }}" class="img-responsive">
			<h3>Cuenta de usuario no habilitada, por favor comuniquese con el administrador si piensa que esto es un error.</h3>
			<p><a href="{{ route('auth/logout') }}" class="btn btn-danger pull-right">Cerrar sesion</a></p>
		</div>
	</div>
</div>
</body>
</html>

