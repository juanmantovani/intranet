@extends('visita.layouts.layout')

@section('content')

<div class="col-md-12 ml-auto">
    <h1>
        {{ Form::open (['href' => 'visita.consulta', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
        <div class="form-group"><h6>Tarjeta:</h6>
        </div>
        <input type="text" name="tarjeta" class="form-control" id="tarjeta" value="{{$tarjeta}}" >
        &nbsp
        <div class="form-group"><h6>Visitante:</h6>
            <input type="text" name="visitante" class="form-control" id="visitante" value="{{$visitante}}" >
        </div>
        &nbsp
        <div class="form-group"><h6>Visita a:</h6>
            <input type="text" name="visita_a" class="form-control" id="visita_a" value="{{$visita_a}}" >
        </div>
        &nbsp
        <div class="form-group">
            <select class="form-control" name="estado"  id="estado" value="">
                @if($estado == 2 || $estado == null)
                <option value="2" selected>{{'Todas'}} </option>
                <option value="1">{{'Activas'}} </option>
                <option value="0">{{'Finalizadas'}} </option>
                @elseif($estado == 1)
                <option value="2" >{{'Todas'}} </option>
                <option value="1" selected>{{'Activas'}} </option>
                <option value="0">{{'Finalizadas'}} </option>
                @else($estado == 0)
                <option value="2" >{{'Todas'}} </option>
                <option value="1">{{'Activas'}} </option>
                <option value="0" selected>{{'Finalizadas'}} </option>
                @endif
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
        <th>Tarjeta</th>
        <th>Visitante</th>
        <th>Empresa</th>
        <th>Visita a</th>
        <th>Fecha</th>
        <th>Desde</th>
        <th>Hasta</th>
        <th>Estado</th> 
    </thead>  
    <tbody>
        @if(count($visitas))
        @foreach($visitas as $visita) 
        <tr>
            <td>{{$visita->tarjeta}}</td>
            <td>{{$visita->visitante_nombre .' '. $visita->visitante_apellido}}</td>
            <td>{{$visita->empresa}}</td>
            <td>{{$visita->visita_a_nombre .' '. $visita->visita_a_apellido}}</td>
            <td>{!! \Carbon\Carbon::parse($visita->fecha_inicio)->format("d-m-Y") !!}</td>
            <td>{!! \Carbon\Carbon::parse($visita->fecha_inicio)->format("H:i") !!}</td>
            @if($visita->fecha_inicio != $visita->fecha_fin)
            <td>{!! \Carbon\Carbon::parse($visita->fecha_fin)->format("H:i") !!}</td>
            @else
            <td></td>
            @endif
            @if($visita->activa == 1)
            <td><h5>Activa &#10003</h5></td>
            @else
            <td><h5>Finalizada</h5></td>
            @endif
        </tr>                    
        @endforeach  
        @endif  
    </tbody>
</table>
{{ $visitas->appends($_GET)->links() }}

</div>

@stop
