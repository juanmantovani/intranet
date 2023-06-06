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
      <h2 class="headertekst">Editar equipamiento</h2>
      <hr>
    </div>
  </div>

  <div class="row"> 
    <div class="col-md-3 field-label-responsive"></div>
    <div class="col-md-6">
      <form action="{{route('equipamiento.update' , $equipamiento->id_e)}}" method="POST" autocomplete="off">
        {{ method_field('PUT')}} {{csrf_field()}}
        
        <div class="input-field col s12 ">Tipo de equipamiento:
          <select class="form-control" name="tipo"  id="tipo" value="{{{ isset($tipo_equipamiento->equipamiento) ? $equipamiento->tipo : ''}}}" required>
            @foreach($tipo_equipamiento as $tipo_equipamiento)
            @if($tipo_equipamiento->id == $equipamiento->tipo)
            <option value="{{$tipo_equipamiento->id}}" selected=""> {{$tipo_equipamiento->equipamiento}}</option>
            @else
            <option value="{{$tipo_equipamiento->id}}"> {{$tipo_equipamiento->equipamiento}}</option>
            @endif
            @endforeach
          </select>
        </div>                  

        <div class="input-field col s12 ">Id equipamiento:
          <br>
          <input type="text" name="id_e" class="form-control" id="id_e" value="{{{ isset($equipamiento->id_e) ? $equipamiento->id_e : ''}}}" required>
        </div>

        <div class="input-field col s12 ">Marca:
          <br>
          <input type="text" name="marca" class="form-control" id="marca" value="{{{ isset($equipamiento->marca) ? $equipamiento->marca : ''}}}" >
        </div>

        <div class="input-field col s12 ">Modelo:
          <br>
          <input type="text" name="modelo" class="form-control" id="modelo" value="{{{ isset($equipamiento->modelo) ? $equipamiento->modelo : ''}}}" >
        </div>

        <div class="input-field col s12 ">Número de serie:
          <br>
          <input type="text" name="num_serie" class="form-control" id="num_serie"  value="{{{ isset($equipamiento->num_serie) ? $equipamiento->num_serie : ''}}}" >
        </div>

        <div class="input-field col s12 ">Dirección IP:
          <br>
          <input type="text" name="ip" class="form-control" id="ip" value="{{{ isset($equipamiento->ip) ? $equipamiento->ip : ''}}}" >
        </div>

        <div class="input-field col s12 ">Observación:
          <br>
          <input type="text" name="obs" class="form-control" id="obs" value="{{{ isset($equipamiento->obs) ? $equipamiento->obs : ''}}}" >
        </div>

        <div class="input-field col s12 ">Pulgadas:
          <br>
          <input type="text" name="pulgadas" class="form-control" id="pulgadas" value="{{{ isset($equipamiento->pulgadas) ? $equipamiento->pulgadas : ''}}}" >
        </div>

        <div class="input-field col s12 ">Procesador:
          <br>
          <input type="text" name="procesador" class="form-control" id="procesador" value="{{{ isset($equipamiento->procesador) ? $equipamiento->procesador : ''}}}" >
        </div>

        <div class="input-field col s12 ">Capacidad de almancenamiento en disco (GB):
          <br>
          <input type="text" name="disco" class="form-control" id="disco" value="{{{ isset($equipamiento->disco) ? $equipamiento->disco : ''}}}" >
        </div>

        <div class="input-field col s12 ">Memoria RAM:
          <br>
          <input type="text" name="memoria" class="form-control" id="memoria"  value="{{{ isset($equipamiento->memoria) ? $equipamiento->memoria : ''}}}" >
        </div>

        <div class="input-field col s12 ">Toner:
          <br>
          <input type="text" name="toner" class="form-control" id="toner"  value="{{{ isset($equipamiento->toner) ? $equipamiento->toner : ''}}}" >
        </div>

        <div class="input-field col s12 ">Unidad de imagen:
          <br>
          <input type="text" name="unidad_imagen" class="form-control" id="unidad_imagen"  value="{{{ isset($equipamiento->unidad_imagen) ? $equipamiento->unidad_imagen : ''}}}" >
        </div>

        <div class="input-field col s12 ">Orden de compra:
          <br>
          <input type="text" name="oc" class="form-control" id="oc"  value="{{{ isset($equipamiento->oc) ? $equipamiento->oc : ''}}}" >
        </div>
        <br>
        <div class="row">
          <div class="col-md-3 field-label-responsive"></div>
          <div class="col-md-1"></div>
          <a class="btn btn-secondary " href="{{ URL::previous() }}">Volver</a>
          &nbsp
          <button type="subitm" class="btn btn-info">Guardar</button>
        </div>
        <br>      
      </form>
    </div>
  </div> 
</div>
@stop
