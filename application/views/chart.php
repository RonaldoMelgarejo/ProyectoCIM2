<div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
        <div class="col-md-12 col-lg-8">
            <div class="row">
                <div class="form-group">
                    <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                        <select name="chipID" class="form-control">
                        <option value="">Seleccionar ChipID</option>
                        <?php foreach ($chipIDs as $chipID): ?>
                            <option value="<?php echo $chipID['codigo']; ?>"><?php echo $chipID['codigo']; ?></option>
                        <?php endforeach;?>
                        </select>
                    </li>
                </div>
                <div class="col-md-12">
                    <div class="card" data-aos="fade-up" data-aos-delay="800">
                        <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                            <div class="header-title">
                                <h4 class="card-title">Voltaje y Corriente</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="voltajeCorrienteChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card" data-aos="fade-up" data-aos-delay="800">
                        <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                            <div class="header-title">
                                <h4 class="card-title">Potencia</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="potenciaChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!--
<script>
$(document).ready(function () {
    var ctx = document.getElementById('lineChart').getContext('2d');
    var lineChart;

    function updateChart() {
        $.get('<?= base_url('index.php/monitoreo/grafica'); ?>', function (data) {
            console.log(data); // Agrega esta línea para inspeccionar los datos recibidos

            if (data && data.voltaje && data.corriente) {
                console.log('Datos válidos en la respuesta AJAX');
                console.log('Voltaje Data:', data.voltaje);
                console.log('Corriente Data:', data.corriente);
                var voltajeData = data.voltaje;
                var corrienteData = data.corriente;
                // Procesa los datos y actualiza la gráfica
                // Aquí debes utilizar Chart.js para crear y actualizar la gráfica
                var chartData = {
                    labels: voltajeData.map(item => item.fechaHoraMedicion),
                    datasets: [
                        {
                            label: 'Voltaje',
                            data: voltajeData.map(item => item.voltaje),
                            borderColor: 'blue',
                        },
                        {
                            label: 'Corriente',
                            data: corrienteData.map(item => item.corriente),
                            borderColor: 'red',
                        },
                    ],
                };

                if (lineChart) {
                    lineChart.data = chartData;
                    lineChart.update();
                } else {
                    lineChart = new Chart(ctx, {
                        type: 'line',
                        data: chartData,
                    });
                }
            } else {
                console.error('Datos inválidos en la respuesta AJAX');
            }
        }).fail(function () {
            console.error('Error en la solicitud AJAX');
        });
    }

    // Actualiza la gráfica cada X segundos (ajusta el intervalo según tus necesidades)
    setInterval(updateChart, 5000);
    updateChart(); // También actualiza la gráfica al cargar la página
});
</script>
-->

<!-- Funciona y es individual 
<script>
$(document).ready(function () {
    var ctx = document.getElementById('lineChart').getContext('2d');
    var lineChart;
    var maxDataPoints = 20; // Número máximo de puntos de datos a mostrar

    function updateChart() {
        $.get('<?= base_url('index.php/monitoreo/grafica'); ?>', function (data) {
            if (data && data.voltaje && data.corriente) {
                var voltajeData = data.voltaje;
                var corrienteData = data.corriente;

                // Procesa los datos
                // ...

                // Ejemplo de cómo procesar los datos
                var labels = voltajeData.map(item => item.fechaHoraMedicion);
                var voltajeValues = voltajeData.map(item => item.voltaje);
                var corrienteValues = corrienteData.map(item => item.corriente);

                // Asegurarse de que no haya más puntos de datos que el límite
                if (labels.length > maxDataPoints) {
                    labels = labels.slice(-maxDataPoints);
                    voltajeValues = voltajeValues.slice(-maxDataPoints);
                    corrienteValues = corrienteValues.slice(-maxDataPoints);
                }

                // Actualiza la gráfica
                if (lineChart) {
                    lineChart.data.labels = labels;
                    lineChart.data.datasets[0].data = voltajeValues;
                    lineChart.data.datasets[1].data = corrienteValues;
                    lineChart.update();
                } else {
                    lineChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Voltaje',
                                    data: voltajeValues,
                                    borderColor: 'blue',
                                },
                                {
                                    label: 'Corriente',
                                    data: corrienteValues,
                                    borderColor: 'red',
                                },
                            ],
                        },
                    });
                }
            } else {
                console.error('Datos inválidos en la respuesta AJAX');
            }
        }).fail(function () {
            console.error('Error en la solicitud AJAX');
        });
    }

    // Actualiza la gráfica cada X segundos (ajusta el intervalo según tus necesidades)
    setInterval(updateChart, 5000);
    updateChart(); // También actualiza la gráfica al cargar la página
});
</script>
-->
<!-- Funciona en grupo pero rescata todo
<script>
$(document).ready(function () {
    var ctxVoltajeCorriente = document.getElementById('voltajeCorrienteChart').getContext('2d');
    var voltajeCorrienteChart;
    var ctxPotencia = document.getElementById('potenciaChart').getContext('2d');
    var potenciaChart;
    var maxDataPoints = 20;

    function updateVoltajeCorrienteChart() {
        $.get('<?= base_url('index.php/monitoreo/grafica/voltajeCorriente'); ?>', function (data) {
            if (data && data.voltaje && data.corriente) {
                var voltajeData = data.voltaje;
                var corrienteData = data.corriente;

                // Procesa los datos
                // ...

                // Ejemplo de cómo procesar los datos
                var labels = voltajeData.map(item => item.fechaHoraMedicion);
                var voltajeValues = voltajeData.map(item => item.voltaje);
                var corrienteValues = corrienteData.map(item => item.corriente);

                // Asegurarse de que no haya más puntos de datos que el límite
                if (labels.length > maxDataPoints) {
                    labels = labels.slice(-maxDataPoints);
                    voltajeValues = voltajeValues.slice(-maxDataPoints);
                    corrienteValues = corrienteValues.slice(-maxDataPoints);
                }

                // Actualiza la gráfica de voltaje y corriente
                if (voltajeCorrienteChart) {
                    voltajeCorrienteChart.data.labels = labels;
                    voltajeCorrienteChart.data.datasets[0].data = voltajeValues;
                    voltajeCorrienteChart.data.datasets[1].data = corrienteValues;
                    voltajeCorrienteChart.update();
                } else {
                    voltajeCorrienteChart = new Chart(ctxVoltajeCorriente, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Voltaje',
                                    data: voltajeValues,
                                    borderColor: 'blue',
                                },
                                {
                                    label: 'Corriente',
                                    data: corrienteValues,
                                    borderColor: 'red',
                                },
                            ],
                        },
                    });
                }
            } else {
                console.error('Datos inválidos en la respuesta AJAX');
            }
        }).fail(function () {
            console.error('Error en la solicitud AJAX');
        });
    }

    function updatePotenciaChart() {
        $.get('<?= base_url('index.php/monitoreo/grafica/potencia'); ?>', function (data) {
            if (data && data.potencia) {
                var potenciaData = data.potencia;

                // Procesa los datos
                // ...

                // Ejemplo de cómo procesar los datos
                var labels = potenciaData.map(item => item.fechaHoraMedicion);
                var potenciaValues = potenciaData.map(item => item.potencia);

                // Asegurarse de que no haya más puntos de datos que el límite
                if (labels.length > maxDataPoints) {
                    labels = labels.slice(-maxDataPoints);
                    potenciaValues = potenciaValues.slice(-maxDataPoints);
                }

                // Actualiza la gráfica de potencia
                if (potenciaChart) {
                    potenciaChart.data.labels = labels;
                    potenciaChart.data.datasets[0].data = potenciaValues;
                    potenciaChart.update();
                } else {
                    potenciaChart = new Chart(ctxPotencia, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Potencia',
                                    data: potenciaValues,
                                    borderColor: 'green',
                                },
                            ],
                        },
                    });
                }
            } else {
                console.error('Datos inválidos en la respuesta AJAX');
            }
        }).fail(function () {
            console.error('Error en la solicitud AJAX');
        });
    }

    // Actualiza las gráficas cada X segundos (ajusta el intervalo según tus necesidades)
    setInterval(updateVoltajeCorrienteChart, 5000);
    setInterval(updatePotenciaChart, 5000);
    updateVoltajeCorrienteChart();
    updatePotenciaChart();
});
</script>
-->
<!--
<script>
$(document).ready(function () {
    var ctxVoltajeCorriente = document.getElementById('voltajeCorrienteChart').getContext('2d');
    var voltajeCorrienteChart;
    var maxDataPoints = 20;

    function updateVoltajeCorrienteChart() {
        var chipID = $('select[name="chipID"]').val();

        // Verificar si el chipID está seleccionado
        if (!chipID) {
            console.error('Seleccione un chipID antes de actualizar la gráfica.');
            return;
        }

        $.ajax({
            url: '<?= base_url('index.php/monitoreo/obtenerVoltajeCorrientePorChipID'); ?>',
            method: 'GET',
            data: { chipID: chipID },
            dataType: 'json',
            success: function (data) {
                if (data && data.voltaje && data.corriente) {
                    var voltajeData = data.voltaje;
                    var corrienteData = data.corriente;

                    // Procesar los datos
                    var labels = voltajeData.map(item => item.fechaHoraMedicion);
                    var voltajeValues = voltajeData.map(item => item.voltaje);
                    var corrienteValues = corrienteData.map(item => item.corriente);

                    // Asegurarse de que no haya más puntos de datos que el límite
                    if (labels.length > maxDataPoints) {
                        labels = labels.slice(-maxDataPoints);
                        voltajeValues = voltajeValues.slice(-maxDataPoints);
                        corrienteValues = corrienteValues.slice(-maxDataPoints);
                    }

                    // Actualizar la gráfica de voltaje y corriente
                    if (voltajeCorrienteChart) {
                        voltajeCorrienteChart.data.labels = labels;
                        voltajeCorrienteChart.data.datasets[0].data = voltajeValues;
                        voltajeCorrienteChart.data.datasets[1].data = corrienteValues;
                        voltajeCorrienteChart.update();
                    } else {
                        voltajeCorrienteChart = new Chart(ctxVoltajeCorriente, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [
                                    {
                                        label: 'Voltaje',
                                        data: voltajeValues,
                                        borderColor: 'blue',
                                    },
                                    {
                                        label: 'Corriente',
                                        data: corrienteValues,
                                        borderColor: 'red',
                                    },
                                ],
                            },
                        });
                    }
                } else {
                    console.error('Datos inválidos en la respuesta AJAX');
                }
            },
            error: function () {
                console.error('Error en la solicitud AJAX');
            },
        });
    }

    // Actualizar la gráfica de voltaje y corriente cada X segundos (ajusta el intervalo según tus necesidades)
    setInterval(updateVoltajeCorrienteChart, 5000);
    updateVoltajeCorrienteChart();
});
</script>
-->
<script>
$(document).ready(function () {
    var ctxVoltajeCorriente = document.getElementById('voltajeCorrienteChart').getContext('2d');
    var voltajeCorrienteChart;
    var maxDataPoints = 20;

    // Inicializar la gráfica con datos en blanco
    var initialData = {
        labels: [],
        datasets: [
            {
                label: 'Voltaje',
                data: [],
                borderColor: 'blue',
            },
            {
                label: 'Corriente',
                data: [],
                borderColor: 'red',
            },
        ],
    };

    voltajeCorrienteChart = new Chart(ctxVoltajeCorriente, {
        type: 'line',
        data: initialData,
    });

    function resetChart() {
        voltajeCorrienteChart.data.labels = [];
        voltajeCorrienteChart.data.datasets[0].data = [];
        voltajeCorrienteChart.data.datasets[1].data = [];
        voltajeCorrienteChart.update();
    }

    function updateVoltajeCorrienteChart() {
        var chipID = $('select[name="chipID"]').val();

        // Verificar si el chipID está seleccionado
        if (!chipID) {
            console.error('Seleccione un chipID antes de actualizar la gráfica.');
            resetChart(); // Restablecer la gráfica si no hay chipID seleccionado
            return;
        }

        $.ajax({
            url: '<?= base_url('index.php/monitoreo/obtenerVoltajeCorrientePorChipID'); ?>',
            method: 'GET',
            data: { chipID: chipID },
            dataType: 'json',
            success: function (data) {
                if (data && data.voltaje && data.corriente) {
                    var voltajeData = data.voltaje;
                    var corrienteData = data.corriente;

                    // Procesar los datos
                    var labels = voltajeData.map(item => item.fechaHoraMedicion);
                    var voltajeValues = voltajeData.map(item => item.voltaje);
                    var corrienteValues = corrienteData.map(item => item.corriente);

                    // Asegurarse de que no haya más puntos de datos que el límite
                    if (labels.length > maxDataPoints) {
                        labels = labels.slice(-maxDataPoints);
                        voltajeValues = voltajeValues.slice(-maxDataPoints);
                        corrienteValues = corrienteValues.slice(-maxDataPoints);
                    }

                    // Restablecer la gráfica antes de actualizar con nuevos datos
                    resetChart();

                    // Actualizar la gráfica de voltaje y corriente
                    voltajeCorrienteChart.data.labels = labels;
                    voltajeCorrienteChart.data.datasets[0].data = voltajeValues;
                    voltajeCorrienteChart.data.datasets[1].data = corrienteValues;
                    voltajeCorrienteChart.update();
                } else {
                    console.error('Datos inválidos en la respuesta AJAX');
                }
            },
            error: function () {
                console.error('Error en la solicitud AJAX');
                resetChart(); // Restablecer la gráfica en caso de error
            },
        });
    }

    // Actualizar la gráfica de voltaje y corriente cada X segundos (ajusta el intervalo según tus necesidades)
    setInterval(updateVoltajeCorrienteChart, 5000);
    updateVoltajeCorrienteChart();
});

</script>

<script>
$(document).ready(function () {
    var ctxPotencia = document.getElementById('potenciaChart').getContext('2d');
    var potenciaChart;
    var maxDataPoints = 20;

    function updatePotenciaChart() {
        var chipID = $('select[name="chipID"]').val();
        $.get('<?= base_url('index.php/monitoreo/obtenerPotenciaPorChipID'); ?>', {chipID: chipID}, function (data) {
            console.log('Respuesta AJAX:', data);
            if (data && data.potencia) {
                var potenciaData = data.potencia;

                // Ejemplo de cómo procesar los datos
                var labels = potenciaData.map(item => item.fechaHoraMedicion);
                var potenciaValues = potenciaData.map(item => item.potencia);

                // Asegurarse de que no haya más puntos de datos que el límite
                if (labels.length > maxDataPoints) {
                    labels = labels.slice(-maxDataPoints);
                    potenciaValues = potenciaValues.slice(-maxDataPoints);
                }

                // Actualiza la gráfica de potencia
                if (potenciaChart) {
                    potenciaChart.data.labels = labels;
                    potenciaChart.data.datasets[0].data = potenciaValues;
                    potenciaChart.update();
                } else {
                    potenciaChart = new Chart(ctxPotencia, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Potencia',
                                    data: potenciaValues,
                                    borderColor: 'green',
                                },
                            ],
                        },
                    });
                }
            } else {
                console.error('Datos inválidos en la respuesta AJAX');
            }
        }).fail(function () {
            console.error('Error en la solicitud AJAX');
        });
    }

    // Actualiza la gráfica de potencia cada X segundos (ajusta el intervalo según tus necesidades)
    setInterval(updatePotenciaChart, 5000);
    updatePotenciaChart();
});
</script>