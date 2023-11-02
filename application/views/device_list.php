<!--
<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-lg-6">
            <div class="profile-content tab-content">
                <div id="profile-profile" class="tab-pane fade active show">
                    <div class="card">
                        <div class="card-header">
                            <div class="header-title">
                            <h4 class="card-title">Registrar Dispositivo</h4>
                            </div>
                        </div> <!--
                        <div class="card-body">
                            <div class="mt-2">
                            <h6 class="mb-1">Unido:</h6>
                            <p><?php
                                 $fechaRegistro = $this->session->userdata('fechaRegistro');
                                 if (!empty($fechaRegistro)) {
                                    echo date("d-m-Y", strtotime($fechaRegistro));
                                 }
                                 ?>
                            </p>
                            </div>
                            
                            <div class="mt-2">
                            <h6 class="mb-1">Lives:</h6>
                            <p>United States of America</p>
                            </div>
                              
                            <div class="mt-2">
                            <h6 class="mb-1">Email:</h6>
                            <p><a href="#" class="text-body"> <?php echo $this->session->userdata('email');?> </a></p>
                            </div>
                            <div class="mt-2">
                            <h6 class="mb-1">Url:</h6>
                            <p><a href="#" class="text-body" target="_blank"> www.bootstrap.com </a></p>
                            </div>
                            <div class="mt-2">
                            <h6 class="mb-1">Contact:</h6>
                            <p><a href="#" class="text-body">(001) 4544 565 456</a></p>
                            </div>
                        </div> 
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                        <label for="full-name" class="form-label">Codigo</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder=" ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                       <label for="last-name" class="form-label">Ubicacion</label>
                                       <input type="text" class="form-control" id="firstName" name="firstName" placeholder=" ">
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label for="last-name" class="form-label">Latitud</label>
                                       <input type="text" class="form-control" id="latitud" readonly>
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label for="last-name" class="form-label">Longitud</label>
                                       <input type="text" class="form-control" id="longitud" readonly>
                                    </div>
                                 </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="profile-content tab-content">
                <div id="profile-profile" class="tab-pane fade active show">
                    <div class="card">
                        <div class="card-header">
                            <div class="header-title">
                            <h4 class="card-title">Selecciona la Ubicacion</h4>
                            </div>
                            <div class="row ">
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" id="search-input" placeholder="Buscar país, ciudad o lugar">
                                </div>
                                <div class="col-lg-4">
                                    <button id="search-button" class="btn btn-primary rounded-pill">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="map" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div> -->

<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-lg-12">
            <div class="profile-content tab-content">
                <div id="table-view" class="tab-pane fade active show">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Dispositivos</h4>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive mt-4">
                                <table id="basic-table" class="table table-striped mb-0" role="grid">
                                    <thead>
                                        <tr>
                                            <th>Nro</th>
                                            <th>Código</th>
                                            <th>Ubicacion</th>
                                            <th>Latitud</th>
                                            <th>Longitud</th>
                                            <th>Fecha Instalacion</th>
                                            <th>Estado</th>
                                            <th>Habilitar / Deshabilitar</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $indice = 1;

                                            foreach ($dispositivo->result() as $row) {
                                        ?>
                                            <tr>
                                                <th scope="row"><?php echo $indice; ?></th>
                                                <td><?php echo $row->codigo; ?></td>
                                                <td><?php echo $row->ubicacion; ?></td>
                                                <td><?php echo $row->latitud; ?></td>
                                                <td><?php echo $row->longitud; ?></td>
                                                <td><?php echo formatearFecha($row->fechaInstalacion); ?></td>
                                                <td>
                                                    <?php if ($row->estado == 1): ?>
                                                        Activo
                                                    <?php else: ?>
                                                        Desactivado
                                                    <?php endif; ?>
                                                </td>

                                                <td>
                                                    <?php
                                                        echo form_open_multipart($row->estado == 1 ? 'dispositivo/deshabilitarbd' : 'dispositivo/habilitarbd');
                                                    ?>
                                                    <input type="hidden" name="idDispositivo" value="<?php echo $row->id; ?>">
                                                    <button type="submit" class="btn btn-warning">
                                                        <?php echo $row->estado == 1 ? 'Deshabilitar' : 'Habilitar'; ?>
                                                    </button>
                                                    <?php
                                                        echo form_close();
                                                    ?>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary btn-xs modificar-button"
                                                        data-id="<?php echo $row->id; ?>"
                                                        data-codigo="<?php echo $row->codigo; ?>"
                                                        data-ubicacion="<?php echo $row->ubicacion; ?>"
                                                        data-latitud="<?php echo $row->latitud; ?>"
                                                        data-longitud="<?php echo $row->longitud; ?>">
                                                        Modificar
                                                    </button>
                                                </td>

                                                <td>
                                                    <?php
                                                        echo form_open_multipart('dispositivo/eliminarbd');
                                                    ?>
                                                    <input type="hidden" name="idDispositivo" value="<?php echo $row->id; ?>">
                                                    <button type="submit" class="btn btn-danger btn-xs">Eliminar</button>
                                                    <?php
                                                        echo form_close();
                                                    ?>
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

                <div id="modify-view" class="tab-pane fade active show">
                    <div class="card">
                        <div class="card-header">
                            <div class="header-title">
                                <h4 class="card-title">Modificar Dispositivo</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <form method="POST" action="<?php echo site_url('dispositivo/modificarbd'); ?>">
                                        <input type="hidden" id="idDispositivo" name="idDispositivo">
                                        <div class="form-group">
                                            <label class="form-label">Código</label>
                                            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Ubicación</label>
                                            <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Latitud</label>
                                            <input type="text" class="form-control" id="latitud" name="latitud" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Longitud</label>
                                            <input type="text" class="form-control" id="longitud" name="longitud" readonly>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">Modificar</button>
                                            <div style="width: 20px;"></div>
                                            <button type="button" class="btn btn-secondary btn-xs cancelar-button">Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-8">
                                    <div class="mb-2 d-flex justify-content-center align-items-center">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" id="search-input" placeholder="Buscar país, ciudad o lugar">
                                            </div>
                                            <div class="col-lg-4">
                                                <button id="search-button" class="btn btn-primary">Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="map"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Oculta el formulario de modificación al cargar la página
        $('#modify-view').hide();

        // Cuando se hace clic en el botón "Modificar" en la tabla, muestra el formulario y oculta la tabla
        $('button.modificar-button').on('click', function () {
            var idDispositivo = $(this).data('id');
            var codigo = $(this).data('codigo');
            var ubicacion = $(this).data('ubicacion');
            var latitud = $(this).data('latitud');
            var longitud = $(this).data('longitud');

            $('#idDispositivo').val(idDispositivo);
            $('#codigo').val(codigo);
            $('#ubicacion').val(ubicacion);
            $('#latitud').val(latitud);
            $('#longitud').val(longitud);

            $('#table-view').hide();
            $('#modify-view').show();
        });

        // Cuando se hace clic en el botón "Cancelar" en el formulario, vuelve a mostrar la tabla y oculta el formulario
        $('button.cancelar-button').on('click', function () {
            $('#table-view').show();
            $('#modify-view').hide();
        });
    });
</script>


