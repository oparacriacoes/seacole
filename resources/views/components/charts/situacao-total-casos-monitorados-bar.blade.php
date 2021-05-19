<script type="text/javascript">
    const chart_data = @json($chart_data);

    console.log(chart_data)

    const ctx = document.getElementById('chartjs').getContext('2d');

    let chartjs = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chart_data.labels,
            datasets: [{
                label: 'Pacientes Monitorados x Paciente Exclusivo Psicologia',
                data: chart_data.data,
            }],
        },
        options: {
            plugins: {
                datalabels: {
                    backgroundColor: 'rgb(75, 192, 192)',
                    borderRadius: 4,
                    color: 'white',
                    font: {
                        weight: 'bold'
                    },
                    formatter: Math.round,
                    padding: 6
                }
            }
        }
    });
</script>
