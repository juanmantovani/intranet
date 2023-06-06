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
      <h2 class="headertekst">Editar empleado</h2>
      <hr>
    </div>
  </div>

  <div class="row"> 
    <div class="col-md-3 field-label-responsive"></div>
    <div class="col-md-6">
      <form action="{{route('empleado.update' , $empleado->id_p)}}" method="POST" autocomplete="off">
        {{ method_field('PUT')}} {{csrf_field()}}
        

        <input type="hidden" name="id" value="{{{ isset($empleado->id_a) ? $empleado->id_a : ''}}}">
        <div class="input-field col s12">Nombre:
          <br>
          <input type="text" name="nombre" class="form-control" id="nombre" value="{{{ isset($empleado->nombre_p) ? $empleado->nombre_p : ''}}}" required>
        </div>

        <div class="input-field col s12">Apellido:
          <br>
          <input type="text" name="apellido" class="form-control" id="apellido" value="{{{ isset($empleado->apellido) ? $empleado->apellido : ''}}}" >
        </div>
        
        <div class="input-field col s12">DNI:
         <br>
         <input type="text" name="dni" class="form-control" id="dni" value="{{{ isset($empleado->dni) ? $empleado->dni : ''}}}" required>
       </div>

       <div class="input-field col s12">Interno:
         <br>
         <input type="text" name="interno" class="form-control" id="interno" value="{{{ isset($empleado->interno) ? $empleado->interno : ''}}}">
       </div>
       
       <div class="input-field col s12 ">Area:
        <select class="form-control" name="area"  id="area" value="{{{ isset($empleado->area) ? $empleado->area : ''}}}" required>
          
          @foreach($area as $area)
          @if($area->id_a == $empleado->area)
          <option value="{{$area->id_a}}" selected=""> {{$area->nombre_a}}</option>
          @else
          <option value="{{$area->id_a}}"> {{$area->nombre_a}}</option>

          @endif  
          @endforeach
        </select>
      </div>

      <div class="form-row col-md-12">
        
        <div class="col-md-6">Fecha de nacimiento:
          <br>
          <input type="date"name="fe_nac"  id="fe_nac" class="form-control" step="1" value="{{{ isset($empleado->fe_nac) ? $empleado->fe_nac : ''}}}">
        </div>

        <div class="col-md-6">Fecha de ingreso:
          <br>
          <input type="date"name="fe_ing"  id="fe_ing" class="form-control" step="1"  value="{{{ isset($empleado->fe_ing) ? $empleado->fe_ing : ''}}}">
        </div>

      </div>
      
      <div class="input-field col s12">Coreo electrónico:
        <br>
        <input type="text" name="correo" class="form-control" id="correo" value="{{{ isset($empleado->correo) ? $empleado->correo : ''}}}">
        <br>      
      </div> 

      <div class="row">
        <div class="col-md-3 field-label-responsive"></div>
        <a class="btn btn-secondary " href="{{ URL::previous() }}">Volver</a>
        &nbsp&nbsp&nbsp&nbsp
        <button type="subitm" class="btn btn-info">Guardar</button>
      </div>
      <br>      
    </form>
  </div>
</div> 
</div>
<div id="footer-lafedar">
</div>
@stop
