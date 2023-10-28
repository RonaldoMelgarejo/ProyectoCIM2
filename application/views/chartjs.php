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
                            <!-- <div><canvas id="monitoreoChart" class="d-main" width="400" height="200"></canvas></div> -->
                            <canvas id="monitoreoChart"  width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

    <script>
        var ctx = document.getElementById('monitoreoChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode(array_column($potencia_data, 'fechaHoraMedicion')) ?>,
                datasets: [{
                    label: 'Voltaje (V)',
                    data: <?= json_encode(array_column($potencia_data, 'voltaje')) ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Corriente (A)',
                    data: <?= json_encode(array_column($potencia_data, 'corriente')) ?>,
                    borderColor: 'rgba(192, 75, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'linear',
                        position: 'bottom'
                    }
                }
            }
        });

        function fetchData() {
            $.ajax({
                url: '<?php echo base_url('monitoreo'); ?>', // Reemplaza con la URL de tu vista
                method: 'GET',
                dataType: 'json',
                
                success: function(data) {
                    // Actualiza el gráfico con los nuevos datos
                    chart.data.labels = data.labels;
                    chart.data.datasets[0].data = data.voltaje;
                    chart.data.datasets[1].data = data.corriente;
                    chart.update();
                },
                error: function(error) {
                    console.log('Error al obtener datos: ' + JSON.stringify(error));
                }
            });
        }

        // Actualiza los datos cada 5 segundos (5000 ms)
        setInterval(fetchData, 5000);
    </script>
