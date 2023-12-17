<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div>
        <div class="row">
            <div class="col-xl-12 col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Nuevo Recibo</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="new-user-info">
                            <h6 class="card-title">Buscar cliente:</h6>
                            <form method="POST" action="<?php echo site_url('factura/pagar'); ?>" id="formPagar"> <!-- Agrega un ID al formulario -->
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label class="form-label" for="mobno">CI:</label>
                                        <input type="text" class="form-control" id="ci" name="ci" placeholder="CI">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="fname">Nombre:</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombres" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="lname">Primer Apellido:</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Apellido" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="lname">Segundo Apellido:</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Apellido" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="form-label">Fecha:</label>
                                        <input type="text" class="form-control" id="fecha" name="fecha" placeholder="" readonly>
                                    </div>
                                    
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="email">Correo electrónico:</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" readonly>
                                    </div>

                                </div>
                                <!-- Mover el botón "Buscar Dispositivos" a la izquierda -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-info" id="btnBuscarDispositivos">Buscar Dispositivos</button>
                                    </div>
                                    <!--
                                    <div class="col-md-6 text-right"> 
                                        <button type="submit" class="btn btn-success">Pago</button>
                                    </div>
                                    -->
                                </div>
                            <!-- </form> -->
                            <br>
                            <!-- <form method="POST" action="<?php echo site_url('factura/pagar'); ?>" id="formPagar"> --> <!-- Agrega un ID al formulario -->

                                <div class="table-responsive text-center">
                                    <!-- Agrega una tabla para mostrar los dispositivos y detalles de factura -->
                                    <table class="table" id="tablaDispositivos" style="display: none;">
                                        <thead>
                                            <tr>
                                                <th style="display: none;">ID Dispositivo</th> <!-- Oculta la columna ID Dispositivo -->
                                                <th style="display: none;">ID Factura</th> <!-- Nueva columna oculta para el ID de la factura -->
                                                <th>Nro</th>
                                                <th>Dispositivo</th> <!-- Nueva columna para mostrar los códigos de los dispositivos -->
                                                <th>Mes</th>
                                                <th>Año</th>
                                                <th>Monto [Bs.]</th>
                                                <th>Seleccionar</th> <!-- Nueva columna para el checkbox de selección -->
                                            </tr>
                                        </thead>
                                        <tbody id="cuerpoTabla"></tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td>Total Pagar:</td>
                                                <td id="totalPagar">0.00</td>
                                                <td>Bs.</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <button type="submit" class="btn btn-primary">Pagar</button> <!-- Cambia el tipo de botón a "submit" -->
                            </form>                            
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Obtén la fecha actual en el formato "YYYY-MM-DD"
        var fechaActual = obtenerFechaActual();

        // Establece la fecha actual en el campo de entrada de fecha
        $("#fecha").val(fechaActual);

        // Función para obtener la fecha actual en el formato "YYYY-MM-DD"
        function obtenerFechaActual() {
            var fecha = new Date();
            var dia = ("0" + fecha.getDate()).slice(-2);
            var mes = ("0" + (fecha.getMonth() + 1)).slice(-2);
            var anio = fecha.getFullYear();
            return anio + "-" + mes + "-" + dia;
        }

        
    });
</script>

<!--- Filtrar clientes -->
<script>
    $(document).ready(function () {
        $("#ci").on('keyup', function () {
            var ci = $(this).val();

            // Realiza la solicitud AJAX al servidor
            $.ajax({
                url: "<?php echo site_url('factura/obtenerUsuarioPorCI'); ?>",
                method: "POST",
                data: { ci: ci },
                dataType: "json",
                success: function (data) {
                    // Verifica si la respuesta es un objeto no nulo
                    if (data !== null && typeof data === 'object') {
                        // Rellena los campos con los detalles del usuario
                        $("#name").val(data.nombre || '');
                        $("#firstName").val(data.primerApellido || '');
                        $("#lastName").val(data.segundoApellido || '');
                        $("#email").val(data.email || '');

                        // Muestra u oculta campos adicionales según el rol del usuario
                        if (data.rol === 'Cliente') {
                            $(".address").show();
                            $("#add").val(data.direccion || '');
                        } else {
                            $(".address").hide();
                        }
                    } else {
                        // Limpiar campos si no se encuentra un usuario
                        $("#name").val('');
                        $("#firstName").val('');
                        $("#lastName").val('');
                        $("#email").val('');
                        $("#add").val('');

                        // Oculta campos adicionales
                        $(".address").hide();
                    }
                }
            });
        });
    });
</script>

<!-- Mostrar dispositvos con factura -->
<script>
    $(document).ready(function () {
        // Al cambiar el valor del input de CI, limpiar la tabla
        $("#ci").on('change', function () {
            limpiarTabla();
        });

        $("#btnBuscarDispositivos").on('click', function () {
            var ci = $("#ci").val();

            // Limpiar la tabla antes de realizar la solicitud AJAX
            limpiarTabla();

            // Realiza la solicitud AJAX al servidor para buscar dispositivos
            $.ajax({
                url: "<?php echo site_url('factura/buscarDispositivosPorCI'); ?>",
                method: "POST",
                data: { ci: ci },
                dataType: "json",
                success: function (data) {
                    // Muestra la tabla de dispositivos y detalles de factura
                    $("#tablaDispositivos").show();

                    // Itera sobre los dispositivos y agrega filas a la tabla
                    $.each(data, function (index, dispositivo) {
                        var detallesFactura = dispositivo.detallesFactura || 'N/A';
                        var montoTotal = dispositivo.montoTotal || 0;

                        // Agrega una fila a la tabla con los detalles del dispositivo y el checkbox de selección
                        var disabledAttribute = index === 0 ? '' : 'disabled'; // No añade 'disabled' a la primera fila
                        $("#cuerpoTabla").append(
                            "<tr>" +
                            "<td style='display: none;'>" + dispositivo.idDispositivo + "</td>" +
                            "<td style='display: none;'>" + dispositivo.idFactura + "</td>" + // Agrega la columna oculta para idFactura
                            "<td></td>" + // Columna de número de fila, se llenará después de ordenar
                            "<td>" + dispositivo.codigo + "</td>" +
                            "<td>" + dispositivo.mes + "</td>" +
                            "<td>" + dispositivo.anio + "</td>" +
                            "<td class='montoTotal'>" + montoTotal + "</td>" +
                            "<td><input type='checkbox' class='form-check-input chkSeleccionar' data-id='" + dispositivo.idDispositivo + "' " + disabledAttribute + "></td>" +
                            "</tr>"
                        );
                    });

                    // Ordena la tabla por dispositivo y luego por detalles de factura
                    ordenarTabla();

                    // Agrega un evento para manejar la selección de filas con checkboxes
                    $(".chkSeleccionar").on('change', function () {
                        // Obtiene el índice de la fila actual
                        var currentIndex = $(this).closest('tr').index();

                        if ($(this).is(':checked')) {
                            // Si el checkbox se ha marcado, habilita el checkbox de la siguiente fila si existe
                            calcularTotalPagar();
                            if (currentIndex < $("#tablaDispositivos tbody tr").length - 1) {
                                $("#tablaDispositivos tbody tr:eq(" + (currentIndex + 1) + ") .chkSeleccionar").prop("disabled", false);
                            }
                        } else {
                            // Si el checkbox se ha desmarcado, deshabilita el checkbox de la siguiente fila si existe
                            $("#tablaDispositivos tbody tr:eq(" + (currentIndex + 1) + ") .chkSeleccionar").prop("disabled", true);
                            calcularTotalPagar();
                        }
                    });

                    // Función para calcular y mostrar el total a pagar
                    function calcularTotalPagar() {
                        var totalPagar = 0;

                        // Itera sobre las filas seleccionadas y suma los montos totales
                        $(".chkSeleccionar:checked").each(function () {
                            var montoTotal = parseFloat($(this).closest('tr').find('.montoTotal').text());
                            totalPagar += montoTotal;
                        });

                        // Muestra el total a pagar en la celda correspondiente
                        $("#totalPagar").text(totalPagar.toFixed(2));
                    }
                }
            });
        });

        // Función para limpiar la tabla
        function limpiarTabla() {
            $("#tablaDispositivos").hide();
            $("#cuerpoTabla").empty();
            $("#totalPagar").text('0.00');
        }

        // Agrega esta función para ordenar el cuerpo de la tabla por detalles de factura y luego por mes de forma descendente (del más antiguo al más nuevo)
        function ordenarTabla() {
            var $table = $("#tablaDispositivos");
            var $tbody = $table.find('tbody');
            var rows = $tbody.find('tr').get();

            rows.sort(function (a, b) {
                var detallesFacturaA = $(a).children('td:eq(4)').text().toLowerCase(); // Columna de detalles de factura
                var detallesFacturaB = $(b).children('td:eq(4)').text().toLowerCase(); // Columna de detalles de factura

                // Comparación por el valor de los detalles de factura
                var detallesComparison = detallesFacturaB.localeCompare(detallesFacturaA);

                // Si los detalles de factura son iguales, compara por el nombre del mes
                if (detallesComparison === 0) {
                    var mesA = $(a).children('td:eq(3)').text().toLowerCase(); // Columna de mes
                    var mesB = $(b).children('td:eq(3)').text().toLowerCase(); // Columna de mes

                    // Comparación por el valor del mes
                    var meses = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];
                    var indexA = meses.indexOf(mesA);
                    var indexB = meses.indexOf(mesB);

                    return indexB - indexA;
                }

                return detallesComparison;
            });

            $.each(rows, function (index, row) {
                $tbody.append(row);
            });

            // Actualiza el número de fila después de la ordenación
            $tbody.find('tr').each(function (index) {
                $(this).find('td:eq(2)').text(index + 1);
            });
        }

        // Agrega un evento para manejar el envío del formulario
        $("#formPagar").submit(function () {
            // Recopila los IDs de los dispositivos seleccionados y los IDs de factura
            var idsSeleccionados = [];
            var idsFactura = [];
            $(".chkSeleccionar:checked").each(function () {
                var fila = $(this).closest('tr');
                var idDispositivo = fila.find('td:first').text();
                var idFactura = fila.find('td:eq(1)').text(); // Índice 1 corresponde a la columna oculta de ID Factura
                idsSeleccionados.push(idDispositivo);
                idsFactura.push(idFactura);
            });

            // Agrega los IDs seleccionados y los IDs de factura como campos ocultos en el formulario
            $("<input>").attr({
                type: "hidden",
                name: "idsSeleccionados",
                value: idsSeleccionados.join(",")
            }).appendTo("#formPagar");

            $("<input>").attr({
                type: "hidden",
                name: "idsFactura",
                value: idsFactura.join(",")
            }).appendTo("#formPagar");

            // Muestra los valores en la consola
            console.log("IDs Seleccionados:", idsSeleccionados);
            console.log("IDs Factura:", idsFactura);

            // Deshabilita el botón si el input está vacío o no hay filas seleccionadas
            if ($("#ci").val() === '' || idsSeleccionados.length === 0) {
                event.preventDefault(); // Evita el envío del formulario
                alert('Por favor, complete el CI y seleccione al menos una mes para pagar.');
            }

            // Continúa con el envío del formulario
            return true;
        });

        // Agrega un evento para deshabilitar el botón si el input está vacío
        $("#ci").on("input", function () {
            var inputVacio = $(this).val() === '';
            $("#btnPagar").prop("disabled", inputVacio);
        });

        // Agrega un evento para deshabilitar el botón si no hay filas seleccionadas
        $(".chkSeleccionar").on("change", function () {
            var alMenosUnaSeleccionada = $(".chkSeleccionar:checked").length > 0;
            $("#btnPagar").prop("disabled", !alMenosUnaSeleccionada);
        });
        
    });
</script>

<!-- Script de flashdata con toastr -->
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