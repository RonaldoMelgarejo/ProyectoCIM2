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
                              <span> - <?php echo $this->session->userdata('rol'); ?></span>
                           </div>
                        </div>
                        <ul class="d-flex nav nav-pills mb-0 text-center profile-tab" data-toggle="slider-tab" id="profile-pills-tab" role="tablist">
                                                      
                           <li class="nav-item">
                              <a class="nav-link active show" data-bs-toggle="tab" href="#profile-profile" role="tab" aria-selected="false">Perfil</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" data-bs-toggle="tab" href="#edit-password" role="tab" aria-selected="false">Contraseña</a>
                           </li>
                        </ul>
                     </div>
                  </div>
             </div>
          </div>
          
          <div class="col-lg-12">
             <div class="profile-content tab-content">
                
               <div id="profile-profile" class="tab-pane fade active show">
                  <div class="card">
                     <div class="card-header">
                        <div class="header-title">
                           <h4 class="card-title">Perfil</h4>
                        </div>
                     </div>
                     <div class="card-body">
                        <div class="text-center">
                           <div class="user-profile">
                              <img src="../../assets/images/avatars/01.png" alt="profile-img" class="rounded-pill avatar-130 img-fluid">
                           </div>
                           <div class="mt-3">
                              <!--
                              <h3 class="d-inline-block">Austin Robertson</h3>
                              <p class="d-inline-block pl-3"> - Web developer</p>
                              <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                              -->
                              <form method="post" id="editarUsuario" action="<?php echo site_url('usuario/modificarusuario'); ?>">
                                 <div class="row">
                                    <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $this->session->userdata('idusuario'); ?>">
                                    <!-- <?php echo 'Valor de idUsuario: ' . $this->session->userdata('idusuario'); ?> -->

                                    <div class="col-lg-4">
                                       <div class="form-group">
                                          <label for="full-name" class="form-label">Nombre de Usuario</label>
                                          <input type="text" class="form-control" id="userName" name="userName" value="<?php echo $this->session->userdata('nombreUsuario');?>" readonly>
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                       <div class="form-group">
                                          <label for="full-name" class="form-label">CI</label>
                                          <input type="text" class="form-control" id="ci" name="ci" value="<?php echo $this->session->userdata('ci');?>" readonly>
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                       <div class="form-group">
                                          <label for="email" class="form-label">Email</label>
                                          <input type="email" class="form-control" id="email" name="email" value="<?php echo $this->session->userdata('email');?>" readonly>
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                       <div class="form-group">
                                          <label for="full-name" class="form-label">Nombre</label>
                                          <input type="text" class="form-control" id="name" name="name" value="<?php echo $this->session->userdata('nombre');?>" readonly>
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                       <div class="form-group">
                                          <label for="last-name" class="form-label">Primer Apellido</label>
                                          <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $this->session->userdata('primerApellido');?>" readonly>
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                       <div class="form-group">
                                          <label for="last-name" class="form-label">Segundo Apellido</label>
                                          <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $this->session->userdata('segundoApellido');?>" readonly>
                                       </div>
                                    </div>
                                    
                                 </div>
                                 <div class="d-flex justify-content-center">
                                    <!-- <button type="submit" class="btn btn-primary">Editar</button> -->
                                    <button type="button" id="editar" class="btn btn-primary">Editar</button>
                                    <button type="submit" id="guardar" class="btn btn-primary" style="display: none;">Guardar</button>
                                    <div style="width: 20px;"></div>
                                    <button type="button" id="cancelar" class="btn btn-primary" style="display: none;">Cancelar</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                  
               </div>

               <div id="edit-password" class="tab-pane fade">
                  <div class="card">
                     <div class="card-header">
                        <div class="header-title">
                           <h4 class="card-title">Contraseña</h4>
                        </div>
                     </div>
                     <div class="card-body">
                        <div class="text-center">
                           
                           <div class="mt-3">
                              
                              <form method="post" id="" action="<?php echo site_url('usuario/modificarcontrasenia'); ?>">
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
<!-- Script para editar perfil -->
<script>
    const usuarioInput = document.getElementById('userName');
    const nombreInput = document.getElementById('name');
    const apellidoInput = document.getElementById('firstName');
    const segundoApellidoInput = document.getElementById('lastName');
    const emailInput = document.getElementById('email');
    const editarButton = document.getElementById('editar');
    const guardarButton = document.getElementById('guardar');
    const cancelarButton = document.getElementById('cancelar');
    const usuarioOriginal = '<?php echo $this->session->userdata("nombreUsuario"); ?>';
    const nombreOriginal = '<?php echo $this->session->userdata("nombre"); ?>';
    const apellidoOriginal = '<?php echo $this->session->userdata("primerApellido"); ?>';
    const segundoApellidoOriginal = '<?php echo $this->session->userdata("segundoApellido"); ?>';
    const emailOriginal = '<?php echo $this->session->userdata("email"); ?>';
    
    editarButton.addEventListener('click', function() {
      usuarioInput.removeAttribute('readonly');
      nombreInput.removeAttribute('readonly');
      apellidoInput.removeAttribute('readonly');
      segundoApellidoInput.removeAttribute('readonly');
      emailInput.removeAttribute('readonly');
      editarButton.style.display = 'none';
      guardarButton.style.display = 'block';
      cancelarButton.style.display = 'block';

      // Agregar una instrucción console.log para verificar el valor de idUsuario
      const id = '<?php echo $this->session->userdata('idusuario'); ?>';
      console.log("Id de Usuario: " + id);
   });


    guardarButton.addEventListener('click', function() {
      // Agregar una instrucción console.log para verificar que el evento se ejecute
      console.log("Botón Guardar presionado");

      
      // Restaurar los campos a solo lectura y ocultar los botones
      usuarioInput.setAttribute('readonly', 'readonly');
      nombreInput.setAttribute('readonly', 'readonly');
      apellidoInput.setAttribute('readonly', 'readonly');
      segundoApellidoInput.setAttribute('readonly', 'readonly');
      emailInput.setAttribute('readonly', 'readonly');
      editarButton.style.display = 'block';
      guardarButton.style.display = 'none';
      cancelarButton.style.display = 'none';

      // Verificar si se envía el formulario
      console.log("Enviando formulario...");
   });


    cancelarButton.addEventListener('click', function() {
        // Restaurar los campos de entrada a sus valores originales
        usuarioInput.value = usuarioOriginal;
        nombreInput.value = nombreOriginal;
        apellidoInput.value = apellidoOriginal;
        segundoApellidoInput.value = segundoApellidoOriginal;
        emailInput.value = emailOriginal;
        nombreInput.setAttribute('readonly', 'readonly');
        apellidoInput.setAttribute('readonly', 'readonly');
        segundoApellidoInput.setAttribute('readonly', 'readonly');
        emailInput.setAttribute('readonly', 'readonly');
        editarButton.style.display = 'block';
        guardarButton.style.display = 'none';
        cancelarButton.style.display = 'none';
    });
</script>
<!-- Script de flashdata 
<script>
    // Agregar verificación de mensajes de sesión y mostrarlos
    var mensajeExito = "<?php echo $this->session->flashdata('success'); ?>";
    var mensajeError = "<?php echo $this->session->flashdata('error'); ?>";

    if (mensajeExito) {
        // Muestra el mensaje de éxito (puedes personalizar el estilo)
        alert(mensajeExito);
    }

    if (mensajeError) {
        // Muestra el mensaje de error (puedes personalizar el estilo)
        alert(mensajeError);
    }

</script>
-->

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

    if (mensajeExito) {
        // Muestra el mensaje de éxito (puedes personalizar el estilo)
        showAlert('success', mensajeExito);
    }

    if (mensajeError) {
        // Muestra el mensaje de error (puedes personalizar el estilo)
        showAlert('error', mensajeError);
    }
</script>






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