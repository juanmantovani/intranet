@extends('permisos.layouts.layout')

@section('content')

<div class="col-md-12 ml-auto">
    <h1>
        {{ Form::open (['route' => 'permisos.index', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
        <div class="form-group"><h6>Empleado:</h6>
            <input type="text" name="empleado" class="form-control" id="empleado" value="{{$empleado}}" >
        </div>
        &nbsp
        <div class="form-group">
            <select class="form-control" name="motivo"  id="motivo" value="{{{ isset($tipo_permisos->desc) ? $permisos->motivo : ''}}}">
                <option value="0">{{'Sin motivo'}} </option>
                @foreach($tipo_permisos as $tipo_permiso)
                <option value="{{$tipo_permiso->id_tip}}">{{$tipo_permiso->desc}} </option>
                @endforeach
            </select>                  
        </div>
        &nbsp
        <button type="submit" class="btn btn-default"> Buscar permiso</button>
        {{Form::close()}}
    </h1>            
</div>

<div class="col-md-12">             
  <table class="table table-striped table-bordered ">
    <thead>
       <th>Empleado</th>
       <th class="text-center">Fecha solicitud</th>
       <th class="text-center">Fecha desde</th>
       <th class="text-center">Fecha hasta</th>
       <th class="text-center">Horario</th>
       <th>Motivo</th>
       <th class="text-center">Acciones</th>       
   </thead>  
   <tbody>
    @if(count($permisos))
    @foreach($permisos as $permiso) 
    <tr>
        <td > {{$permiso->nombre_autorizado.' '. $permiso->apellido_autorizado}}</td>
        <td class="text-center"> {!! \Carbon\Carbon::parse($permiso->fecha_permiso)->format("d-m-Y") !!}</td>
        <td class="text-center">{!! \Carbon\Carbon::parse($permiso->fecha_desde)->format("d-m-Y") !!}</td>
        @if( $permiso->fecha_hasta != null)
        <td class="text-center">{!! \Carbon\Carbon::parse($permiso->fecha_hasta)->format("d-m-Y") !!}</td>
        @else
        <td></td>
        @endif
        <td class="text-center"> {{$permiso->hora_desde . ' a '. $permiso->hora_hasta}}</td>
        <td>{{$permiso->motivo}}</td>
        <td align="center">
            <a href="{{route('permisos.show', $permiso->id)}}" class="btn btn-info btn-xl"  data-position="top" data-delay="50" data-tooltip="Ver"> Ver</a>   
            <a href="{{url('destroy_permiso', $permiso->id)}}" class="btn btn-danger btn-xl" title="Cancelar" onclick="return confirm ('Está seguro que desea cancelar el permiso?')"data-position="top" data-delay="50" data-tooltip="Cancelar">X</a>
        </td>
    </tr>                    
    @endforeach  
    @endif  
</tbody>
</table>
{{ $permisos->appends($_GET)->links() }}

</div>

@stop