<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Registro de Eventos</h4>
                    </div>
                </div>
                <div class="card-body">
                    
                    <div class="table-responsive col-sm-12">
                        <div>
                            <form action="">
                                <table class="table table-hover table-bordered table-striped" style="white-space: nowrap;">
                                    <tbody>
                                        <tr>
                                            <td style="max-width: 100px; padding: 5px;">Seleccionar Dispositivo:</td>
                                            <td style="max-width: 100px; padding: 5px;">
                                                <!-- <select name="idDispositivo" class="form-control" style="width: 150px; height: 25px;"></select> -->
                                                <select class="form-control" id="idDispositivo" name="idDispositivo">
                                                    <option value="">Seleccionar</option> <!-- Opción por defecto -->

                                                    <?php foreach ($dispositivos as $dispositivo) : ?>
                                                        <option value="<?php echo $dispositivo['idDispositivo']; ?>"><?php echo $dispositivo['codigo']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td style="max-width: 100px; padding: 5px;">Seleccionar Fecha:</td>
                                            <td style="max-width: 100px; padding: 5px;">
                                                <input type="text" class="form-control flatpickr-input" style="width: 130px; height: 25px;" id="fechaInput" name="fechaInput">
                                            </td>
                                            
                                            <td style="max-width: 80px; padding: 5px; position: relative;">
                                                <!-- <input type="submit" value="Ver" class="btn btn-soft-secondary btn-sm" style="max-width: 100px;"> -->
                                                <button id="verButton" type="button" class="btn btn-soft-secondary btn-sm" style="max-width: 100px;" data-toggle="modal" data-target="#botonesModal">Ver</button>
                                                <!-- <a href="" class="btn btn-soft-info btn-sm" style="max-width: 100px;">Exportar..</a> -->
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>

                                <div style="text-align: center; display: none;" id="tablaDiv">
                                    <div >
                                        <table id="miTabla" class="table table-hover table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="max-width: 100px; padding: 5px;">Nro</th>
                                                    <th style="max-width: 100px; padding: 5px;">Dispositivo</th>
                                                    <th style="max-width: 100px; padding: 5px;">Voltaje [V]</th>
                                                    <th style="max-width: 100px; padding: 5px;">Corriente [A]</th>
                                                    <th style="max-width: 100px; padding: 5px;">Potencia[W]</th>
                                                    <th style="max-width: 100px; padding: 5px;">P.Consumida[W]</th>
                                                    <th style="max-width: 100px; padding: 5px;">Fecha y Hora</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div style="text-align: center; display: none;" id="graficasDiv">
                                    <div class="card" >
                                        <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                                            <div class="header-title">
                                                <h4 class="card-title">Voltaje y Corriente</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="voltajeCorrienteChart" width="400" height="200"></canvas>
                                        </div>
                                    </div>

                                    <div class="card" >
                                        <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                                            <div class="header-title">
                                                <h4 class="card-title">Potencia Generada</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="potenciaChart" width="400" height="200"></canvas>
                                        </div>
                                    </div>

                                    <div class="card" >
                                        <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                                            <div class="header-title">
                                                <h4 class="card-title">Potencia Consumida</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="potenciaConsumidaChart" width="400" height="200"></canvas>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        
      
    </div>
    <div class="modal fade" id="botonesModal" tabindex="-1" role="dialog" aria-labelledby="botonesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="botonesModalLabel">Acciones</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-soft-success btn-sm" onclick="mostrarDatos('tabla')">Tabla</button>
                    <button type="button" class="btn btn-soft-secondary btn-sm" onclick="mostrarDatos('graficas')">Gráficas</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Script de flatpickr -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Obtiene el input de fecha por su ID
        var dateInput = document.getElementById('fechaInput');

        // Inicializa Flatpickr en el input
        flatpickr(dateInput, {
            // Puedes configurar las opciones de Flatpickr aquí según tus necesidades
            dateFormat: 'Y-m-d', // Formato de fecha (puedes ajustarlo)
            enableTime: false, // Puedes habilitar la selección de tiempo si es necesario
            // Otras opciones...
        });
    });
</script>

<!-- Enlace CDN para Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Enlace CDN para Moment.js -->
<script src="https://cdn.jsdelivr.net/npm/moment"></script>

<!-- Enlace CDN para el adaptador de fecha de Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>

<!-- Boton ver para seleccionar Grafica o tabla -->
<!-- Agrega las referencias a jQuery, Popper.js y Bootstrap JavaScript al final del cuerpo -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Script para cerrar el modal mediante JavaScript -->
<script>
    // Reemplaza 'botonesModal' con el ID de tu modal
    document.getElementById('botonesModalCloseButton').addEventListener('click', function () {
        var botonesModal = new bootstrap.Modal(document.getElementById('botonesModal'));
        botonesModal.hide();
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var verButton = document.getElementById('verButton');
        var botonesModal = new bootstrap.Modal(document.getElementById('botonesModal'));

        verButton.addEventListener('click', function () {
            // Muestra el modal al hacer clic en el botón "Ver"
            botonesModal.show();
        });
    });
</script>

<!-- Script para visualizar tabla y Grafica 
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var botonesModal = new bootstrap.Modal(document.getElementById('botonesModal'));
        var tablaDiv = document.getElementById('tablaDiv');
        var graficasDiv = document.getElementById('graficasDiv');

        // Función para mostrar la tabla y ocultar las gráficas
        function mostrarTabla() {
            tablaDiv.style.display = 'block';
            graficasDiv.style.display = 'none';
            // Aquí puedes añadir código adicional para actualizar el contenido específico de la tabla
            botonesModal.hide();
        }

        // Función para mostrar las gráficas y ocultar la tabla
        function mostrarGraficas() {
            graficasDiv.style.display = 'block';
            tablaDiv.style.display = 'none';
            // Aquí puedes añadir código adicional para actualizar el contenido específico de las gráficas
            botonesModal.hide();
        }

        // Asigna las funciones a las variables globales para que puedan ser llamadas desde los botones en el HTML
        window.mostrarTabla = mostrarTabla;
        window.mostrarGraficas = mostrarGraficas;
    });
</script> -->

<!-- Prueba -->
<!-- Script para enviar datos al controlador -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var botonesModal = new bootstrap.Modal(document.getElementById('botonesModal'));

        // Función para enviar datos al controlador
        function mostrarDatos(tipo) {
            // Obtenemos los valores directamente de la tabla
            var idDispositivo = document.getElementById('idDispositivo').value;
            var fechaInput = document.getElementById('fechaInput').value;

            // Puedes agregar más lógica aquí para obtener otros valores según tu estructura de tabla

            // Enviamos los datos al controlador
            $.ajax({
                type: "POST",
                url: "<?= base_url('index.php/monitoreo/realizar_consulta'); ?>",
                data: {
                    idDispositivo: idDispositivo,
                    fechaInput: fechaInput
                },
                success: function (response) {
                    // Manejar la respuesta del servidor según el tipo (tabla o gráficas)
                    console.log(response); // Agrega esta línea para verificar la respuesta en la consola

                    /*
                    if (tipo === 'tabla') {
                        // Convertir la respuesta JSON a un objeto JavaScript
                        var datos = JSON.parse(response);

                        console.log(datos); // Agrega esta línea para verificar los datos en la consola

                        // Obtener la referencia a la tabla en la vista
                        var tablaBody = document.querySelector('#miTabla tbody');

                        // Limpiar el contenido actual de la tabla
                        tablaBody.innerHTML = '';

                        // Iterar sobre los datos y agregar filas a la tabla
                        datos.forEach(function (dato, index) {
                            var nuevaFila = "<tr>" +
                                "<td>" + (index + 1) + "</td>" +
                                "<td>" + dato.codigo_dispositivo + "</td>" +
                                "<td>" + dato.voltajeGenerado + "</td>" +
                                "<td>" + dato.corrienteGenerado + "</td>" +
                                "<td>" + dato.potenciaGenerada + "</td>" +
                                "<td>" + dato.fechaHoraMedicion + "</td>" +
                                "</tr>";

                            tablaBody.innerHTML += nuevaFila;
                        });

                        // Actualizar la tabla con los datos devueltos
                        tablaDiv.style.display = 'block';
                        graficasDiv.style.display = 'none';
                    */
                    /*
                    } else if (tipo === 'graficas') {
                        // Actualizar las gráficas con los datos devueltos
                        // Puedes implementar esta parte según tus necesidades
                        // ...

                        
                        // Mostrar las gráficas y ocultar la tabla
                        graficasDiv.style.display = 'block';
                        tablaDiv.style.display = 'none';
                    }
                    */
                   /*
                    } else if (tipo === 'graficas') {
                        // Convertir la respuesta JSON a un objeto JavaScript
                        var datos = JSON.parse(response);

                        // Verificar que 'datos' esté definido y no sea null
                        if (datos && datos.length > 0) {
                            // Obtener arreglos separados para voltaje, corriente y potencia
                            var voltajes = datos.map(function (dato) {
                                return parseFloat(dato.voltajeGenerado);
                            });

                            var corrientes = datos.map(function (dato) {
                                return parseFloat(dato.corrienteGenerado);
                            });

                            var potencias = datos.map(function (dato) {
                                return parseFloat(dato.potenciaGenerada);
                            });

                            // Gráfica de Voltaje y Corriente
                            var voltajeCorrienteChartCanvas = document.getElementById('voltajeCorrienteChart').getContext('2d');
                            var voltajeCorrienteChart = new Chart(voltajeCorrienteChartCanvas, {
                                type: 'line',
                                data: {
                                    labels: datos.map(dato => dato.fechaHoraMedicion),
                                    datasets: [{
                                        label: 'Voltaje',
                                        borderColor: 'blue',
                                        data: voltajes
                                    }, {
                                        label: 'Corriente',
                                        borderColor: 'red',
                                        data: corrientes
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        x: {
                                            type: 'time',
                                            time: {
                                                unit: 'hour'
                                            }
                                        },
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                },
                                adapters: {
                                    date: 'chartjs-adapter-moment' // Indica el adaptador de fecha a utilizar
                                }
                            });

                            // Gráfica de Potencia
                            var potenciaChartCanvas = document.getElementById('potenciaChart').getContext('2d');
                            var potenciaChart = new Chart(potenciaChartCanvas, {
                                type: 'line',
                                data: {
                                    labels: datos.map(dato => dato.fechaHoraMedicion),
                                    datasets: [{
                                        label: 'Potencia',
                                        borderColor: 'green',
                                        data: potencias
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        x: {
                                            type: 'time',
                                            time: {
                                                unit: 'hour'
                                            }
                                        },
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                },
                                adapters: {
                                    date: 'chartjs-adapter-moment' // Indica el adaptador de fecha a utilizar
                                }
                            });

                            // Mostrar las gráficas y ocultar la tabla
                            graficasDiv.style.display = 'block';
                            tablaDiv.style.display = 'none';
                        } else {
                            console.error('Datos no válidos para crear gráficas. Datos recibidos:', datos);
                        }
                    }
                    */

                    // Mostrar Tabla
                    if (tipo === 'tabla') {
                        mostrarTabla(response);
                    }
                    // Mostrar Gráficas
                    else if (tipo === 'graficas') {
                        mostrarGraficas(response);
                    }

                    // Ocultar el modal después de realizar la acción
                    botonesModal.hide();
                },
                error: function (error) {
                    console.error(error);
                }
            });
        }

        // Función para mostrar la tabla y ocultar las gráficas
        function mostrarTabla(response) {
            var datos = JSON.parse(response);

            var tablaBody = $('#miTabla tbody');
            tablaBody.empty();

            datos.forEach(function (dato, index) {
                var nuevaFila = "<tr>" +
                    "<td>" + (index + 1) + "</td>" +
                    "<td>" + dato.codigo_dispositivo + "</td>" +
                    "<td>" + dato.voltajeGenerado + "</td>" +
                    "<td>" + dato.corrienteGenerado + "</td>" +
                    "<td>" + dato.potenciaGenerada + "</td>" +
                    "<td>" + dato.potenciaConsumida + "</td>" +
                    "<td>" + dato.fechaHoraMedicion + "</td>" +
                    "</tr>";

                tablaBody.append(nuevaFila);
            });

            // Mostrar la tabla y ocultar las gráficas
            $('#tablaDiv').removeClass('d-none').addClass('d-block');
            $('#graficasDiv').removeClass('d-block').addClass('d-none');
        }

        // Función para mostrar las gráficas y ocultar la tabla
// Función para mostrar las gráficas y ocultar la tabla
function mostrarGraficas(response) {
    var datos = JSON.parse(response);

    if (datos && datos.length > 0) {
        // Obtener los elementos de las gráficas
        var voltajeCorrienteChartCanvas = document.getElementById('voltajeCorrienteChart');
        var potenciaChartCanvas = document.getElementById('potenciaChart');
        var potenciaConsumidaChartCanvas = document.getElementById('potenciaConsumidaChart');

        // Reemplazar el canvas anterior con uno nuevo
        var nuevoCanvasVoltajeCorriente = document.createElement('canvas');
        nuevoCanvasVoltajeCorriente.id = 'voltajeCorrienteChart';
        voltajeCorrienteChartCanvas.parentNode.replaceChild(nuevoCanvasVoltajeCorriente, voltajeCorrienteChartCanvas);

        var nuevoCanvasPotencia = document.createElement('canvas');
        nuevoCanvasPotencia.id = 'potenciaChart';
        potenciaChartCanvas.parentNode.replaceChild(nuevoCanvasPotencia, potenciaChartCanvas);


        var nuevoCanvasPotenciaConsumida = document.createElement('canvas');
        nuevoCanvasPotenciaConsumida.id = 'potenciaConsumidaChart';
        potenciaConsumidaChartCanvas.parentNode.replaceChild(nuevoCanvasPotenciaConsumida, potenciaConsumidaChartCanvas);
        
        
        // Crear nuevas instancias de las gráficas
        var voltajeCorrienteChart = new Chart(nuevoCanvasVoltajeCorriente, {
            type: 'line',
            data: {
                labels: datos.map(dato => dato.fechaHoraMedicion),
                datasets: [{
                    label: 'Voltaje [V]',
                    borderColor: 'blue',
                    data: datos.map(dato => parseFloat(dato.voltajeGenerado))
                }, {
                    label: 'Corriente [A]',
                    borderColor: 'red',
                    data: datos.map(dato => parseFloat(dato.corrienteGenerado))
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'hour'
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            },
            adapters: {
                date: 'chartjs-adapter-moment'
            }
        });

        var potenciaChart = new Chart(nuevoCanvasPotencia, {
            type: 'line',
            data: {
                labels: datos.map(dato => dato.fechaHoraMedicion),
                datasets: [{
                    label: 'Potencia Generada [W]',
                    borderColor: 'green',
                    data: datos.map(dato => parseFloat(dato.potenciaGenerada))
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'hour'
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            },
            adapters: {
                date: 'chartjs-adapter-moment'
            }
        });

        var potenciaConsumidaChart = new Chart(nuevoCanvasPotenciaConsumida, {
            type: 'line',
            data: {
                labels: datos.map(dato => dato.fechaHoraMedicion),
                datasets: [{
                    label: 'Potencia Consumida [W]',
                    borderColor: 'secondary',
                    data: datos.map(dato => parseFloat(dato.potenciaConsumida))
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'hour'
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            },
            adapters: {
                date: 'chartjs-adapter-moment'
            }
        });

        // Almacenar las nuevas instancias para su posterior destrucción
        window.voltajeCorrienteChart = voltajeCorrienteChart;
        window.potenciaChart = potenciaChart;

        // Mostrar las gráficas y ocultar la tabla
        $('#graficasDiv').removeClass('d-none').addClass('d-block');
        $('#tablaDiv').removeClass('d-block').addClass('d-none');
    } else {
        console.error('Datos no válidos para crear gráficas. Datos recibidos:', datos);
    }
}



        // Asigna la función a una variable global para que pueda ser llamada desde los botones en el HTML
        window.mostrarDatos = mostrarDatos;
    });
</script>



<!--
<script>
    function mostrarTabla() {
        var tablaDiv = document.getElementById('tablaDiv');
        tablaDiv.style.display = tablaDiv.style.display === 'none' ? 'block' : 'none';

        // Cierra el modal después de mostrar/ocultar la tabla
        var botonesModal = new bootstrap.Modal(document.getElementById('botonesModal'));
        botonesModal.hide();
    }
</script> -->


