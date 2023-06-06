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

      <h2 class="headertekst">Asignar tarjeta</h2>
      <hr>
    </div>
  </div>
  
  <div class="row"> 
    <div class="col-md-3 field-label-responsive"></div>
    <div class="col-md-6">
      <div class="form-group has-danger">
        <form action="{{ action('VisitaController@store') }}" method="POST">
          {{csrf_field()}}
          <input type="hidden" name="id">

          <div class="input-field col s12 ">Tarjeta:
            <select class="form-control" id="tarjeta" name="tarjeta" required>
             <option value="">Seleccione una tarjeta</option>
             @foreach($tarjetas as $tarjetas)
             <option>{{$tarjetas->id_tar}}</option>
             @endforeach
           </select>
           <br>
         </div>

         <div class="input-field col s12 ">Empresa:
          <select class="form-control" name="empresa"  id="empresa" required>
           <option value="">Seleccione empresa</option>
           @foreach($empresas as $empresas)
           <option value="{{$empresas->id_emp}}">{{$empresas->razon_social}}</option>
           @endforeach
         </select>
         <a href=# data-toggle="modal" data-target="#añadir_empresa"> Añadir empresa</a>
       </div>
       <br>
       <div class="input-field col s12 ">Persona:
        <select class="form-control" name="externo"  id="externo" required>
          <option value="1">Seleccione persona</option>
        </select>
        <a href=# data-toggle="modal" data-empresa="empresa" data-target="#añadir_externo"> Añadir persona</a>
      </div>
      <br>  
      <div class="input-field col s12 ">Visita a:
        <select class="form-control" name="interno"  id="interno" required>
         <option value="">Seleccione a quien visita</option>
         @foreach($internos as $internos)
         <option value="{{$internos->id_p}}">{{$internos->apellido.' '.$internos->nombre_p}}</option>
         @endforeach
       </select>
     </div>         
     <br>
     <div class="row">
      <div class="col-md-3 field-label-responsive"></div>
      <div class="col-md-1"></div>
      <a class="btn btn-secondary " href="visitas">Volver</a>
      &nbsp
      <button type="subitm" class="btn btn-info">Guardar</button>
    </div>
  </div>
  <br>
</form>
</div>
</div>

<div id="footer-lafedar">
</div>

<!-- Modal Añadir_empresa-->
<div class="modal fade" id="añadir_empresa" role="dialog" align="center">
  <div class="modal-dialog">
   <div class="modal-content">           
    <p class="statusMsg"></p>
    <div class="container">
      <form action="{{action('VisitaController@añadir_empresa', '')}}" method="POST" >
        {{csrf_field()}}
        <div class="modal-body">
         <div class="row">
           <div class="col-md-12">
             <h4 class="headertekst">Agregar Empresa</h4>
             <hr>
             <label for="title">Razón Social:</label>
             <input class="form-control" type="text" name="razon_social" required>
             <br>
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
             <button type="submit" class="btn btn-info" >Añadir</button>
           </div>
         </div>
       </div>
     </form>                
   </div>
 </div>
</div>
</div>

<!-- Modal Añadir_externo-->
<div class="modal fade" id="añadir_externo" role="dialog" align="center" >
  <div class="modal-dialog">
   <div class="modal-content">           
    <p class="statusMsg"></p>
    <div class="container">
      <form action="{{action('VisitaController@añadir_externo', '')}}" method="POST" >
        {{csrf_field()}}
        <div class="modal-body">
         <div class="row">
           <div class="col-md-12" >
            <h4 class="headertekst">Agregar Persona </h4>
            <hr>
            <input type="hidden" id="empresa_ext" name="empresa_ext">
            <label for="title">DNI:</label>
            <input class="form-control" type="text" id="dni" name="dni" required>
            <br>
            <label for="title">Nombre:</label>
            <input class="form-control" type="text" id="nombre_ext" name="nombre_ext" required>
            <br>
            <label for="title">Apellido:</label>
            <input class="form-control" type="text" id="apellido_ext" name="apellido_ext" required>
            <br>
            <label for="title">Telefono:</label>
            <input class="form-control" type="text" id="telefono_ext" name="telefono_ext">
            <br>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-info" >Añadir</button>
          </div>
        </div>
      </div>
    </form>                
  </div>
</div>
</div>
</div>


<script>
  $("#empresa").change(function(){
    var empresa = $(this).val();
    $.get('ExternoByEmpresa/'+empresa, function(data){
//esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
console.log(data);
var externo
if(externo = null){
  externo+='<option value="">Seleccione persona</option>';
}
else{
for (var i=0; i<data.length;i++)
  externo+='<option value="'+data[i].dni+'">'+data[i].nombre_ext+' '+ data[i].apellido_ext+'</option>';
}
$("#externo").html(externo);

});
  });
  
</script>

<script>
  $('#añadir_externo').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) 
    var empresa = document.getElementById("empresa").value 
    var modal = $(this)

    modal.find('.modal-body #empresa_ext').val(empresa);
  })
</script>


@stop