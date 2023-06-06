@extends('medico.layouts.layout')

@section('content')

<style type="text/css">
  h2.headertekst {
    text-align: center;
  }
</style>

<div class="container">
  <div class="row">
    <div class="col-12">
      <h2 class="headertekst">Historia clinica</h2>
      <hr>
    </div>
  </div>
  
  <div class="row"> 
    <div class="form-group has-danger col 12">
       <form action="" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="id" id="id" value="">

        <div class="row">
          <div class="col-4"></div>
          <div class="input-field col-4"><strong>Paciente</strong>
            <select class="form-control"name="paciente"  id="paciente" required>
              @foreach($personas as $personas)
              <option value="{{$personas->id_p}}">{{$personas->apellido}}&nbsp{{$personas->nombre_p}} </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row">     
          <div class="input-field col-4"><strong>Estado civil</strong>
            <input type="text" name="estado_civil" class="form-control" id="estado_civil" required>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="input-field col-12"><strong>Consumo de sustancias</strong>
           <div class="col-6">
            <label for="tabaquismo">Fuma</label>
            <input type="checkbox" value="0" id="tabaquismo" name="tabaquismo">
            &nbsp
            <label for="alcohol">Bebe alcohol</label>
            <input type="checkbox" value="0" id="alcohol" name="alcohol">

            &nbsp
            <label for="drogas">Consumió drogas</label>
            <input type="checkbox" value="0" id="drogas" name="drogas">
          </div>
        </div>
      </div>
      <br>

      <div class="row">
        <div class="input-field col-4 "><strong>Actividad física:</strong>
          <br>
          <textarea class="form-control" rows="4" name="act_fis" id="act_fis" ></textarea>
        </div>
        <br>
        <div class="input-field col-4 "><strong>Antecedentes personales</strong>
          <textarea class="form-control" rows="4" name="ant_per" id="ant_per" ></textarea>
          <br>
        </div>
        <div class="input-field col-4 "><strong>Antecedentes familiares</strong>
          <textarea class="form-control" rows="4" name="ant_fam" id="ant_fam" ></textarea>
        </div>
      </div>

      <div class="row">
        <div class="input-field col-4 "><strong>Internaciones/operaciones/accidentes</strong>
          <br>
          <textarea class="form-control" rows="4" name="int_ope_acc" id="int_ope_acc" ></textarea>
        </div>
        <br>
        <div class="input-field col-4 "><strong>Alergia a medicamentos</strong>
          <textarea class="form-control" rows="4" name="alergia" id="alergia" ></textarea>
          <br>
        </div>
        <div class="input-field col-4 "><strong>Observaciones</strong>
          <textarea class="form-control" rows="4" name="obs" id="obs" ></textarea>
        </div>
      </div>

      <br>
      <div class="row">
        <div class="col-md-5"></div>
        <a class="btn btn-secondary " href="{{ URL::previous() }}">Volver</a>
        &nbsp
      </div>
    </div>
    <br>
  </form>
</div>
</div>



@stop