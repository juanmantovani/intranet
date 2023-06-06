<!DOCTYPE html>
<html lang="es">

<META HTTP-EQUIV="Refresh" CONTENT="600;URL=http://intranet.lafedar">

<link href="{{ URL::asset('/css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">

<script src="{{ asset('/js/jquery_2.min.js') }}"></script>

<script src="{{ asset('/js/bootstrap_2.min.js') }}"></script>

<head>

	<meta charset="UTF-8">

	<title>Intranet Lafedar</title>
	
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		
		<a class="navbar-brand" href="/"> <img class="logo" src="{{ URL::to('/img/logo.png') }}" height="40"> </a>
		
	</nav>                 
</head>

<body>     
	
	@yield('content')
</body>
</html>
