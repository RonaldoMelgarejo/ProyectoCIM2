<div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Energia Generada</h4>
               </div>
               <!--
               <a href="<?php echo base_url();?>index.php/monitoreo/energiageneradapdf" target="_blank">
                  <button type="submit" class="btn btn-success btn-block">Generar Informe</button>
               </a>
               -->
               <a href="#" class="text-center btn btn-success btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                  <span>Generar Informe</span>
               </a>

               <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Seleccione ChipID</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <form id="miFormulario" method="POST" action="<?php echo base_url();?>index.php/monitoreo/energiageneradapdf" target="_blank">
                                 <input type="hidden" name="idUsuario" value="<?php echo $this->session->userdata('idusuario'); ?>">
                                 <input type="hidden" name="dispositivoSeleccionado" id="dispositivoSeleccionado" value="">
                                 <input type="hidden" name="nombreDispositivoSeleccionado" id="nombreDispositivoSeleccionado" value="">
                                 <div class="form-group">
                                       <!-- <label class="form-label"></label> 
                                       <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Dispositivo">
                                       -->
                                       <label for="dispositivos">Dispositivos Registrados</label>
                                       <select class="form-control" id="dispositivos" name="dispositivos">
                                          <!-- Opciones se cargarán dinámicamente con JavaScript -->
                                       </select>
                                 </div>
                                 <div class="text-start">
                                       <button type="submit" id="botonGenerar" class="btn btn-primary" data-bs-dismiss="modal">Generar</button>
                                       <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                 </div>
                              </form>
                           </div>
                     </div>
                  </div>
               </div>
               
            </div>
            <div class="card-body">
               <!-- <p>Images in Bootstrap are made responsive with <code>.img-fluid</code>. <code>max-width: 100%;</code> and <code>height: auto;</code> are applied to the image so that it scales with the parent element.</p> -->
               <div class="table-responsive">
                  <table id="tablePotencia" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>Nro</th>
                           <th>Dispositivo</th>
                           <th>Voltaje [V]</th>
                           <th>Corriente [A]</th>
                           <th>Potencia [W]</th>
                           <th>Fecha y Hora</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $indice=1; //le damos valor al indice para no mostrar el id

                           foreach($medicion->result() as $row){  //$estudiante se rescata del controlador estudiante con el mismo nombre que esta en el array asociativo $row solo es una variable que almacena datos 
                           ?>

                           <tr>
                              <th scope="row"><?php echo $indice; ?></th>
                              <th><?php echo $row->codigoDispositivo; ?></th>
                              <td><?php echo $row->voltaje; ?></td>   <!--nombre es el parametro de BD y debe ser escrito como en la BD y $row es el dato almacenado momentaneamente-->
                              <td><?php echo $row->corriente; ?></td>
                              <td><?php echo $row->potencia; ?></td>
                              <td><?php echo formatearFecha($row->fechaHoraMedicion); ?></td>
                           </tr>

                           <?php
                           $indice++;
                           }
                        ?>  
                     </tbody>
                     <tfoot>
                        <tr>
                           <th>Nro</th>
                           <th>Dispositivo</th>
                           <th>Voltaje [V]</th>
                           <th>Corriente [A]</th>
                           <th>Potencia [W]</th>
                           <th>Fecha y Hora</th>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
      </div>

      <script>
        $(document).ready(function() {
         var table = $('#tablePotencia').DataTable();
         table.destroy();

         // Luego, puedes inicializar la tabla nuevamente
         $('#tablePotencia').DataTable({
            "language": {
               "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
         });
        });
      </script>

      <!-- Agrega este script al final de tu vista -->
<script>
    $(document).ready(function () {
        // Inicializar el combo con una opción en blanco
        var dispositivosCombo = $('#dispositivos');
        dispositivosCombo.empty();
        dispositivosCombo.append($('<option>').text('').attr('value', ''));

        console.log("Id: "+dispositivosCombo);
        // Hacer una petición AJAX para obtener los dispositivos del usuario
        var idUsuario = <?php echo $this->session->userdata('idusuario'); ?>;
        $.ajax({
            type: 'GET',
            url: '<?php echo site_url('usuario/obtenerDispositivos/') ?>' + idUsuario,
            dataType: 'json',
            success: function (response) {
                // Llenar dinámicamente el combobox con los dispositivos del usuario
                $.each(response, function (index, dispositivo) {
                    dispositivosCombo.append($('<option>').text(dispositivo.codigo).attr('value', dispositivo.id));
                });
            },
            error: function () {
                console.log('Error al obtener dispositivos del usuario.');
            }
        });

        // Evento para capturar el valor del dispositivo seleccionado
        dispositivosCombo.on('change', function () {
            var dispositivoSeleccionado = $(this).val();
            $('#dispositivoSeleccionado').val(dispositivoSeleccionado);

            // Deshabilitar el botón Generar Informe si se selecciona la opción en blanco
            var botonGenerar = $('#botonGenerar');
            botonGenerar.prop('disabled', dispositivoSeleccionado === '');
        });

        // Evento que se dispara cuando el modal se muestra
        $('#staticBackdrop').on('show.bs.modal', function () {
            // Deshabilitar el botón Generar Informe si se selecciona la opción en blanco
            var botonGenerar = $('#botonGenerar');
            botonGenerar.prop('disabled', dispositivosCombo.val() === '');
        });

        // Evento que se dispara cuando el modal se oculta
        $('#staticBackdrop').on('hidden.bs.modal', function () {
            // Resetear el formulario y deshabilitar el botón nuevamente
            $('#miFormulario')[0].reset();
            botonGenerar.prop('disabled', true);
        });
    });
</script>
