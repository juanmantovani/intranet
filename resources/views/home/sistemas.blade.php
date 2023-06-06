@extends('equipamiento.layouts.layout')
@section('content')

<div class="container text-center" >

  <br><br><br><br>
  
  <div class="row">    
    @if($acceso->solo_lectura == 1)

    <div class="col-md-3" align="center">
      <a  href='equipamiento'> <img  src="{{ URL::to('/img/equipamiento.png') }}" height="150"></a>
    </div>
    @else
    <div class="col-md-3" align="center">
      <a  href='equipamiento'> <img  src="{{ URL::to('/img/equipamiento.png') }}" height="150"></a>
    </div>

    <div class="col-md-3" align="center">
          <a  href='/puestos'> <img  src="{{ URL::to('/img/puesto_de_trabajo.png') }}" height="150"></a>
    </div>
    
    <div class="col-md-3" align="center">
     <a  href='/usuarios'> <img  src="{{ URL::to('/img/usuarios.png') }}" height="150"></a>
   </div>
   <div class="col-md-3" align="center">
     <a  href='/incidentes'> <img  src="{{ URL::to('/img/incidentes.png') }}" height="150"></a>
   </div>

<div class="col-md-3" align="center">
   </div>

   <div class="col-md-6" align="center">
    <br><br><br>
    <a  href='/listado_ip'> <img  src="{{ URL::to('/img/busca_ip.png') }}" height="150"></a>

   </div>
   @endif
 </div>

</div>

<div id="footer-lafedar"></div>

@stop
