@extends('medico.layouts.layout')

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

      <h2 class="headertekst">Nueva consulta</h2>
      <hr>
    </div>
  </div>
  
  <div class="row"> 
    <div class="col-md-3 field-label-responsive"></div>
    <div class="col-md-6">
      <div class="form-group has-danger">
        <form action="{{ action('MedicoController@store') }}" method="POST">
          {{csrf_field()}}
          <input type="hidden" name="id" id="id" value="">

          <div class="col-md-5" >Fecha de consulta:
            <input type="date" name="fecha"  class="form-control" step="1" min="2019-01-01" value="<?php echo date("Y-m-d");?>">
          </div>

          <div class="input-field col s12 ">Paciente:
            <select class="form-control" name="paciente"  id="paciente" required>
              @foreach($personas as $personas)
              <option value="{{$personas->id_p}}">{{$personas->apellido}}&nbsp{{$personas->nombre_p}} </option>
              @endforeach
            </select>
          </div>

          <div class="input-field col s12 ">Sintoma:
            <select class="form-control" name="sintoma"  id="sintoma"  required>
              @foreach($sintomas as $sintoma)
              <option value="{{$sintoma->id}}">{{$sintoma->desc_sintoma}} </option>
              @endforeach
            </select>
            <a href=# data-toggle="modal" data-target="#añadir_sintoma"> Añadir sintoma</a>
          </div>

          <div class="input-field col s12 ">Observación:
            <textarea class="form-control" rows="5" name="observacion" id="observacion" required></textarea>
          </div>
          <br>           

          <div class="row">
            <div class="col-md-3 field-label-responsive"></div>
            <div class="col-md-1"></div>
            <a class="btn btn-secondary " href="{{ URL::previous() }}">Volver</a>
            &nbsp
            <button type="subitm" class="btn btn-info">Guardar</button>
          </div>
        </div>
        <br>
      </form>
    </div>
  </div>


  <!-- Modal Añadir_sintoma-->
  <div class="modal fade" id="añadir_sintoma" role="dialog" align="center">
    <div class="modal-dialog">
     <div class="modal-content">           
      <p class="statusMsg"></p>
      <div class="container">
        <form action="{{action('MedicoController@añadir_sintoma', '')}}" method="POST" >
          {{csrf_field()}}
          <div class="modal-body">
           <div class="row">
             <div class="col-md-12">
               <h4 class="headertekst">Agregar sintoma</h4>
               <hr>
               <input class="form-control" type="text" name="sintoma" required>
               <br>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
               <button type="submit" class="btn btn-info" >Añadir</button>
             </div>
           </div>
         </div>
       </form>                
     </div>
   </div>
 </div>
</div>


@stop