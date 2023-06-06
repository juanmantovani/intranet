  @extends('equipamiento.layouts.layout_usuarios')

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
      <th>Correo</th>
      <th>Acceso a</th>
        <th class="text-center">Acciones</th>       
    </thead>        
    
    <tbody>
      @if(count($usuarios))
      @foreach($usuarios as $usuario) 
      <tr>
        <td>{{$usuario->name}}</td>
        <td>{{$usuario->email}}</td>
        <td>
          @foreach($usuario_accesos as $usuario_acceso)
          @if($usuario->id == $usuario_acceso->id_usuario)     
          {{$usuario_acceso->acceso}}
          @endif
          @endforeach
        </td>
        <td align="center">
          <button class="btn btn-info" data-usuario="{{$usuario->id}}" data-toggle="modal" data-target="#acceso_usuario">Asignar</button>
          <a href="{{url('destroy_usuario', $usuario->id)}}" class="btn btn-danger btn-xl"  onclick="return confirm ('Está seguro que desea eliminar?')"data-position="top" data-delay="50" data-tooltip="Borrar"> Borrar</a>

        </td>
      </tr>                    
      @endforeach  
      @endif  
    </tbody>
  </table>

  <!-- Modal acceso-->
  <div class="modal fade" id="acceso_usuario" role="dialog" align="center" >
    <div class="modal-dialog">
     <div class="modal-content">           
      <p class="statusMsg"></p>
      <div class="container">
        <form action="{{action('EquipamientoController@accesos', '')}}" method="POST" >
          {{csrf_field()}}
          <div class="modal-body">
           <div class="row">
             <div class="col-md-12" >
              <h4 class="headertekst">Asignar acceso</h4>
              <hr>
              <input type="hidden" id="usuario" name="usuario">
              <select class="form-control" name="acceso"  id="acceso"required>
                <option value="">Seleccione acceso</option>
                @if($accesos != null)
                @foreach($accesos as $acceso)
                <option value="{{$acceso->id}}"> {{$acceso->acceso}}</option>
                @endforeach
                @endif
              </select>
              <br>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-info" >Asignar</button>
            </div>
          </div>
        </div>
      </form>                
    </div>
  </div>
</div>
</div>

</div>

<script>
  $('#acceso_usuario').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) 
    var usuario = button.data('usuario') 
    var modal = $(this)

    modal.find('.modal-body #usuario').val(usuario);

  })
</script> 

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

