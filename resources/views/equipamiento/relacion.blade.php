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
      <h2 class="headertekst">Relación equipamiento - puesto</h2>
      <hr>
    </div>
  </div>
        
  <div class="row"> 
    <div class="col-md-3 field-label-responsive"></div>
    <div class="col-md-6">
      <div class="form-group has-danger">
         <form action="{{ action('EquipamientoController@store_relacion') }}" method="POST">
            {{csrf_field()}}

            <input type="hidden" name="id" value="{{{ isset($relación->id_r) ? $relación->id_r : ''}}}">

          <div class="input-field col s12 ">Equipamiento:
              <select class="form-control" name="equipamiento"  id="equipamiento" value="{{{ isset($equipamientos->id_e) ? $relacion->equipamientos : ''}}}" required>
                @foreach($equipamientos as $equipamientos)
                 @if($equipamientos->id_e == $equipo->id_e)
                  <option value="{{$equipamientos->id_e}}" selected="">{{$equipamientos->id_e}} </option>
                   @else
              <option value="{{$equipamientos->id_e}}"> {{$equipamientos->id_e}}</option>
              @endif
                @endforeach
              </select>
            </div>

            <div class="input-field col s12 ">Puesto de trabajo:
              <select class="form-control" name="puesto"  id="puesto" value="{{{ isset($puestos->desc_puesto) ? $relacion->puesto : ''}}}" required>
                @foreach($puestos as $puestos)
                  <option value="{{$puestos->id_puesto}}">{{$puestos->desc_puesto .' - '.$puestos->nombre_p ." ". $puestos->apellido}} </option>
                @endforeach

              </select>
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

@stop





