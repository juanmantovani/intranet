@extends('empleado.layouts.layout')


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
      <h2 class="headertekst">Agregar nuevo empleado</h2>
      <hr>
    </div>
  </div>
  
  <div class="row"> 
    <div class="col-md-3 field-label-responsive"></div>
    <div class="col-md-6">
      <div class="form-group has-danger">
        <form action="{{route('empleado.store')}}" method="post" autocomplete="off">
          {{csrf_field()}}
          <input type="hidden" name="id" value="{{{ isset($empleado->id_p) ? $empleado->id_p : ''}}}">
          

          <div class="input-field col-12 ">Nombre:
            <br>
            <input type="text" name="nombre" class="form-control" id="nombre" required>
          </div>

          <div class="input-field col-12 ">Apellido:
            <br>
            <input type="text" name="apellido" class="form-control" id="apellido">
          </div>

          <div class="input-field col-12 ">DNI:
            <br>
            <input type="text" name="dni" class="form-control" id="dni" required>
          </div>
          
          <div class="input-field col-12 ">Interno:
            <br>
            <input type="text" name="interno" class="form-control" id="interno">
          </div>

          <div class="input-field col-12 ">Area:
            <select class="form-control" name="area"  id="area" required>

              @foreach($area as $area)
              <option value="{{$area->id_a}}"> {{$area->nombre_a}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-row col-12">
            
            <div class="col-6">Fecha de nacimiento:
              <br>
              <input type="date"name="fe_nac"  id="fe_nac" class="form-control"-tep="1">
            </div>

            <div class="col-6">Fecha de ingreso:
              <br>
              <input type="date"name="fe_ing"  id="fe_ing" class="form-control"-tep="1"  value="<?php echo date("Y-m-d");?>">
            </div>

          </div>

          <div class="input-field col-12 ">Correo electrónico:
            <br>
            <input type="text" name="correo" class="form-control" id="correo" >
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
</div>
</div>
<div id="footer-lafedar">
</div>
@stop





