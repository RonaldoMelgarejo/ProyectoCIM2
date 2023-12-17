<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.css" type="text/css">
 
</head>
<body>
-->


<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>SolarEnergy</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/favicon.ico">
      
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/core/libs.min.css">
      
      <!-- Aos Animation Css -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/vendor/aos/dist/aos.css">
      
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

      <!-- Flatpickr -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.css">
      <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/l10n/es.js"></script>

      <!-- DataTables -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

      <!-- Leaflet Map -->
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
      <style>
          /* Estilo para el mapa, ajusta el tamaño según tus necesidades */
          #map {
              height: 350px;
              width: 100%; /* Ancho completo dentro de la columna */
          }
      </style>
      
      <!-- Toastr -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      
      <!-- Estilo tabla -->
      <style>
        /* Estilos generales para th y td */
        .tabla-filtrar th, .tabla-filtrar td {
            border: 1px solid black;
            border-radius: 10px;
            padding: 8px;
        }
      </style>

  </head>
  <body class=" ">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body">
            
          </div>
      </div>    
    </div>
    <!-- loader END -->