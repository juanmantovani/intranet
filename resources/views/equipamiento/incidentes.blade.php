@extends('equipamiento.layouts.layout')

@section('content')

<div class="col-md-12 ml-auto">
    <h1>
        {{ Form::open (['href' => 'equipamiento.incidentes', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
        <div class="form-group"><h6>Equipamiento:</h6>
        </div>
        <input type="text" name="equipamiento" class="form-control" id="equipamiento" value="{{$equipamiento}}" >
        &nbsp
        <div class="form-group">
            <select class="form-control" name="resuelto"  id="resuelto" value="">
                <option value="2">{{'Todos'}} </option>
                <option value="1">{{'Resuelto'}} </option>
                <option value="0">{{'No Resuelto'}} </option>
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
        <th>Fecha</th>
        <th>Descripción</th>
        <th>Solución</th>
        <th class="text-center">Acciones</th>       
    </thead>  
    <tbody>
        @if(count($incidentes))
        @foreach($incidentes as $incidente) 
        <tr>
            <td>{{$incidente->equipamiento}}</td>
            <td>{!! \Carbon\Carbon::parse($incidente->creado)->format("d-m-Y") !!}</td>
            <td>{{$incidente->descripcion}}</td>
            <td>{{$incidente->solucion}}</td>

            <td align="center">
                
               @if ($incidente->resuelto == 1)
               <h5>Resuelto &#10003</h5>
               
               @else                        
               <!-- Button to trigger modal -->
               <button class="btn btn-success btn-xl" data-id=" {{$incidente->id_i}}" data-toggle="modal" data-target="#modalForm">Resolver</button>

               <!-- Modal -->
               <div class="modal fade" id="modalForm" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">           
                        <p class="statusMsg"></p>
                        <form action="{{ action('EquipamientoController@update_incidente', $incidente->id_i) }}" method="POST">
                            {{csrf_field()}}
                            <div class="col-md-12">
                                <input type="hidden" name="incidente" id="incidente">

                                <div class="input-field col s12 ">Solución:  
                                    
                                    <textarea class="form-control" rows="5" name="solucion" id="solucion" value="{{{ isset($incidente->solucion) ? $incidente->solucion : ''}}}"required></textarea>
                                    <br>
                                </div>
                                <div class="col-md-12">
                                    <input type="checkbox" value="1" checked id="resuelto" name="resuelto">
                                    <label for="resuelto">Resuelto</label>
                                </div>
                            </div>
                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="subitm" class="btn btn-info">Guardar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            @endif
        </td>
    </tr>                    
    @endforeach  
    @endif  
</tbody>
</table>
{{ $incidentes->appends($_GET)->links() }}

</div>

<script>
    $(document).ready(function (e) {
        $('#modalForm').on('show.bs.modal', function(e) {    
            var id = $(e.relatedTarget).data().id;
            $(e.currentTarget).find('#incidente').val(id);
        });
    });
</script>
  


@stop
