@extends('equipamiento.layouts.layout')
@section('content')

<div class="col-md-12 ml-auto">
    <h1>
        {{ Form::open (['route' => 'equipamiento.index', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
        <div class="form-group"><h6>Equipamiento:</h6>
            <input type="text" name="equipo" class="form-control" id="equipo" value="{{$equipo}}" >
        </div>
        &nbsp
        <div class="form-group"><h6>Puesto:</h6>
            <input type="text" name="puesto" class="form-control" id="puesto" value="{{$puesto}}" >
        </div>
        &nbsp
        <div class="form-group"><h6>Usuario:</h6>
            <input type="text" name="usuario" class="form-control" id="usuario" value="{{$usuario}}" >
        </div>
        &nbsp
        <div class="form-group"><h6>Area:</h6>
            <input type="text" name="area" class="form-control" id="area" value="{{$area}}" >
        </div>
        &nbsp
        <div class="form-group"><h6>IP:</h6>
            <input type="text" name="ip" class="form-control" id="ip" value="{{$ip}}" >
        </div>
        &nbsp
        <div class="form-group">
            <select class="form-control" name="tipo"  id="tipo" value="{{{ isset($tipo_equipamiento->equipamiento) ? $equipamiento->tipo : ''}}}">
                <option value="0">{{'Todos'}} </option>
                @foreach($tipo_equipamiento as $tipo_equipamiento)
                <option value="{{$tipo_equipamiento->id}}">{{$tipo_equipamiento->equipamiento}} </option>
                @endforeach
            </select>                  
        </div>
        &nbsp
        <button type="submit" class="btn btn-default"> Buscar</button>
        {{Form::close()}}
    </h1>            
</div>

<div class="col-md-12">             
  <table class="table table-striped table-bordered ">
    <thead>
        <th>Equipamiento</th>
        <th>Puesto</th>
        <th>Usuario</th>
        <th>Area</th>
        <th>IP</th>
        <th>Observaciones</th>
        @if($acceso->solo_lectura != 1)
        <th class="text-center">Acciones</th>
        @endif       
    </thead>  
    <tbody>
        @if(count($equipamientos))
        @foreach($equipamientos as $equipamiento) 
        <tr>
            <td> {{$equipamiento->id_equipamiento}}</td>
            <td>{{$equipamiento->puesto}}</td>
            <td>{{$equipamiento->nombre .' '. $equipamiento->apellido}}</td>
            <td>{{$equipamiento->area}}</td>
            <td>{{$equipamiento->ip}}</td>
            <td>{{$equipamiento->obs}}</td>
            <!-- Oculta botones si el usuario logueado tiene permisos de solo lectura-->
            @if($acceso->solo_lectura != 1)
            <td align="center">
                <a href="{{route('equipamiento.edit', $equipamiento->id_equipamiento)}}" class="btn btn-info btn-xl" data-position="top" data-delay="50" data-tooltip="Editar"> Editar</a>
                @if ($equipamiento->relacion != null)
                <a href="{{url('destroy_relacion', $equipamiento->relacion)}}" class="btn btn-danger btn-xl" title="Borrar" onclick="return confirm ('Está seguro que desea eliminar la relación?')"data-position="top" data-delay="50" data-tooltip="Borrar"> X</a>
                @else
                <a href="{{url('/relacion', $equipamiento->id_equipamiento)}}" class="btn btn-success btn-xl" title="Asignar" data-position="top" data-delay="50" data-tooltip="Asignar"> +</a>
                @endif
                <a href="{{url('/create_incidente', $equipamiento->id_equipamiento)}}" class="btn btn-warning btn-xl" title="Incidente" data-position="top" data-delay="50" data-tooltip="Incidente"> !</a>
            </td>
            @endif
        </tr>                    
        @endforeach  
        @endif  
    </tbody>
</table>
{{ $equipamientos->appends($_GET)->links() }}

</div>

@stop