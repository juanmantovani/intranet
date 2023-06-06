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
      <h2 class="headertekst">Agregar nuevo</h2>
      <hr>
    </div>
  </div>
  
  <div class="row"> 
    <div class="col-md-3 field-label-responsive"></div>
    <div class="col-md-6">
      <div class="form-group has-danger">
        <form action="{{route('equipamiento.store')}}" method="post" autocomplete="off">
          {{csrf_field()}}
          <input type="hidden" name="id" value="{{{ isset($equipamiento->id) ? $equipamiento->id : ''}}}">
          

          <div class="input-field col s12 ">Id equipamiento:
            <br>
            <input type="text" name="id_e" class="form-control" id="id_e" required>
          </div>

          <div class="input-field col s12 ">Marca:
            <br>
            <input type="text" name="marca" class="form-control" id="marca">
          </div>

          <div class="input-field col s12 ">Modelo:
            <br>
            <input type="text" name="modelo" class="form-control" id="modelo">
          </div>

          <div class="input-field col s12 ">Número de serie:
            <br>
            <input type="text" name="num_serie" class="form-control" id="num_serie">
          </div>

          <div class="input-field col s12 ">Dirección IP:
            <br>
            <input type="text" name="ip" class="form-control" id="ip">
          </div>

          <div class="input-field col s12 ">Observación:
            <br>
            <textarea class="form-control" rows="5" name="obs" id="obs"></textarea>
          </div>

          <div class="input-field col s12 ">Pulgadas:
            <br>
            <input type="text" name="pulgadas" class="form-control" id="pulgadas">
          </div>

          <div class="input-field col s12 ">Procesador:
            <br>
            <input type="text" name="procesador" class="form-control" id="procesador">
          </div>

          <div class="input-field col s12 ">Capacidad de almancenamiento en disco:
            <br>
            <input type="text" name="disco" class="form-control" id="disco">
          </div>

          <div class="input-field col s12 ">Memoria RAM:
            <br>
            <input type="text" name="memoria" class="form-control" id="memoria">
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





