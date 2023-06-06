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

      <h2 class="headertekst">Solicitud de permiso</h2>
      <hr>
    </div>
  </div>
  
  <div class="row"> 
    <div class="col-md-3 field-label-responsive"></div>
    <div class="col-md-6">
      <div class="form-group has-danger">
        <form action="{{ action('PermisosController@store') }}" method="POST">
          {{csrf_field()}}
          <input type="hidden" name="id" value="{{{ isset($permisos->id) ? $permisos->id : ''}}}">
          <div class="input-field col s12 ">Autorizo a:
            <select class="form-control" name="autorizado"  id="autorizado" required>
              @foreach($personas as $personas)
              <option value="{{$personas->id_p}}">{{$personas->apellido}}&nbsp{{$personas->nombre_p}} </option>
              @endforeach
            </select>
          </div>

          <div class="form-row col-md-12">

            <div class="col-md-6" align="center">Fecha desde:
              <input type="date" name="fecha_desde" class="form-control" step="1" min="2019-01-01" value="<?php echo date("Y-m-d");?>">
            </div>

            <div class="col-md-6" align="center">Fecha hasta:
              <input type="date" name="fecha_hasta" class="form-control" step="1" min="2019-01-01" value="<?php echo date("Y-m-d");?>">
            </div>

          </div>
          
          <div class="form-row col-md-12">
            <div class="col-md-6 " align="center">Horario desde:
              <br>
              <select class="form-control-sm" name="hora_desde" id="hora_desde"  required>
                @for($i=00; $i<24; $i++)
                <option>{{$i}} </option>
                @endfor
              </select>
            </div>
            
            <div class="col-md-6 " align="center">Horario hasta:
              <br>
              <select class="form-control-sm" name="hora_hasta"  id="hora_hasta" required >
                @for($i=00; $i<24; $i++)
                <option>{{$i}}</option>
                @endfor
              </select>
            </div>
          </div>

          <div class="input-field col s12 ">Motivo:
            <select class="form-control" name="motivo"  id="motivo"  required>
              @foreach($tipo_permisos as $tipo_permiso)
              <option value="{{$tipo_permiso->id_tip}}">{{$tipo_permiso->desc}} </option>
              @endforeach
            </select>
          </div>


          <div class="input-field col s12 ">Descripción:
            <textarea class="form-control" rows="5" name="descripcion" id="descripcion" required></textarea>
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

  <div id="footer-lafedar">
  </div>
  @stop