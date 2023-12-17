<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card" id="userListCard">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Lista de Avisos de Cobranza</h4>
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
                                    <th>Fecha Emision</th>
                                    <th>Dispositivo</th>
                                    <th>Propietario</th>
                                    <th>Mes</th>
                                    <th>Consumo [KWH]</th>
                                    <th>Monto [Bs]</th>
                                    <!-- <th>Fecha Registro</th> -->
                                    <th>Pago</th>
                                    <!-- <th>Fecha Instalacion</th> -->
                                    <!-- <th>Potencia</th> -->
                                    <th style="min-width: 100px">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $indice=1; //le damos valor al indice para no mostrar el id

                                        foreach($facturas->result() as $row){  //$estudiante se rescata del controlador estudiante con el mismo nombre que esta en el array asociativo $row solo es una variable que almacena datos 
                                        ?>

                                        <tr>
                                            <th scope="row"><?php echo $indice; ?></th>
                                            <td><?php echo $row->fechaEmision; ?></td>
                                            <td><?php echo $row->codigo; ?></td>   <!--nombre es el parametro de BD y debe ser escrito como en la BD y $row es el dato almacenado momentaneamente-->
                                            <td><?php echo $row->nombre . ' ' . $row->primerApellido . ' ' . $row->segundoApellido; ?></td>
                                            <td><?php echo $row->detallesFactura . ' / ' . $row->anioMes; ?></td> 
                                            <td><?php echo $row->consumoMes; ?></td>
                                            <td><?php echo $row->montoTotal; ?></td> 
                                            <!-- <td><?php echo formatearFecha($row->fechaRegistro); ?></td> -->
                                            <td>
                                                <?php if ($row->estadoFactura == 1): ?>
                                                    <span class="badge bg-success">Cancelado</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning">Pendiente</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>    

                                            <a href="<?php echo base_url();?>index.php/factura/facturapdf/<?php echo $row->idFactura; ?>" target="_blank">
                                                <input type="hidden" name="idDispositivo" value="<?php echo $row->idFactura; ?>">
                                                <button type="button" class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver ">
                                                    <span class="btn-inner">
                                                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7364 2.76175H8.0844C6.0044 2.75375 4.3004 4.41075 4.2504 6.49075V17.2277C4.2054 19.3297 5.8734 21.0697 7.9744 21.1147C8.0114 21.1147 8.0484 21.1157 8.0844 21.1147H16.0724C18.1624 21.0407 19.8144 19.3187 19.8024 17.2277V8.03775L14.7364 2.76175Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M14.4746 2.75V5.659C14.4746 7.079 15.6236 8.23 17.0436 8.234H19.7976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M11.6406 9.90869V15.9497" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M13.9864 12.2642L11.6414 9.90918L9.29639 12.2642" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </a>

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

<!-- Agrega este script al final de tu página antes de cerrar el body -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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

<!-- Script para que el boton abra en una ventana -->
<script>
function openFacturaWindow() {
    // Obtener el formulario
    var facturaForm = document.getElementById('facturaForm');
    
    // Obtener la URL del formulario
    var formAction = facturaForm.action;
    
    // Obtener el valor del campo "idDispositivo"
    var idDispositivo = facturaForm.querySelector('input[name="idDispositivo"]').value;
    
    // Crear la URL completa con el ID del dispositivo
    var fullURL = formAction + '/' + idDispositivo;
    
    // Abrir una nueva ventana con la URL
    window.open(fullURL, '_blank');
}
</script>

