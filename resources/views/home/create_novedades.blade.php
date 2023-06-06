
          <input type="hidden" name="id" value="{{{ isset($novedad->id_p) ? $novedad->id_p : ''}}}">
          <div class="form-row col-md-12">

            <div class="col-md-6" align="center">Fecha desde:
            <input type="date" name="fecha_desde" class="form-control" step="1" min="2019-01-01" value="<?php echo date("Y-m-d");?>">
            </div>

            <div class="col-md-6" align="center">Fecha hasta:
            <input type="date" name="fecha_hasta" class="form-control" step="1" min="2019-01-01" value="<?php echo date("Y-m-d");?>">
            </div>
          </div>
          <br>
          <div class="input-field col s12 ">Descripción:
            <textarea class="form-control" rows="5" name="descripcion" id="descripcion" required></textarea>
          </div>
          <br>
          <div class="col-md-6">
            <input type="checkbox" value="1" checked id="enviar_correo" name="enviar_correo">
            <label for="enviar_correo">Enviar correos</label>
          </div>