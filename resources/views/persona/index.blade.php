@extends('persona.layouts.layout')

@section('content')

<div class="col-md-12 ml-auto">
    <h1>
        {{ Form::open (['route' => 'persona.index', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
        <div class="form-group"><h6>Nombre:</h6>
            <input type="text" name="nombre" class="form-control" id="nombre" value="{{$nombre}}">
        </div>
        &nbsp
        <div class="form-group"><h6>Empresa:</h6>
            <input type="text" name="empresa" class="form-control" id="empresa" value="{{$empresa}}" >
        </div>
        &nbsp
        <button type="submit" class="btn btn-default"> Buscar contacto</button>
        {{Form::close()}}
    </h1>            
</div>

<div class="col-md-12">             
  <table class="table table-striped table-bordered ">
    <thead>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Empresa</th>
        <th>Telefono</th>
        <th>Celular</th>        
        <th class="text-center">Acciones</th>        
    </thead>

    <tbody>
        @if(count($personas))
        @foreach($personas as $persona)
        <tr>
            <td>{{$persona->nombre}}</td>
            <td>{{$persona->apellido}}</td>
            <td>{{$persona->empresa}}</td>
            <td>{{$persona->telefono}}</td>
            <td>{{$persona->celular}}</td>
            <td align="center">
                <button class="btn btn-info btn-xl" data-nombre="{{$persona->nombre .' '. $persona->apellido}}" data-empresa="{{$persona->empresa}}" data-direccion="{{$persona->direccion}}" data-celular="{{$persona->celular}}"  data-telefono="{{$persona->telefono}}" data-correo="{{$persona->correo}}" data-toggle="modal" data-target="#ver"> Ver</button>

                @if($acceso->solo_lectura != 1)
                <button class="btn btn-primary btn-xl" data-id="{{$persona->id}}" data-nombre="{{$persona->nombre}}" data-apellido="{{$persona->apellido}}" data-direccion="{{$persona->direccion}}" data-empresa="{{$persona->empresa}}" data-interno="{{$persona->interno}}" data-celular="{{$persona->celular}}"  data-telefono="{{$persona->telefono}}" data-correo="{{$persona->correo}}" data-toggle="modal" data-target="#editar"> Editar</button>

                <a href="{{url('destroy_persona', $persona->id)}}" class="btn btn-danger btn-xl" onclick="return confirm ('Está seguro que desea eliminar?')"data-position="top" data-delay="50" data-tooltip="Borrar"> Borrar</a>
                @endif
            </td>
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
           <div class="row">
               <div class="col-md-12" >
                @include('persona.show')    
            </div>               
        </div>
    </div>
</div>
</div>
</div>

<!-- Modal Editar-->
<div class="modal fade" id="editar" role="dialog" align="center">
    <div class="modal-dialog">
       <div class="modal-content">           
        <p class="statusMsg"></p>
        <form action="{{route('persona.update' , ' ')}}" method="POST" autocomplete="off">
            {{ method_field('PUT')}} {{csrf_field()}}
            <div class="modal-body">
               <div class="row">
                   <div class="col-md-12">
                    <input type="hidden" name="id" id="id" value="">
                    @include('persona.edit') 
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </form>                
</div>
</div>
</div>


{{ $personas->appends($_GET)->links() }}
</div>

<script>
  $('#ver').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) 
    var nombre = button.data('nombre') 
    var empresa = button.data('empresa') 
    var direccion = button.data('direccion')
    var telefono = button.data('telefono')
    var celular = button.data('celular')
    var correo = button.data('correo')
    var modal = $(this)

    modal.find('.modal-body #nombre').val(nombre);
    modal.find('.modal-body #empresa').val(empresa);
    modal.find('.modal-body #direccion').val(direccion);
    modal.find('.modal-body #telefono').val(telefono);
    modal.find('.modal-body #celular').val(celular);
    modal.find('.modal-body #correo').val(correo);
})
</script>

<script>
  $('#editar').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) 
    var id = button.data('id')
    var nombre = button.data('nombre')
    var apellido = button.data('apellido') 
    var empresa = button.data('empresa') 
    var direccion = button.data('direccion')
    var telefono = button.data('telefono')
    var interno = button.data('interno')
    var celular = button.data('celular')
    var correo = button.data('correo')
    var modal = $(this)

    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #nombre').val(nombre);
    modal.find('.modal-body #apellido').val(apellido);
    modal.find('.modal-body #empresa').val(empresa);
    modal.find('.modal-body #direccion').val(direccion);
    modal.find('.modal-body #telefono').val(telefono);
    modal.find('.modal-body #interno').val(interno);
    modal.find('.modal-body #celular').val(celular);
    modal.find('.modal-body #correo').val(correo);
})
</script>

@stop
