<!--
    <?php
    switch($msg){
        case '1':
            $mensaje="Error de ingreso";
            break;
        case '2':
            $mensaje="Acceso no valido";
            break;
        case '3':
            $mensaje="Gracias por usar el sistema";
            break;
        case 'default':
            $mensaje="ingrese sus datos";
            break;
    }
    ?>

<p><?php echo $mensaje; ?></p>

<?php
    echo form_open_multipart('usuario/validarusuario');
?>

<div>
    <input type="text" name="login" placeholder="login">
    <input type="password" name="password" placeholder="password">
    <button type="submit">Ingresar</button>
</div>

<?php
    echo form_close();
?>
-->

<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Hope UI | Responsive Bootstrap 5 Admin Dashboard Template</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/favicon.ico">
      
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/core/libs.min.css">
      
      
      <!-- Hope Ui Design System Css -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/hope-ui.min.css?v=4.0.0">
      
      <!-- Custom Css -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/custom.min.css?v=4.0.0">
      
      <!-- Dark Css -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/dark.min.css">
      
      <!-- Customizer Css -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/customizer.min.css">
      
      <!-- RTL Css -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/rtl.min.css">

      <!-- Estilos CSS 
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      -->
      <!-- Scripts de JavaScript -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      
      
  </head>
  <body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body">
          </div>
      </div>    </div>
    <!-- loader END -->
    
      <div class="wrapper">
      <section class="login-content">
         <div class="row m-0 align-items-center bg-white vh-100">            
            <div class="col-md-6">
               <div class="row justify-content-center">
                  <div class="col-md-10">
                     <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                        <div class="card-body">
                           <a href="<?php echo base_url(); ?>/dashboard/index.html" class="navbar-brand d-flex align-items-center mb-3">
                              
                              <!--Logo start-->
                              <div class="logo-main">
                                  <div class="logo-normal">
                                      <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                                          <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                                          <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                                          <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                                      </svg>
                                  </div>
                                  <div class="logo-mini">
                                      <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                                          <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                                          <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                                          <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                                      </svg>
                                  </div>
                              </div>
                              <!--logo End-->
                              
                              
                              
                              
                              <h4 class="logo-title ms-3">Hope UI</h4>
                           </a>
                           <h2 class="mb-2 text-center">Iniciar Sesión</h2>
                           <p class="text-center">Inicie sesión para mantenerse conectado.</p>

                           <?php
                            echo form_open_multipart('usuario/validarusuario');
                           ?>

                           <form>
                              <div class="row">
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                       <label for="email" class="form-label">Email</label>
                                       <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder=" ">
                                    </div>
                                 </div>
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                       <label for="password" class="form-label">Password</label>
                                       <input type="password" class="form-control" id="password" name="password" aria-describedby="password" placeholder=" ">
                                    </div>
                                 </div>
                                 <div class="col-lg-12 d-flex justify-content-between">
                                    <div class="form-check mb-3">
                                       <input type="checkbox" class="form-check-input" id="customCheck1">
                                       <label class="form-check-label" for="customCheck1">Acuérdate de mí</label>
                                    </div>
                                    <a href="recoverpw.html">¿Has olvidado tu contraseña?</a>
                                 </div>
                              </div>
                              <div class="d-flex justify-content-center">
                                 <button id="btnIniciarSesion" type="submit" class="btn btn-primary">Iniciar Sesión</button>
                              </div>

                              <!-- Agregar un botón para abrir el modal -->
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#errorModal" id="errorButton" style="display: none;">
                                 Mostrar Error
                              </button>

                              <!-- Modal para mostrar el mensaje de error -->
                              <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
                                 <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="errorModalLabel">Mensaje de Error</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <!-- Aquí se mostrará el mensaje de error -->
                                          <p id="errorMessage">Error de ingreso</p>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>

                              <!--
                              <p class="text-center my-3">¿O iniciar sesión con otras cuentas?</p>
                              <div class="d-flex justify-content-center">
                                 <ul class="list-group list-group-horizontal list-group-flush">
                                    <li class="list-group-item border-0 pb-0">
                                       <a href="#"><img src="<?php echo base_url(); ?>/assets/images/brands/fb.svg" alt="fb"></a>
                                    </li>
                                    <li class="list-group-item border-0 pb-0">
                                       <a href="#"><img src="<?php echo base_url(); ?>/assets/images/brands/gm.svg" alt="gm"></a>
                                    </li>
                                    <li class="list-group-item border-0 pb-0">
                                       <a href="#"><img src="<?php echo base_url(); ?>/assets/images/brands/im.svg" alt="im"></a>
                                    </li>
                                    <li class="list-group-item border-0 pb-0">
                                       <a href="#"><img src="<?php echo base_url(); ?>/assets/images/brands/li.svg" alt="li"></a>
                                    </li>
                                 </ul>
                              </div> -->
                              <p class="mt-3 text-center">
                              ¿No tienes una cuenta? <a href="<?php echo base_url('index.php/usuario/register'); ?>" class="text-underline">Haga clic aquí para registrarte.</a>
                              </p>
                              <?php
                                 echo form_close();
                              ?>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sign-bg">
                  <svg width="280" height="230" viewBox="0 0 431 398" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <g opacity="0.05">
                     <rect x="-157.085" y="193.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -157.085 193.773)" fill="#3B8AFF"/>
                     <rect x="7.46875" y="358.327" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 7.46875 358.327)" fill="#3B8AFF"/>
                     <rect x="61.9355" y="138.545" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 61.9355 138.545)" fill="#3B8AFF"/>
                     <rect x="62.3154" y="-190.173" width="543" height="77.5714" rx="38.7857" transform="rotate(45 62.3154 -190.173)" fill="#3B8AFF"/>
                     </g>
                  </svg>
               </div>
            </div>
            <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
               <img src="<?php echo base_url(); ?>/assets/images/auth/08.png" class="img-fluid gradient-main animated-scaleX" alt="images">
            </div>
         </div>
      </section>
      </div>
    
    <!-- Library Bundle Script -->
    <script src="<?php echo base_url(); ?>/assets/js/core/libs.min.js"></script>
    
    <!-- External Library Bundle Script -->
    <script src="<?php echo base_url(); ?>/assets/js/core/external.min.js"></script>
    
    <!-- Widgetchart Script -->
    <script src="<?php echo base_url(); ?>/assets/js/charts/widgetcharts.js"></script>
    
    <!-- mapchart Script -->
    <script src="<?php echo base_url(); ?>/assets/js/charts/vectore-chart.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/charts/dashboard.js" ></script>
    
    <!-- fslightbox Script -->
    <script src="<?php echo base_url(); ?>/assets/js/plugins/fslightbox.js"></script>
    
    <!-- Settings Script -->
    <script src="<?php echo base_url(); ?>/assets/js/plugins/setting.js"></script>
    
    <!-- Slider-tab Script -->
    <script src="<?php echo base_url(); ?>/assets/js/plugins/slider-tabs.js"></script>
    
    <!-- Form Wizard Script -->
    <script src="<?php echo base_url(); ?>/assets/js/plugins/form-wizard.js"></script>
    
    <!-- AOS Animation Plugin-->
    
    <!-- App Script -->
    <script src="<?php echo base_url(); ?>/assets/js/hope-ui.js" defer></script>

    <!-- JavaScript para mostrar el modal con el mensaje de error -->
      <script>
      $(document).ready(function() {
         // Aquí verificamos el valor de $msg y mostramos el modal si es necesario
         switch ('<?php echo $msg; ?>') {
            case '1':
            $('#errorMessage').text('Error de ingreso');
            $('#errorButton').click();
            break;
            case '2':
            $('#errorMessage').text('Acceso no válido');
            $('#errorButton').click();
            break;
            case '3':
            $('#errorMessage').text('Gracias por usar el sistema');
            $('#errorButton').click();
            break;
            default:
            // No mostramos el modal por defecto
            break;
         }
      });
      </script>

  </body>
</html>