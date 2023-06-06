@extends('visita.layouts.layout')
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
      <h2 class="headertekst">Control de visitas</h2>
      <hr>
    </div>
  </div>

  <div class="container text-center" >
    <br><br><br>
    <div class="row">
      <div class="col-md-12"></div>
      <br><br><br><br>

      <div class="col-md-4" align="right">
        <a  href=/asignar> <img  src="{{ URL::to('/img/asignar.png') }}" height="150"></a>
      </div>

      <div class="col-md-4">
        <a  href=# data-toggle="modal" data-target="#baja"> <img src="{{ URL::to('/img/baja.png') }}" height="150"> </a>
      </div>

      <div class="col-md-4" align="left">
        <a  href=/consulta > <img src="{{ URL::to('/img/consulta.png') }}" height="150"> </a>
      </div>
      
    </div>
  </div>

  <div id="footer-lafedar"></div>

  <!-- Modal baja-->
  <div class="modal fade" id="baja" role="dialog" align="center">
    <div class="modal-dialog">
     <div class="modal-content">           
      <p class="statusMsg"></p>
      <form action="{{action('VisitaController@baja', '')}}" method="POST" >
        {{csrf_field()}}
        <div class="modal-body">
         <div class="row">
           <div class="col-md-12">
            <label for="title">Numero de tarjeta:</label>
            <select class="form-control" name="id"  id="id"required>
              <option value="">Seleccione una tarjeta</option>
              @if($tarjetas != null)
              @foreach($tarjetas as $tarjeta)
              <option > {{$tarjeta->id_tar}}</option>
              @endforeach
              @endif
            </select>
            <br>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-info" >Dar de baja</button>
          </div>
        </div>
      </div>
    </form>                
  </div>
</div>
</div>

@stop
