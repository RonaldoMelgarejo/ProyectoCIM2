
<div class="container">
  <div class="row">
    <div class="mb-12">

      <?php

        foreach($infoestudiante->result() as $row){  //$estudiante se rescata del controlador estudiante con el mismo nombre que esta en el array asociativo $row solo es una variable que almacena datos 
          echo form_open_multipart('estudiante/modificarbd');
          ?>

          <input type="hidden" name="idEstudiante" value="<?php echo $row->idEstudiante; ?>">

          <div class="mb-3">
            <label class="form-label">Primer Apellido</label>
            <input type="text" class="form-control" name="primerApellido" value="<?php echo $row->primerApellido; ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Segundo Apellido</label>
            <input type="text" class="form-control" name="segundoApellido" value="<?php echo $row->segundoApellido; ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?php echo $row->nombre; ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Nota</label>
            <input type="text" class="form-control" name="nota" value="<?php echo $row->nota; ?>">
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>

        <?php
        echo form_close();
        }
        ?>
    
  
    
    </div>
  </div>  
  
</div>
