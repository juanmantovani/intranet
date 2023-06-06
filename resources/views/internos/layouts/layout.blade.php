<!DOCTYPE html>

	<html lang="es">

	<link href="{{ URL::asset('/css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">

	<head>

 	 <meta charset="UTF-8">
  
  	<title>Intranet Lafedar</title>

  	<meta name="csrf-token" content="{{ csrf_token() }}">

	  <script language="JavaScript" src="{{ URL::asset('/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>

		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    		<a class="navbar-brand" href="/"> <img class="logo" src="{{ URL::to('/img/logo.png') }}" height="40"> </a>
    	</nav>
		<br>                   

	</head>

	<script type="text/javascript" src="{{ URL::asset('/js/bootstrap.min.js') }}"></script>
	@notification()

	<body >

	@yield('content')
	
	</body>
</html>
