@extends('medico.layouts.layout')

@section('content')

<div class="col-md-12 ml-auto d-print-none">
  <h1>
    {{ Form::open (['route' => 'medico.index', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
    <div class="form-group"><h6>Paciente:</h6>
      <input type="text" name="paciente" class="form-control" id="paciente" value="{{$paciente}}" >
    </div>
    &nbsp
    <div class="form-group"><h6>Fecha:</h6>
      <input type="date" name="fecha" class="form-control" step="1" min="2019-01-01" value="{{$fecha}}">
    </div>
    &nbsp

    <button type="submit" class="btn btn-default">Buscar consulta</button>
    {{Form::close()}}
  </h1>            
</div>

<div class="col-md-12">             
  <table class="table table-striped table-bordered d-print-none">
    <thead>
     <th>Paciente</th>
     <th class="text-center ">Fecha de consulta</th>
     <th class="text-center">Sintoma</th>
     <th class="text-center">Acciones</th>
   </thead>  
   <tbody>
    @if(count($consultas))
    @foreach($consultas as $consulta) 
    <tr>
      <td > {{$consulta->apellido_paciente.' '. $consulta->nombre_paciente}}</td>
      <td class="text-center"> {!! \Carbon\Carbon::parse($consulta->fecha)->format("d-m-Y") !!}</td>
      <td class="text-center"> {{$consulta->sintoma}}</td>
      <td class="text-center"><button class="btn btn-info btn-xl" data-fecha="{!! \Carbon\Carbon::parse($consulta->fecha)->format('d-m-Y') !!}" data-nombre="{{$consulta->nombre_paciente .' '. $consulta->apellido_paciente}}" data-sintoma="{{$consulta->sintoma}}" data-obs="{{$consulta->obs}}" data-toggle="modal" data-target="#ver"> Ver</button></td>
    </tr>                    
    @endforeach  
    @endif  
  </tbody>
</table>

<!-- Modal Ver-->
<div class="modal fade" id="ver" role="dialog" align="center">
  <div class="modal-dialog">
   <div class="modal-content">           
    <p class="statusMsg"></p>
     <div class="modal-body">
        <div class="col-md-12" align="center">
          <h5 class="col-md-6">Consulta medica</h5>
          <hr>
        @include('medico.show')    
    </div>
  </div>
</div>
</div>
</div>
{{ $consultas->appends($_GET)->links() }}

</div>
<script>
  $('#ver').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) 
    var nombre = button.data('nombre') 
    var fecha = button.data('fecha') 
    var apellido = button.data('apellido')
    var sintoma = button.data('sintoma')
    var obs = button.data('obs')
    var modal = $(this)

    modal.find('.modal-body #nombre').val(nombre);
    modal.find('.modal-body #fecha').val(fecha);
    modal.find('.modal-body #apellido').val(apellido);
    modal.find('.modal-body #sintoma').val(sintoma);
    modal.find('.modal-body #obs').val(obs);
    })
  </script>
  @stop