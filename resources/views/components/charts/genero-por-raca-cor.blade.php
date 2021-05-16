<script type="text/javascript">
    const chart_data = @json($chart_data);

    for(let dataset of chart_data.datasets) {
        dataset.backgroundColor = peopleColor(dataset.label)
    }

    const ctx = document.getElementById('chartjs').getContext('2d');

    let chartjs = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chart_data.labels,
            datasets: chart_data.datasets,
        },
        options: {
            title: {
                display: true,
                position: 'top',
                text: 'GÊNERO POR RAÇA-COR'
            },
            legend: {
                position: 'bottom',
            },
            plugins: {
                datalabels: {
                    backgroundColor: 'rgb(75, 192, 192)',
                    borderRadius: 1,
                    color: 'white',
                    formatter: (value, ctx) => value != '0' ? Math.abs(value) : '',
                    padding: 2,
                    display: function(context) {
                        return context.dataset.data[context.dataIndex] > 0 ? 'auto' : false;
                    },
                    clamp: true
                }
            },
            scales: {
                xAxes: [{
                    stacked: true
                }],
                yAxes: [{
                    stacked: true
                }]
            }
        }
    });
</script>
