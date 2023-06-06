@extends('layouts.app')
@section('content')

<div id="carousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    @foreach( $novedades as $novedad )
    <div class="item {{ $loop->first ? 'active' : '' }}">
      <div class="item text-center">
        <p>{{ $novedad->descripcion }}</p>
      </div>
    </div>
    <a class="left carousel-control" href="#carousel" data-slide="prev">
      <strong><h3> < </h3></strong>
    </a>
    <a class="right carousel-control" href="#carousel" data-slide="next">
      <strong><h3> > </h3></strong>
    </a>
    @endforeach
  </div>
</div>

@if(Session::has('message'))
<div class="alert alert-danger text-center" role="alert">
 {{Session::get('message')}}
</div>
@endif

<div class="container text-center" >
 
  <br><br><br>
  
  <div class="row">
    <div class="col-md-12"></div>
    
    <br><br>

    <div class="col-md-4" align="right">
      <a  href="/internos"> <img  src="{{ URL::to('/img/internos.png') }}" height="150"></a>
    </div>

    <div class="col-md-4" >
      <a  href="{{('/permisos')}}"> <img src="{{ URL::to('/img/permisos.png') }}" height="150"> </a>
    </div>

    <div class="col-md-4"align="left">
      <a  href="{{('/sistemas')}}"> <img src="{{ URL::to('/img/sistemas.png') }}" height="150"> </a>
    </div>

    <div class="col-md-3">
      <br><br><br><br>
      <a  href="{{('/persona')}}"> <img  src="{{ URL::to('/img/recepcion.png') }}" height="150"></a>
    </div>

    <div class="col-md-3">
      <br><br><br><br>
      <a  href="{{('/empleado')}}"> <img src="{{ URL::to('/img/personal.png') }}" height="150"> </a>
    </div>

    <div class="col-md-3">
      <br><br><br><br>
      <a  href="{{('/medico')}}"> <img src="{{ URL::to('/img/medico.png') }}" height="150"> </a>
    </div>

    <div class="col-md-3">
      <br><br><br><br>
      <a  href="{{('/visitas')}}"> <img src="{{ URL::to('/img/guardia.png') }}" height="150"> </a>
    </div>
  </div>

</div>

<div id="footer-lafedar"></div>

@stop
