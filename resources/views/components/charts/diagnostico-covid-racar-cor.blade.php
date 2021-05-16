<script type="text/javascript">
    const chart_data = @json($chart_data);

    console.log(chart_data)

    const ctx = document.getElementById('chartjs').getContext('2d');

    let chartjs = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chart_data.labels,
            datasets: [{
                label: 'Diagnóstico Coid-19 por Raça/Cor',
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
