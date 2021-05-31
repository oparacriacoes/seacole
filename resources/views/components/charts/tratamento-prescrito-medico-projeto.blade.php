<script type="text/javascript">
    const chart_data = @json($chart_data);

    for(let dataset of chart_data.datasets) {
        dataset.backgroundColor = peopleColor(dataset.label)
    }

    const data = {
        labels: chart_data.labels,
        datasets: chart_data.datasets
    }

    const ctx = document.getElementById('chartjs').getContext('2d');

    let chartjs = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            title: {
                display: true,
                text: 'TRATAMENTO PRESCRITO POR MÉDICO DO PROJETO',
                position: 'top'
            },
            legend: {
                position: 'bottom',
            },
            scales: {
                xAxes: [{
                    labels: chart_data.xAxes
                },
                {
                    id: 'xAxis1',
                    type: 'category',
                    offset: true,
                    gridLines: {
                        offsetGridLines: true
                    }
                }
                ]
            },
            plugins: {
                datalabels: {
                    borderRadius: 1,
                    color: 'white',
                    font: {
                        weight: 'normal'
                    },
                    padding: 2,
                    formatter: (value, ctx) => value != '0' ? Math.abs(value) : '',
                }
            }
        }
    });
</script>
