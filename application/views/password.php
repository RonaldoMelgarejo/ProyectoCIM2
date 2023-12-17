<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="profile-img position-relative me-3 mb-3 mb-lg-0 profile-logo profile-logo1">
                            <img src="../../assets/images/avatars/01.png" alt="User-Profile" class="theme-color-default-img img-fluid rounded-pill avatar-100">
                            <img src="../../assets/images/avatars/avtar_1.png" alt="User-Profile" class="theme-color-purple-img img-fluid rounded-pill avatar-100">
                            <img src="../../assets/images/avatars/avtar_2.png" alt="User-Profile" class="theme-color-blue-img img-fluid rounded-pill avatar-100">
                            <img src="../../assets/images/avatars/avtar_4.png" alt="User-Profile" class="theme-color-green-img img-fluid rounded-pill avatar-100">
                            <img src="../../assets/images/avatars/avtar_5.png" alt="User-Profile" class="theme-color-yellow-img img-fluid rounded-pill avatar-100">
                            <img src="../../assets/images/avatars/avtar_3.png" alt="User-Profile" class="theme-color-pink-img img-fluid rounded-pill avatar-100">
                        </div>
                        <div class="d-flex flex-wrap align-items-center mb-3 mb-sm-0">
                            <h4 class="me-2 h4"> <?php echo $this->session->userdata('nombre') . ' '. $this->session->userdata('primerApellido') . ' ' . $this->session->userdata('segundoApellido'); ?></h4>
                            <span> - Web Developer</span>
                        </div>
                    </div>
                    <ul class="d-flex nav nav-pills mb-0 text-center profile-tab" data-toggle="slider-tab" id="profile-pills-tab" role="tablist">
                        <!--
                        <li class="nav-item">
                            <a class="nav-link active show" data-bs-toggle="tab" href="#profile-feed" role="tab" aria-selected="false">Feed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile-activity" role="tab" aria-selected="false">Activity</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link active show" data-bs-toggle="tab" href="#profile-profile" role="tab" aria-selected="false">Perfil</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link active show" data-bs-toggle="tab" href="#edit-password" role="tab" aria-selected="false">Contraseña</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="profile-content tab-content">
            <div id="edit-password" class="tab-pane fade active show">
                <div class="card">
                    <div class="card-header">
                    <div class="header-title">
                        <h4 class="card-title">Contraseña</h4>
                    </div>
                    </div>
                    <div class="card-body">
                    <div class="text-center">
                        <?php
                        // Verificar si hay un mensaje de éxito y mostrarlo
                        if ($this->session->flashdata('success')) {
                            echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                        }

                        // Verificar si hay un mensaje de error y mostrarlo
                        if ($this->session->flashdata('error')) {
                            echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                        }
                        ?>
                        <div class="mt-3">
                            
                            <form method="post" id="" action="<?php echo site_url('usuario/modificar_contrasenia'); ?>">
                                <div class="row">
                                <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $this->session->userdata('idUsuario'); ?>">
                                <!-- <?php echo 'Valor de idUsuario: ' . $this->session->userdata('idUsuario'); ?> -->

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">Contraseña anterior</label>
                                        <input type="password" class="form-control" id="old" name="old" value="" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">Nueva contraseña</label>
                                        <input type="password" class="form-control" id="new" name="new" value="" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">Confirmar contraseña</label>
                                        <input type="password" class="form-control" id="confirm" name="confirm" value="" >
                                    </div>
                                </div>
                                
                                
                                </div>
                                <div class="d-flex justify-content-center">
                                <button type="submit" id="cambiarPassword" class="btn btn-primary" >Guardar</button>
                                <div style="width: 20px;"></div>
                                <button type="button" id="limpiar" class="btn btn-primary" >Limpiar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                
            </div>
            </div>
        </div>

    </div>
</div>

<!-- Script para cambiar contraseña -->
<script>
   $(document).ready(function() {
      // Cuando se hace clic en el botón "Limpiar"
      $("#limpiar").click(function() {
         // Limpiar los valores de los campos de contraseña
         $("input[type=password]").val("");
      });
   });
</script>

<script>
    // Cuando la página se carga completamente
    $(document).ready(function() {
        // Obtén la posición de la sección edit-password y desplázate a ella
        var offset = $('#edit-password').offset();
        if (offset) {
            $('html, body').animate({
                scrollTop: offset.top
            }, 1000); // Puedes ajustar la duración de la animación según tus preferencias
        }
    });
</script>