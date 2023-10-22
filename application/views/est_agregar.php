
<div class="container">
  <div class="row">
    <div class="mb-12">

      <?php
 
          echo form_open_multipart('estudiante/agregarbd');
          ?>


          <div class="mb-3">
            <label class="form-label">Primer Apellido</label>
            <input type="text" class="form-control" name="primerApellido" placeholder="Escriba primer apellido">
          </div>
          <div class="mb-3">
            <label class="form-label">Segundo Apellido</label>
            <input type="text" class="form-control" name="segundoApellido" placeholder="Escriba segundo apellido">
          </div>
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Escriba el nombre">
          </div>
          <div class="mb-3">
            <label class="form-label">Nota</label>
            <input type="text" class="form-control" name="nota" placeholder="Escriba la nota">
          </div>

          <button type="submit" class="btn btn-primary">Agregar</button>

        <?php
        echo form_close();
        ?>
    
  
    
    </div>
  </div>  
  
</div>
