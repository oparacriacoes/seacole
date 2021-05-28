<script type="text/javascript">
    const chart_data = @json($chart_data);
    const ctx = document.getElementById('chartjs').getContext('2d');

    let chartjs = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chart_data.labels,
            datasets: [{
                label: 'Número de idas ao servico de saúde',
                data: chart_data.data,
            }],
        },
        options: {
            plugins: {
                datalabels: {
                    backgroundColor: 'rgb(75, 192, 192)',
                    borderRadius: 1,
                    color: 'white',
                    font: {
                        weight: 'bold'
                    },
                    formatter: Math.round,
                    padding: 2
                }
            }
        }
    });
</script>
