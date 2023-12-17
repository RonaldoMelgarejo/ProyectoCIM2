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
                <div id="profile-profile" class="tab-pane fade active show">
                    <div class="card">
                        <div class="card-header">
                            <div class="header-title">
                                <h4 class="card-title">Registrar Dispositivo</h4>
                            </div>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <!-- Columna izquierda para el formulario -->
                                    <div class="col-lg-4">
                                        <form method="POST" action="<?php echo site_url('dispositivo/registrardispositivo'); ?>">
                                            <input type="hidden" name="idUsuario" value="<?php echo $this->session->userdata('idusuario'); ?>">

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
                                                <button type="submit" class="btn btn-primary">Registrar</button>
                                            </div>
                                        </form>
                                        
                                    </div>
                                    <!-- Columna derecha para el mapa y búsqueda -->
                                    <div class="col-lg-8">
                                        <div class="mb-2 d-flex justify-content-center align-items-center"> <!-- Agregar estas clases para centrar vertical y horizontalmente -->
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

    <!-- Modales -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Éxito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo $this->session->flashdata('mensaje_exito'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo $this->session->flashdata('mensaje_error'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Agrega estos scripts al final de tu vista -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script para mostrar el modal de éxito -->
<script>
    $(document).ready(function () {
        <?php if($this->session->flashdata('mensaje_exito')): ?>
            $('#successModal').modal('show');
        <?php endif; ?>
    });
</script>

<!-- Script para mostrar el modal de error -->
<script>
    $(document).ready(function () {
        <?php if($this->session->flashdata('mensaje_error')): ?>
            $('#errorModal').modal('show');
        <?php endif; ?>
    });
</script>