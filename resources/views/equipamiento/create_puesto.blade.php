@extends('equipamiento.layouts.layout')


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
      <h2 class="headertekst">Agregar nuevo puesto</h2>
      <hr>
    </div>
  </div>

  <div class="row"> 
    <div class="col-md-3 field-label-responsive"></div>
    <div class="col-md-6">
      <div class="form-group has-danger">
       <form action="{{ action('EquipamientoController@store_puesto') }}" method="POST">
        {{csrf_field()}}

        <input type="hidden" name="id" value="{{{ isset($puesto->id_puesto) ? $puesto->id_puesto : ''}}}">          

        <div class="input-field col s12 ">Descripcion:
          <br>
          <input type="text" name="desc_puesto" class="form-control" id="desc_puesto" required>
        </div>

        <div class="input-field col s12 ">Area:
          <select class="form-control" name="area"  id="area" required>
            @foreach($area as $area)
            <option value="{{$area->id_a}}">{{$area->nombre_a}} </option>
            @endforeach
          </select>
        </div> 

        <div class="input-field col s12 ">Persona:
          <select class="form-control" name="persona"  id="persona" required>
            @foreach($personas as $personas)
            <option value="{{$personas->id_p}}">{{$personas->nombre_p .' '. $personas->apellido}} </option>
            @endforeach
          </select>
        </div>          
        <br>
        <div class="col-md-6">
          <input type="checkbox" value="1" checked id="telefono_ip" name="telefono_ip">
          <label for="telefono_ip">Telefono</label>
        </div>
        <br>

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





