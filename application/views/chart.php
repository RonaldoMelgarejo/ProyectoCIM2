<div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
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
                            <canvas id="lineChart" width="400" height="200"></canvas>
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

