<script type="text/javascript">
const chart_data = @json($chart_data);

console.log(chart_data)

const ctx = document.getElementById('chartjs').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chart_data.labels,
            datasets: [{
                label: 'Novos Casos Monitorados',
                data: chart_data.data,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
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
