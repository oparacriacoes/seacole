<script type="text/javascript">
    const chart_data = @json($chart_data);

    console.log(chart_data)

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
                    borderRadius: 4,
                    color: 'white',
                    font: {
                        weight: 'bold'
                    },
                    formatter: Math.round,
                    padding: 6
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
