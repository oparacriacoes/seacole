<script type="text/javascript">
    const chart_data = @json($chart_data);

    console.log(chart_data)

    const ctx = document.getElementById('chartjs').getContext('2d');

    let chartjs = new Chart(ctx, {
        type: 'pie',
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
                    borderRadius: 1,
                    color: 'white',
                    font: {
                        weight: 'bold'
                    },
                    formatter: (value, ctx) => {
                        let sum = ctx.dataset._meta[0].total;
                        let percentage = (value * 100 / sum).toFixed(2) + "%";
                        return percentage;
                    },
                    padding: 2
                }
            }
        }
    });
</script>
