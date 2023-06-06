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
      <h2 class="headertekst">Nuevo incidente</h2>
      <hr>
    </div>
  </div>
  
  <div class="row"> 
    <div class="col-md-3 field-label-responsive"></div>
    <div class="col-md-6">
      <div class="form-group has-danger">
       <form action="{{ action('EquipamientoController@store_incidente') }}" method="POST">
        {{csrf_field()}}

        <input type="hidden" name="id" value="{{{ isset($incidente->id_i) ? $incidente->id_i : ''}}}">

        <div class="input-field col s12 ">Id equipamiento:
          <br>
          <input type="text" name="equipamiento" class="form-control" id="equipamiento" value="{{{ isset($equipamientos->id_e) ? $equipamientos->id_e : ''}}}"required>
        </div>

        <div class="input-field col s12 ">Descripción:
          <textarea class="form-control" rows="5" name="descripcion" id="descripcion" required></textarea>
        </div>
        <div class="input-field col s12 ">Solución:
          <textarea class="form-control" rows="5" name="solucion" id="solucion"></textarea>
        </div>
        <br>
        <div class="col-md-6">
          <input type="checkbox" value="1" checked id="resuelto" name="resuelto">
          <label for="resuelto">Resuelto</label>
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

@stop



