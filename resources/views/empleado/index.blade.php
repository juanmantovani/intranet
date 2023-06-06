@extends('empleado.layouts.layout')

@section('content')


<div class="col-md-12 ml-auto">
  <div class="form-group">
   <input type="text" class="form-control pull-right" style="width:20%" id="search" placeholder="Buscar">
 </div>
</div>

<div class="col-sm-12">             
  <table id="test" class="table table-striped table-bordered table-condensed" role="grid" cellspacing="0" cellpadding="2" border="10">
    <thead>
      <th>Nombre</th>
      <th>DNI</th>
      <th>Fecha de ingreso</th>
      <th>Fecha de nacimiento</th>
      <th>Area</th>
      <th class="text-center">Acciones</th>
    </thead>        
    
    <tbody>
      @if(count($empleados))
      @foreach($empleados as $empleado) 
      <tr>
        <td> {{$empleado->apellido . ' '. $empleado->nombre_p}}</td>
        <td>{{$empleado->dni}}</td>
        @if ($empleado->fe_ing != '')
        <td>{!! \Carbon\Carbon::parse($empleado->fe_ing)->format("d-m-Y") !!}</td>
        @else
        <td></td>
        @endif
        @if ($empleado->fe_nac != '')
        <td>{!! \Carbon\Carbon::parse($empleado->fe_nac)->format("d-m-Y") !!}</td>
        @else
        <td></td>
        @endif
        <td>{{$empleado->nombre_a}}</td>
        <td align="center">
          <a href="{{route('empleado.edit', $empleado->id_p)}}" class="btn btn-info btn-xl" data-position="top" data-delay="50" data-tooltip="Ver"> Editar</a>

          <a href="{{url('destroy_empleado', $empleado->id_p)}}" class="btn btn-danger btn-xl" title="Dar de baja" onclick="return confirm ('Está seguro que desea dar de baja el empleado?')"data-position="top" data-delay="50" data-tooltip="Dar de baja"> X</a>
        </td>
      </tr>
    </tr>

    @endforeach  
    @endif  
  </tbody>
</table>
</div>

<script src="{{ URL::asset('/js/jquery.min.js') }}"></script>

<script>
 $(document).ready(function(){
   $("#search").keyup(function(){
     _this = this;
     $.each($("#test tbody tr"), function() {
       if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
         $(this).hide();
       else
         $(this).show();
     });
   });
 });
</script>
@stop

