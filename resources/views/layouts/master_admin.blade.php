<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WSM - @yield('title')</title>
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
	@yield('css')
    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
     	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Scripts -->
    <!-- jQuery 1.x -->
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<!-- jQuery UI -->
	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script type="text/javascript">


	    function updateClock() {

	    	var days = ["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"];
	    	var months = ["Enero","Fenrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre"];

	        var currentTime = new Date ( );

	        var currentDay = currentTime.getDate();
	        var currentDayName = currentTime.getDay();
	        var currentMonth = currentTime.getMonth();
			var currentHours = currentTime.getHours ( );
			var currentMinutes = currentTime.getMinutes ( );
			var currentSeconds = currentTime.getSeconds ( );

			// Pad the minutes and seconds with leading zeros, if required
			currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
			currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

			// Compose the string for display
			var currentTimeString = days[currentDayName] + " " + currentDay + " de " + months[currentMonth] + " | " + currentHours + ":" + currentMinutes + ":" + currentSeconds;

			// Update the time display
			document.getElementById("relog").firstChild.nodeValue = currentTimeString;
		}
	</script>
	<script>
		$( function() {
			$.datepicker.setDefaults($.datepicker.regional["es"]);
			$("#datepicker").datepicker({
				firstDay: 1,
				changeMonth: true,
		    	changeYear: true,
		    	monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
				'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
				monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
				'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
				dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
				dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié;', 'Juv', 'Vie', 'Sáb'],
				dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
				weekHeader: 'Sm',
				dateFormat: 'yy-mm-dd'
			});
			$("#datepicker2").datepicker({
				firstDay: 1,
				changeMonth: true,
		    	changeYear: true,
		    	monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
				'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
				monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
				'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
				dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
				dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié;', 'Juv', 'Vie', 'Sáb'],
				dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
				weekHeader: 'Sm',
				dateFormat: 'yy-mm-dd'
			});
		});
	</script>
	@yield('scripts')
</head>
<body onload="updateClock(); setInterval('updateClock()', 1000 )">
    <nav class="navbar navbar-default">
	  <div class="container">
	    <!-- Brand -->
	    <div class="navbar-header">
	    	<img src="{{ asset('images/logo_small.jpg') }}" class="img-responsive">
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav navbar-right">
	        <li><p class="navbar-text">{{ Auth::user()->name }}</p></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Accion <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="{{ route('cambioDePass') }}">Editar Perfil</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="{{route('auth/logout')}}">Cerrar sesion</a></li>
	          </ul>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
    <div class="container">
        @if (Session::has('errors'))
		    <div class="alert alert-warning" role="alert">
				<ul>
		            <strong>Ocurri&#243;  un error: </strong>
				    @foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		@if(Session::has('flash_message'))
		    <div class="alert alert-success">
		        {{ Session::get('flash_message') }}
		    </div>
		@endif
    </div>
    <div class="container">
	    <div class="row">
	        <ul class="nav nav-tabs">
	        	<li><a href="{{ route('periodos.index') }}">Periodos</a></li>
				<li role="presentation" class="dropdown">
	                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
	                    Herramientas <span class="caret"></span>
	                </a>
	                <ul class="dropdown-menu">
	                	<li><a href="{{ route('bandas.index') }}">Bandas</a></li>
	                    <li><a href="{{ route('discos.index') }}">Discos</a></li>
						<li><a href="{{ route('servicios.index') }}">Servicios</a></li>
						<li><a href="{{ route('paises.index') }}">Paises</a></li>
						<li><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
	                </ul>
	            </li>
	            <li role="presentation" class="navbar-right"><p class="navbar-text" id="relog">hora y fecha</p></li>
	        </ul>
	    </div>
	</div>
	@yield('content')
</body>
</html>