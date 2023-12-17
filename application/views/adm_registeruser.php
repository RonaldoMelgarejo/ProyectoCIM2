<div class="conatiner-fluid content-inner mt-n5 py-0">
      <div>
         <div class="row"> <!--
            <div class="col-xl-3 col-lg-4">
               <div class="card"> 
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Agregar nuevo usuario</h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <form> 
                        <div class="form-group">
                           <div class="profile-img-edit position-relative">
                              <img src="../../assets/images/avatars/01.png" alt="profile-pic" class="theme-color-default-img profile-pic rounded avatar-100">
                              <img src="../../assets/images/avatars/avtar_1.png" alt="profile-pic" class="theme-color-purple-img profile-pic rounded avatar-100">
                              <img src="../../assets/images/avatars/avtar_2.png" alt="profile-pic" class="theme-color-blue-img profile-pic rounded avatar-100">
                              <img src="../../assets/images/avatars/avtar_4.png" alt="profile-pic" class="theme-color-green-img profile-pic rounded avatar-100">
                              <img src="../../assets/images/avatars/avtar_5.png" alt="profile-pic" class="theme-color-yellow-img profile-pic rounded avatar-100">
                              <img src="../../assets/images/avatars/avtar_3.png" alt="profile-pic" class="theme-color-pink-img profile-pic rounded avatar-100">
                              
                              <div class="upload-icone bg-primary">
                                 <svg class="upload-button icon-14" width="14" viewBox="0 0 24 24">
                                    <path fill="#ffffff" d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z"></path>
                                 </svg>
                                 <input class="file-upload" type="file" accept="image/*">
                              </div>
                           </div>
                            
                           <div class="img-extension mt-3">
                              <div class="d-inline-block align-items-center">
                                 <span>Only</span>
                                 <a href="javascript:void();">.jpg</a>
                                 <a href="javascript:void();">.png</a>
                                 <a href="javascript:void();">.jpeg</a>
                                 <span>allowed</span>
                              </div>
                           </div>
                           
                        </div>
                        <div class="form-group">
                           <label class="form-label">Rol de usuario:</label>
                           <select name="type" class="selectpicker form-control" data-style="py-0">
                              <option>Seleccionar</option>
                              <option>Administrador</option>
                              <option>Instalador</option>
                              <option>Cliente</option>
                           </select>
                        </div>
                        
                     </form>
                  </div> 
               </div>
            </div> -->
            <div class="col-xl-9 col-lg-8">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Información para nuevos usuarios</h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="new-user-info">
                        <form method="POST" action="<?php echo site_url('usuario/registrarusuario'); ?>">
                           <div class="form-group col-md-2">
                              <label class="form-label">Rol de usuario:</label>
                              <select name="type" class="selectpicker form-control" data-style="py-0">
                                 <option>Seleccionar</option>
                                 <option>Administrador</option>
                                 <option>Instalador</option>
                                 <option>Cliente</option>
                              </select>
                           </div>

                           <div class="row">
                              
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="fname">Nombre:</label>
                                 <input type="text" class="form-control" id="name" name="name" placeholder="Nombres">
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="lname">Primer Apellido:</label>
                                 <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Apellido">
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="lname">Segundo Apellido:</label>
                                 <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Apellido">
                              </div>
                              <!--
                              <div class="form-group col-sm-12">
                                 <label class="form-label">Departamento:</label>
                                 <select name="type" class="selectpicker form-control" data-style="py-0">
                                    <option>Seleccionar</option>
                                    <option>Beni</option>
                                    <option>Cochabamba</option>
                                    <option>Chuquisaca</option>
                                    <option>La Paz</option>
                                    <option>Oruro</option>
                                    <option>Pando</option>
                                    <option>Potosí</option>
                                    <option>Tarija</option>
                                    <option>Santa Cruz</option>
                                 </select>
                              </div>
                              -->
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="mobno">CI:</label>
                                 <input type="text" class="form-control" id="ci" name="ci" placeholder="CI">
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="email">Correo electrónico:</label>
                                 <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                              </div>
                              
                              <div class="form-group col-md-6 address" style="display: none;">
                                    <label class="form-label" for="add">Dirección:</label>
                                    <input type="text" class="form-control" id="add" name="add" placeholder="Dirección Calle">
                              </div>
                              <div class="form-group col-md-6 specialty" style="display: none;">
                                    <label class="form-label" for="specialty">Especialidad:</label>
                                    <input type="text" class="form-control" id="specialty" name="specialty" placeholder="Especialidad">
                              </div>
                           </div>
                           <hr>
                           <!-- 
                           <h5 class="mb-3">Seguridad</h5>
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label" for="uname">Nombre de Usuario:</label>
                                 <input type="text" class="form-control" id="uname" placeholder="Nombre de Usuario">
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="pass">Contraseña:</label>
                                 <input type="password" class="form-control" id="pass" placeholder="Password">
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label" for="rpass">Repetir Contraseña:</label>
                                 <input type="password" class="form-control" id="rpass" placeholder="Repeat Password ">
                              </div>
                           </div>
                           <div class="checkbox">
                              <label class="form-label"><input class="form-check-input me-2" type="checkbox" value="" id="flexCheckChecked">Habilitar la autenticación de dos factores</label>
                           </div>
                           -->
                           <button type="submit" class="btn btn-primary">Agregar nuevo usuario</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtén referencias a los elementos del DOM que necesitas manipular
        var roleSelect = document.querySelector('select[name="type"]');
        var addressDiv = document.querySelector('.form-group.col-md-6.address');
        var specialtyDiv = document.querySelectorAll('.form-group.col-md-6.specialty');

        // Agrega un evento de cambio al select de roles
        roleSelect.addEventListener('change', function() {
            // Oculta todos los divs relevantes al principio
            addressDiv.style.display = 'none';
            specialtyDiv.forEach(function(div) {
                div.style.display = 'none';
            });

            // Muestra el div correspondiente al rol seleccionado
            if (roleSelect.value === 'Administrador') {
                // No se requiere ninguna acción específica para el administrador
            } else if (roleSelect.value === 'Instalador') {
                specialtyDiv[0].style.display = 'block'; // Muestra el primer div de especialidad
                addressDiv.style.display = 'none'; // Asegúrate de ocultar el div de dirección si está visible
            } else if (roleSelect.value === 'Cliente') {
                addressDiv.style.display = 'block';
                specialtyDiv[1].style.display = 'block'; // Muestra el segundo div de especialidad
            }
        });

        // Agregar verificación de mensajes de sesión y mostrarlos
        var mensajeExito = "<?php echo $this->session->flashdata('mensaje_exito'); ?>";
        var mensajeError = "<?php echo $this->session->flashdata('mensaje_error'); ?>";

        if (mensajeExito) {
            // Muestra el mensaje de éxito (puedes personalizar el estilo)
            alert(mensajeExito);
        }

        if (mensajeError) {
            // Muestra el mensaje de error (puedes personalizar el estilo)
            alert(mensajeError);
        }
      
    });
   </script>