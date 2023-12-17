<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card" id="facturaCard" >
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Recibo</h4>
                        </div>
                    </div>
                    <div class="card-body">
                            <form method="POST" action="<?php echo site_url('factura/generarFacturaParaDispositivo'); ?>">
                            <?php if (isset($row) && !empty($row)): ?>

                                <input type="hidden" id="idDispositivo" name="idDispositivo" value="<?php echo $row[0]->idDispositivo; ?>">
                                <input type="hidden" id="idCliente" name="idCliente" value="<?php echo $row[0]->idCliente; ?>">

                                <div class="row">

                                    <div class="form-group col-md-2">
                                        <label class="form-label">Código Dispositivo:</label>
                                        <input type="text" class="form-control" id="codigo" name="codigo" placeholder="" value="<?php echo $row[0]->codigo; ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="form-label">Fecha Emision:</label>
                                        <input type="text" class="form-control" id="fechaEmision" name="fechaEmision" placeholder="" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="form-label">Mes de Leturacion:</label>
                                        <input type="text" class="form-control" id="mes" name="mes" placeholder="" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="fname">Potencia Generada [Wh]:</label>
                                        <input type="text" class="form-control" id="lanterior" name="lanterior" placeholder="" value="<?php echo $row[0] ->potenciaGeneradaMesAnterior; ?>"readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="lname">Potencia Consumida [Wh]:</label>
                                        <input type="text" class="form-control" id="lactual" name="lactual" placeholder="" value="<?php echo $row[0] ->potenciaConsumidaMesAnterior; ?>"  readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="fname">Nombre:</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="" value="<?php echo $row[0] ->nombre; ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="lname">Primer Apellido:</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="<?php echo $row[0] ->primerApellido; ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="form-label" for="lname">Segundo Apellido:</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="<?php echo $row[0] ->segundoApellido; ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-4 address">
                                        <label class="form-label" for="add">Dirección:</label>
                                        <input type="text" class="form-control" id="add" name="add" placeholder="" value="<?php echo $row[0] ->direccion; ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-2 address">
                                        <label class="form-label" for="add">Tarifa [kW/h]:</label>
                                        <input type="text" class="form-control" id="tarifa" name="tarifa" value="0.4" placeholder="" readonly>
                                    </div>
                                    <div class="form-group col-md-2 address">
                                        <label class="form-label" for="add">Monto Total [Bs.]:</label>
                                        <input type="text" class="form-control" id="montoTotal" name="montoTotal" placeholder="" readonly>
                                    </div>                                    
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success" style="margin-right: 10px;">Generar</button>
                                        <a href="<?php echo site_url('monitoreo/aviso'); ?>" class="btn btn-danger">Cancelar</a>

                                    </div>
                                </div>
                                <?php else: ?>
                                    <!-- Código de manejo de error o mensaje de que no hay datos -->
                                    <p>No se encontraron datos de factura para mostrar.</p>
                                <?php endif; ?>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Agrega este script al final de tu página antes de cerrar el body -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Agrega este script al final de tu página antes de cerrar el body -->
<script>
    $(document).ready(function () {
        // Obtén la fecha actual en el formato "YYYY-MM-DD"
        var fechaActual = obtenerFechaActual();

        // Establece la fecha actual en el campo de entrada de fecha
        $("#fechaEmision").val(fechaActual);

        // Obtén el mes anterior
        var mesAnterior = obtenerMesAnterior();

        // Traduce el número del mes a su representación textual
        var mesTexto = traducirMes(mesAnterior);

        // Establece el mes anterior en el campo de entrada de mes
        $("#mes").val(mesTexto);

        // Calcula el monto total
        var potenciaConsumidaMesAnterior = <?php echo $row[0]->potenciaConsumidaMesAnterior; ?>;
        var montoTotal = potenciaConsumidaMesAnterior * 0.0004;

        // Establece el monto total en el campo de entrada correspondiente
        $("#montoTotal").val(montoTotal.toFixed(2)); // Redondea a dos decimales

        // Resto del script...

        // Función para obtener la fecha actual en el formato "YYYY-MM-DD"
        function obtenerFechaActual() {
            var fecha = new Date();
            var dia = ("0" + fecha.getDate()).slice(-2);
            var mes = ("0" + (fecha.getMonth() + 1)).slice(-2);
            var anio = fecha.getFullYear();
            return anio + "-" + mes + "-" + dia;
        }

        // Función para obtener el mes anterior
        function obtenerMesAnterior() {
            var fecha = new Date();
            fecha.setMonth(fecha.getMonth() - 1);
            var mesAnterior = fecha.getMonth() + 1; // Sumar 1 porque los meses van de 0 a 11
            return mesAnterior;
        }

        // Función para traducir el número del mes a su representación textual
        function traducirMes(numeroMes) {
            var meses = [
                "enero", "febrero", "marzo", "abril", "mayo", "junio",
                "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
            ];
            return meses[numeroMes - 1]; // Restamos 1 porque los meses van de 1 a 12 en JavaScript
        }
    });
</script>

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

