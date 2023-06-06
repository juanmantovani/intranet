@extends('equipamiento.layouts.layout')
@section('content')

<div class="col-md-12 ml-auto">
    <h1>
        {{ Form::open (['href' => 'equipamiento.puestos', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
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
        <button type="submit" class="btn btn-default"> Buscar</button>
         {{Form::close()}}
    </h1>            
</div>

<div class="col-md-12">             
  <table class="table table-striped table-bordered ">
    <thead>
        <th>Puesto</th>
        <th>Usuario</th>
        <th>Area</th>
        <th class="text-center">Acciones</th>       
    </thead>  
    <tbody>
        @if(count($puestos))
            @foreach($puestos as $puesto) 
            <tr>
                <td>{{$puesto->desc_puesto}}</td>
                <td>{{$puesto->nombre .' '. $puesto->apellido}}</td>
                <td>{{$puesto->area}}</td>
                <td align="center">
                    <a href="{{url('edit_puesto', $puesto->id_puesto)}}" class="btn btn-info btn-xl"  data-position="top" data-delay="50" data-tooltip="Editar"> Editar</a>
                </td>
            </tr>                    
            @endforeach  
        @endif  
    </tbody>
  </table>
{{ $puestos->appends($_GET)->links() }}

</div>

@stop