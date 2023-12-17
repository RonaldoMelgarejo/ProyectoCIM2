<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card" id="userListCard">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Nuevo Aviso de Cobranza</h4>
                        </div>
                        <!--
                        <a href="<?php echo base_url();?>index.php/monitoreo/listaDispositivopdf" target="_blank"  >
                            <button type="submit" class="text-center btn btn-success btn-icon mt-lg-0 mt-md-0 mt-3">Generar Informe</button>  
                        </a>
                        <a href="#" class="text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="btn-inner">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </i>
                            <span>Nuevo Dispositivo</span>
                        </a>
                        -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Agregar Dispositivo</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="<?php echo site_url('dispositivo/registrarChipID'); ?>">
                                            <input type="hidden" name="idUsuario" value="<?php echo $this->session->userdata('idusuario'); ?>">
                                            <div class="form-group">
                                                <label class="form-label">Codigo</label>
                                                <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Intorducir ChipID">
                                            </div>
                                            <div class="text-start">
                                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Guardar</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
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
                                    <!-- <th>Ubicacion</th> -->
                                    <th>Email</th>
                                    <!-- <th>Fecha Registro</th> -->
                                    <th>Estado</th>
                                    <!-- <th>Fecha Instalacion</th> -->
                                    <!-- <th>Potencia</th> -->
                                    <th style="min-width: 100px">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $indice=1; //le damos valor al indice para no mostrar el id

                                        foreach($clientes->result() as $row){  //$estudiante se rescata del controlador estudiante con el mismo nombre que esta en el array asociativo $row solo es una variable que almacena datos 
                                        ?>

                                        <tr>
                                            <th scope="row"><?php echo $indice; ?></th>
                                            <td><?php echo $row->codigo; ?></td>   <!--nombre es el parametro de BD y debe ser escrito como en la BD y $row es el dato almacenado momentaneamente-->
                                            <td><?php echo $row->nombre . ' ' . $row->primerApellido . ' ' . $row->segundoApellido; ?></td>
                                            <!-- <td><?php echo $row->ubicacion; ?></td> -->
                                            <td><?php echo $row->email; ?></td>
                                            <!-- <td><?php echo formatearFecha($row->fechaRegistro); ?></td> -->
                                            <td>
                                                <?php if ($row->estado_dispositivo == 1): ?>
                                                    <span class="badge bg-primary">Activo</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">Inactivo</span>
                                                <?php endif; ?>
                                            </td>
                                            <!-- <td><?php echo ($row->fechaInstalacion != null) ? formatearFecha($row->fechaInstalacion) : ''; ?></td> -->

                                            <!-- <td><?php echo $row->suma_potencia; ?></td> -->

                                                                                        
                                            <td>
                                                <div class="d-flex align-items-center list-user-action">
                                                    
                                                    <?php
                                                    echo form_open_multipart('factura/detalles');
                                                    ?>
                                                    <input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario; ?>">
                                                    <input type="hidden" name="idDispositivo" value="<?php echo $row->dispositivoID; ?>">
                                                    <button  id="generarFacturaBtn" class="btn btn-sm btn-icon btn-success me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Generar">
                                                        <span class="btn-inner">
                                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7366 2.76175H8.08455C6.00455 2.75375 4.29955 4.41075 4.25055 6.49075V17.3397C4.21555 19.3897 5.84855 21.0807 7.89955 21.1167C7.96055 21.1167 8.02255 21.1167 8.08455 21.1147H16.0726C18.1416 21.0937 19.8056 19.4087 19.8026 17.3397V8.03975L14.7366 2.76175Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M14.4741 2.75V5.659C14.4741 7.079 15.6231 8.23 17.0431 8.234H19.7971" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M14.2936 12.9141H9.39355" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M11.8442 15.3639V10.4639" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                    </button>
                                                    <?php
                                                    echo form_close();
                                                    ?> 
                                                    
                                                    <!--
                                                    <?php
                                                    echo form_open_multipart('dispositivo/');
                                                    ?>
                                                    <input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario; ?>">
                                                    <button type="submit" class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver">
                                                        <span class="btn-inner">
                                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1614 12.0531C15.1614 13.7991 13.7454 15.2141 11.9994 15.2141C10.2534 15.2141 8.83838 13.7991 8.83838 12.0531C8.83838 10.3061 10.2534 8.89111 11.9994 8.89111C13.7454 8.89111 15.1614 10.3061 15.1614 12.0531Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.998 19.355C15.806 19.355 19.289 16.617 21.25 12.053C19.289 7.48898 15.806 4.75098 11.998 4.75098H12.002C8.194 4.75098 4.711 7.48898 2.75 12.053C4.711 16.617 8.194 19.355 12.002 19.355H11.998Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                    </button>
                                                    <?php
                                                    echo form_close();
                                                    ?>
                                                    -->
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

                <!--
                <div class="card" id="facturaCard" style="display: none;">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Factura</h4>
                        </div>
                    </div>
                    <div class="card-body">
                            <form method="POST" action="<?php echo site_url('dispositivo/registrardispositivo'); ?>">
                                <!-- <input type="hidden" name="idUsuario" value="<?php echo $this->session->userdata('idusuario'); ?>"> 
                                <div class="row">

                                    <div class="form-group col-md-2">
                                        <label class="form-label">Código:</label>
                                        <input type="text" class="form-control" id="codigo" name="codigo" placeholder="" value="<?php echo $row->codigo; ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="form-label">Fecha:</label>
                                        <input type="text" class="form-control" id="fechaEmision" name="fechaEmision" placeholder="" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="fname">Lectura Anterior:</label>
                                        <input type="text" class="form-control" id="lanterior" name="lanterior" placeholder="" value=""readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="lname">Lectura Actual:</label>
                                        <input type="text" class="form-control" id="lactual" name="lactual" placeholder="" value="" value="" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="fname">Nombre:</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="" value="<?php echo $row->nombre; ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="lname">Primer Apellido:</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="<?php echo $row->primerApellido; ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="lname">Segundo Apellido:</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="<?php echo $row->segundoApellido; ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-4 address">
                                        <label class="form-label" for="add">Dirección:</label>
                                        <input type="text" class="form-control" id="add" name="add" placeholder="" value="<?php echo $row->nombre; ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-3 address">
                                        <label class="form-label" for="add">Monto Total:</label>
                                        <input type="text" class="form-control" id="total" name="total" placeholder="" readonly>
                                    </div>                                    
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">Registrar / Enviar</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
                -->
            </div>
        </div>
    </div>
</div>

<!-- Agrega este script al final de tu página antes de cerrar el body -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Maneja el clic en cualquier botón con la clase "generarFacturaBtn"
        $(".generarFacturaBtn").click(function (e) {
            // Evita el comportamiento predeterminado del botón (enviar formulario)
            e.preventDefault();

            // Obtén la fila padre del botón clicado
            var fila = $(this).closest('tr');

            // Obtén los valores específicos de la fila, por ejemplo:
            var idUsuario = fila.find('[name="idUsuario"]').val();
            var idDispositivo = fila.find('[name="idDispositivo"]').val();

            // Oculta el card de la tabla
            $("#userListCard").hide();
            
            // Muestra el card de la factura
            $("#facturaCard").show();
            
            // Resto del código...
        });
    });
</script>

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