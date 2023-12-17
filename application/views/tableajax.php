<div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Datatable Ajax</h4>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="tablaEnergia" class="table table-striped">
                     <thead>
                        <tr>
                           <th>Nro</th>
                           <th>Voltaje [V]</th>
                           <th>Corriente [A]</th>
                           <th>Potencia [W]</th>
                           <th>Fecha y Hora</th>
                        </tr>
                     </thead>
                     <tbody id="tablaBody">
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Añade el código JavaScript para DataTable y AJAX -->
    <script>
        $(document).ready(function () {
         var table = $('#tablaEnergia').DataTable();
            if ($.fn.DataTable.isDataTable('#tablaEnergia')) {
               table.destroy();
            }

            // Luego, crea una nueva instancia de DataTable
            table = $('#tablaEnergia').DataTable({
               "ajax": {
                  "url": "<?php echo base_url('index.php/monitoreo/obtenerDatosTabla'); ?>",
                  "dataSrc": ""
               },
               "columns": [
                  { "data": "nro" },
                  { "data": "voltaje" },
                  { "data": "corriente" },
                  { "data": "potencia" },
                  { "data": "fecha_hora" }
               ]
            });

            //configura un intervalo para recargar la tabla
            setInterval(function(){
               table.ajax.reload(null, false);
            }, 5000);
        });
    </script>
    
    <!--
    <script>
    // Función para cargar los datos de la tabla
    function cargarDatosTabla() {
        $.ajax({
            url: "<?php echo base_url('index.php/monitoreo/obtenerDatosTabla'); ?>",
            type: "GET",
            dataType: "json",
            success: function (data) {
                // Limpiar el cuerpo de la tabla
                $("#tablaBody").empty();

                // Llenar la tabla con los nuevos datos
                data.forEach(function (row) {
                    $("#tablaBody").append(
                        "<tr>" +
                            "<td>" + row.nro + "</td>" +
                            "<td>" + row.voltaje + "</td>" +
                            "<td>" + row.corriente + "</td>" +
                            "<td>" + row.potencia + "</td>" +
                            "<td>" + row.fecha_hora + "</td>" +
                        "</tr>"
                    );
                });
            },
            error: function (xhr, status, error) {
                console.log("Error al cargar los datos: " + error);
            }
        });
    }

    // Cargar los datos de la tabla al cargar la página
    cargarDatosTabla();

    // Actualizar la tabla cada 5 segundos (puedes ajustar el tiempo según tus necesidades)
    setInterval(cargarDatosTabla, 5000);
</script>
   -->