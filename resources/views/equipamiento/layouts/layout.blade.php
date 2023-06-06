<!DOCTYPE html>
<html lang="es">

<link href="{{ URL::asset('/css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">

<script type="text/javascript" src="{{ URL::asset('/js/modal-jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/modal-popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/modal-bootstrap.min.js') }}"></script>


<head>

  <meta charset="UTF-8">
  
  <title>Intranet Lafedar</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script language="JavaScript" src="{{ URL::asset('/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  
    <a class="navbar-brand" href="/sistemas"> <img class="logo" src="{{ URL::to('/img/logo.png') }}" height="40"> </a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    
      <span class="navbar-toggler-icon"></span>
    
    </button>
    <div class="collapse navbar-collapse" id="navbar1">
    
      <ul class="navbar-nav ml-auto"> 
    @if (auth()->user()->id != 11)    
    
          <a href="{{route('equipamiento.create')}}" class="btn btn-info btn-xl" data-position="top" data-delay="50" data-tooltip="Ver"> Nuevo equipamiento</a>
          &nbsp
    
          <a href="/create_puesto" class="btn btn-info btn-xl" data-position="top" data-delay="50" data-tooltip="Ver"> Nuevo puesto</a>
          &nbsp
    @endif    
       <form action="{{ url('/logout') }}" method="POST" >
           {{ csrf_field() }}
  
           <button type="submit" class="btn btn-danger" style="display:inline;cursor:pointer">
     	       Cerrar sesión
           
            </button>
       
       </form>
      
      </ul>
  
    </div>
 
  </nav>

  <br>			

  </head>

  <script type="text/javascript" src="{{ URL::asset('/js/bootstrap.min.js') }}"></script>

  @notification()

  <body>
		
    @yield('content')
	
  </body>

</html>