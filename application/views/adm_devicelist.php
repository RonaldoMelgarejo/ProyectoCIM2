<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Lista de Dispositivos</h4>
                        </div>

                        <a href="<?php echo base_url();?>index.php/monitoreo/listaDispositivopdf" target="_blank"  >
                            <button type="submit" class="text-center btn btn-success btn-icon mt-lg-0 mt-md-0 mt-3">Generar Informe</button>  
                        </a>                       

                        <!--
                        <div class="form-group">
                            <input type="text" id="dateRange" class="form-control" placeholder="Rango de Fechas">
                            
                            <div class="input-group-append">
                                <span class="input-group-text">
                                <i class="fa fa-calendar"></i>
                                </span>
                            </div> 
                            <label for="fechaInicio">Fecha de Inicio:</label>
                            <input type="text" id="fechaInicio" class="form-control" readonly>

                            <label for="fechaFinal">Fecha Final:</label>
                            <input type="text" id="fechaFinal" class="form-control" readonly>
                        </div>
                        -->
                        <a href="#" class="text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="btn-inner">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </i>
                            <span>Nuevo Dispositivo</span>
                        </a>
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="staticBackdropLabel">Agregar Dispositivo</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="<?php echo site_url('dispositivo/registrarChipID'); ?>">
                                            <input type="hidden" name="idUsuario" value="<?php echo $this->session->userdata('idusuario'); ?>">
                                            <div class="form-group">
                                                <label class="form-label">Codigo</label>
                                                <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Intorducir ChipID">
                                            </div>
                                            <div class="text-start text-center">
                                                <button type="submit" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Guardar</button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                            </div>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body px-0">
                        <div class="table-responsive text-center">
                            <table id="user-list-table" class="table table-striped" role="grid" data-bs-toggle="data-table">
                                <thead>
                                    <tr class="ligth">
                                    <th>Nro.</th>
                                    <th>Dispositivo</th>
                                    <th>Propietario</th>
                                    <th>Ubicacion</th>
                                    <th>Email</th>
                                    <th>Fecha Registro</th>
                                    <th>Estado</th>
                                    <th>Fecha Instalacion</th>
                                    <th>Potencia</th>
                                    <th style="min-width: 100px">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $indice=1; //le damos valor al indice para no mostrar el id

                                        foreach($dispositivos->result() as $row){  //$estudiante se rescata del controlador estudiante con el mismo nombre que esta en el array asociativo $row solo es una variable que almacena datos 
                                        ?>

                                        <tr>
                                            <th scope="row"><?php echo $indice; ?></th>
                                            <td><?php echo $row->codigo; ?></td>   <!--nombre es el parametro de BD y debe ser escrito como en la BD y $row es el dato almacenado momentaneamente-->
                                            <td><?php echo $row->nombre . ' ' . $row->primerApellido . ' ' . $row->segundoApellido; ?></td>
                                            <td><?php echo $row->ubicacion; ?></td>
                                            <td><?php echo $row->email; ?></td>
                                            <td><?php echo formatearFecha($row->fechaRegistro); ?></td>
                                            <td>
                                                <?php if ($row->estado_dispositivo == 1): ?>
                                                    <span class="badge bg-success">Activo</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">Inactivo</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo ($row->fechaInstalacion != null) ? formatearFecha($row->fechaInstalacion) : ''; ?></td>

                                            <!-- <td><?php echo $row->suma_potencia; ?></td> -->

                                            <td id="potencia-<?php echo $row->dispositivoID; ?>"><?php echo $row->suma_potencia; ?></td>

                                                                                        
                                            <td>
                                                <div class="d-flex align-items-center list-user-action">
                                                    
                                                    <?php
                                                    echo form_open_multipart($row->estado_dispositivo == 1 ? 'dispositivo/deshabilitarbdAdm' : 'dispositivo/habilitarbdAdm');
                                                    ?>
                                                    <input type="hidden" name="idDispositivo" value="<?php echo $row->dispositivoID; ?>">
                                                    <button type="submit" class="btn btn-sm btn-icon btn-warning me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $row->estado_dispositivo == 1 ? 'Deshabilitar' : 'Habilitar'; ?>">
                                                        <span class="btn-inner">
                                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <?php if ($row->estado_dispositivo == 1): ?>
                                                                    <path d="M9.76045 14.3667C9.18545 13.7927 8.83545 13.0127 8.83545 12.1377C8.83545 10.3847 10.2474 8.97168 11.9994 8.97168C12.8664 8.97168 13.6644 9.32268 14.2294 9.89668" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    <path d="M15.1049 12.6987C14.8729 13.9887 13.8569 15.0067 12.5679 15.2407" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    <path d="M6.65451 17.4722C5.06751 16.2262 3.72351 14.4062 2.74951 12.1372C3.73351 9.85823 5.08651 8.02823 6.68351 6.77223C8.27051 5.51623 10.1015 4.83423 11.9995 4.83423C13.9085 4.83423 15.7385 5.52623 17.3355 6.79123" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    <path d="M19.4473 8.99072C20.1353 9.90472 20.7403 10.9597 21.2493 12.1367C19.2823 16.6937 15.8063 19.4387 11.9993 19.4387C11.1363 19.4387 10.2853 19.2987 9.46729 19.0257" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    <path d="M19.8868 4.24951L4.11279 20.0235" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <?php else: ?>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1614 12.0531C15.1614 13.7991 13.7454 15.2141 11.9994 15.2141C10.2534 15.2141 8.83838 13.7991 8.83838 12.0531C8.83838 10.3061 10.2534 8.89111 11.9994 8.89111C13.7454 8.89111 15.1614 10.3061 15.1614 12.0531Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.998 19.355C15.806 19.355 19.289 16.617 21.25 12.053C19.289 7.48898 15.806 4.75098 11.998 4.75098H12.002C8.194 4.75098 4.711 7.48898 2.75 12.053C4.711 16.617 8.194 19.355 12.002 19.355H11.998Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <?php endif; ?>
                                                            </svg>
                                                        </span>
                                                    </button>
                                                    <?php
                                                    echo form_close();
                                                    ?>
                                                    
                                                    <?php
                                                    echo form_open_multipart('dispositivo/eliminarbd');
                                                    ?>
                                                    <input type="hidden" name="idDispositivo" value="<?php echo $row->dispositivoID; ?>">
                                                    <button type="submit" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar">
                                                        <span class="btn-inner">
                                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                                <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                    </button>
                                                    <?php
                                                    echo form_close();
                                                    ?>
                                                    
                                                </div>
                                            </td>

                                        </tr>

                                        <?php
                                        $indice++;
                                        }
                                    ?>  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script de flashdata -->
<script>
    // Agregar verificación de mensajes de sesión y mostrarlos
    var mensajeExito = "<?php echo $this->session->flashdata('success'); ?>";
    var mensajeError = "<?php echo $this->session->flashdata('error'); ?>";

    function showAlert(type, message) {
        toastr.options = {
            "positionClass": "toast-bottom-right" // Configura la posición del toast
        };

        toastr[type](message);

        // Desaparecer después de 3 segundos
        setTimeout(function () {
            toastr.clear();
        }, 3000);
    }

    function mostrarToast(type, message) {
        showAlert(type, message);
    }

    if (mensajeExito) {
        // Muestra el mensaje de éxito (puedes personalizar el estilo)
        mostrarToast('success', mensajeExito);
    }

    if (mensajeError) {
        // Muestra el mensaje de error (puedes personalizar el estilo)
        mostrarToast('error', mensajeError);
    }
</script>






<!-- Funcional sin AJAX
<script>
    document.addEventListener('DOMContentLoaded', function () {
      const dateRangePicker = flatpickr("#dateRange", {
        mode: 'range',
        dateFormat: "Y-m-d",
        locale: "es",
        onChange: function (selectedDates, dateStr, instance) {
          // Verificar si hay al menos una fecha seleccionada
          if (selectedDates.length >= 1) {
            // Asignar la primera fecha tanto a fechaInicio como a fechaFinal
            document.getElementById('fechaInicio').value = selectedDates[0].toISOString().split('T')[0];
            document.getElementById('fechaFinal').value = selectedDates[selectedDates.length - 1].toISOString().split('T')[0];
          }
        }
      });
    });
</script>
-->
<!--
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const dateRangePicker = flatpickr("#dateRange", {
      mode: 'range',
      dateFormat: "Y-m-d",
      locale: "es",
      onChange: function (selectedDates, dateStr, instance) {
        if (selectedDates.length >= 1) {
          const fechaInicio = selectedDates[0].toISOString().split('T')[0];
          const fechaFinal = selectedDates[selectedDates.length - 1].toISOString().split('T')[0];

          console.log("Inicio: " +fechaInicio);
          console.log("Final: " +fechaFinal);
          // Realizar solicitud AJAX
          $.ajax({
            url: '<?php echo base_url('index.php/monitoreo/actualizarPotencia'); ?>', // Reemplaza 'URL_DEL_CONTROLADOR' con la URL real de tu controlador
            type: 'POST',
            data: { fechaInicio: fechaInicio, fechaFinal: fechaFinal },
            success: function (response) {
              // Actualizar la potencia en la tabla
              $('#potencia-' + response.dispositivoID).html(response.suma_potencia);
            },
            error: function () {
              console.log('Error al realizar la solicitud AJAX');
            }
          });
        }
      }
    });
  });
</script>
-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dateRangePicker = flatpickr("#dateRange", {
            mode: 'range',
            dateFormat: "Y-m-d",
            locale: "es",
            onChange: function (selectedDates, dateStr, instance) {
                // Verificar si hay al menos una fecha seleccionada
                if (selectedDates.length >= 1) {
                    // Asignar la primera fecha tanto a fechaInicio como a fechaFinal
                    const fechaInicio = selectedDates[0].toISOString().split('T')[0];
                    const fechaFinal = selectedDates[selectedDates.length - 1].toISOString().split('T')[0];

                    console.log("Inicio: " + fechaInicio);
                    console.log("Final: " + fechaFinal);

                    // Realizar solicitud AJAX
                    $.ajax({
                        url: '<?php echo base_url('index.php/monitoreo/actualizarPotencia'); ?>',
                        type: 'POST',
                        data: { fechaInicio: fechaInicio, fechaFinal: fechaFinal },
                        success: function (response) {
                            // Actualizar la potencia en la tabla
                            $('#potencia-' + response.dispositivoID).html(response.suma_potencia);
                        },
                        error: function () {
                            console.log('Error al realizar la solicitud AJAX');
                        }
                    });
                }
            }
        });
    });
</script>
