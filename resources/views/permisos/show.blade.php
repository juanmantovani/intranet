@extends('permisos.layouts.layout')


@section('content')

<style type="text/css">
  h2.headertekst {
    text-align: center;
  }
</style>

<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">

      <h2 class="headertekst">Permiso Solicitado</h2>
      <hr>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-3 field-label-responsive"></div>
    <div class="col-md-6">       
      <p><strong>Fecha de solicitud: </strong>{!! \Carbon\Carbon::parse($permiso->created_at)->format("d-m-Y") !!}</p>
      <p><strong>Fecha desde: </strong>{!! \Carbon\Carbon::parse($permiso->fecha_desde)->format("d-m-Y") !!}</p>
      @if( $permiso->fecha_hasta != '0000-00-00')
      <p><strong>Fecha hasta: </strong>{!! \Carbon\Carbon::parse($permiso->fecha_hasta)->format("d-m-Y") !!}</p> 
      @endif
      <p><strong>Horario: </strong>{{'de '.$permiso->hora_desde . ' a '. $permiso->hora_hasta}}</p>
      <p><strong>Motivo: </strong>{{$permiso->desc}}</p>
      <p><strong>Descripcion: </strong>{{$permiso->descripcion}}</p>
      <p><strong>Solcitante: </strong>{{$autorizado->nombre_p. ' '. $autorizado->apellido}}</p>
      <p><strong>Area: </strong>{{$autorizado->nombre_a}}</p>
      <p><strong>Autorizado por: </strong>{{$autorizante->nombre_p. ' '. $autorizante->apellido}}</p>	
      
      <div class="container">
       <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-6">
         <a class="btn btn-secondary col-md-4" href="{{ URL::previous() }}">Volver</a>

       </div>
     </div>
     
   </div>
 </div>
 
 @stop