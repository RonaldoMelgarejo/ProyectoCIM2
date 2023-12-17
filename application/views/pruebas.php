



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Título</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

<div class="container">

    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="form-group">
                <label for="dispositivos">Dispositivos Registrados</label>
                <select class="form-control mx-auto my-2" id="dispositivos" name="dispositivos" style="width: 100px; height: 40px;">
                    <!-- Opciones se cargarán dinámicamente con JavaScript -->
                </select>
            </div>
            <div class="form-group">
                <label for="tipoGrafica">Tipo de Gráfica</label>
                <select class="form-control mx-auto my-2" id="tipoGrafica" name="tipoGrafica" style="width: 150px; height: 40px;">
                    <option value="voltajeCorriente">Voltaje y Corriente</option>
                    <option value="potencia">Potencia</option>
                </select>
            </div>
            <div class="col-md-12 col-lg-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" data-aos="fade-up" data-aos-delay="800">
                            <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                                <div class="header-title">
                                    <h4 class="card-title">Monitoreo</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="graficaChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function () {
            // Inicializar el combo con una opción en blanco
            var dispositivosCombo = $('#dispositivos');
            dispositivosCombo.empty();
            dispositivosCombo.append($('<option>').text('').attr('value', ''));

            // Hacer una petición AJAX para obtener los dispositivos del usuario
            var idUsuario = <?php echo $this->session->userdata('idusuario'); ?>;
            $.ajax({
                type: 'GET',
                url: '<?php echo site_url('usuario/obtenerDispositivos/') ?>' + idUsuario,
                dataType: 'json',
                success: function (response) {
                    // Llenar dinámicamente el combobox con los dispositivos del usuario
                    $.each(response, function (index, dispositivo) {
                        dispositivosCombo.append($('<option>').text(dispositivo.codigo).attr('value', dispositivo.id));
                    });
                },
                error: function () {
                    console.log('Error al obtener dispositivos del usuario.');
                }
            });

            // Evento para capturar el valor del dispositivo seleccionado
            dispositivosCombo.on('change', function () {
                var dispositivoSeleccionado = $(this).val();
                console.log('Dispositivo Seleccionado:', dispositivoSeleccionado);
                $('#dispositivoSeleccionado').val(dispositivoSeleccionado);
            });

            // Evento para capturar el cambio en el tipo de gráfica seleccionada
            $('#tipoGrafica').on('change', function () {
                var tipoGraficaSeleccionada = $(this).val();
                console.log('Tipo de Gráfica Seleccionada:', tipoGraficaSeleccionada);
                updateCharts($('#dispositivos').val(), tipoGraficaSeleccionada);
            });

            // Actualiza las gráficas cada X segundos (ajusta el intervalo según tus necesidades)
            setInterval(function () {
                var dispositivoSeleccionado = $('#dispositivos').val();
                var tipoGraficaSeleccionada = $('#tipoGrafica').val();
                updateCharts(dispositivoSeleccionado, tipoGraficaSeleccionada);
            }, 5000);

            updateCharts($('#dispositivos').val(), $('#tipoGrafica').val());
        });

        function updateCharts(dispositivoId, tipoGrafica) {
            var ctxGrafica = document.getElementById('graficaChart').getContext('2d');

            switch (tipoGrafica) {
                case 'voltajeCorriente':
                    updateVoltajeCorrienteChart(ctxGrafica, dispositivoId);
                    break;

                case 'potencia':
                    updatePotenciaChart(ctxGrafica, dispositivoId);
                    break;

                default:
                    console.error('Tipo de gráfica no reconocido');
                    break;
            }
        }

        function updateVoltajeCorrienteChart(ctx, dispositivoId) {
            $.get('<?= base_url('index.php/monitoreo/grafica/voltajeCorriente/'); ?>' + dispositivoId, function (data) {
                console.log('Datos recibidos:', data);

                // Parsear los datos recibidos desde el controlador
                var labels = data.map(function (item) {
                    return item.fechaHoraMedicion;
                });

                var voltajeData = data.map(function (item) {
                    return item.voltaje;
                });

                var corrienteData = data.map(function (item) {
                    return item.corriente;
                });

                // Configurar y actualizar la gráfica de voltaje y corriente
                var voltajeCorrienteChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Voltaje',
                            data: voltajeData,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            fill: false
                        }, {
                            label: 'Corriente',
                            data: corrienteData,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            fill: false
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                type: 'linear',
                                position: 'bottom'
                            }
                        }
                    }
                });
            }).fail(function () {
                console.error('Error en la solicitud AJAX para voltaje y corriente');
            });
        }

        function updatePotenciaChart(ctx, dispositivoId) {
            $.get('<?= base_url('index.php/monitoreo/grafica/potencia/'); ?>' + dispositivoId, function (data) {
                // Parsear los datos recibidos desde el controlador
                var labels = data.map(function (item) {
                    return item.fechaHoraMedicion;
                });

                var potenciaData = data.map(function (item) {
                    return item.potencia;
                });

                // Configurar y actualizar la gráfica de potencia
                var potenciaChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Potencia',
                            data: potenciaData,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            fill: false
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                type: 'linear',
                                position: 'bottom'
                            }
                        }
                    }
                });
            }).fail(function () {
                console.error('Error en la solicitud AJAX para potencia');
            });
        }

    </script>

</div>

</body>
</html>

