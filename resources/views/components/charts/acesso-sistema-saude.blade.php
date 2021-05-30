@section('script')
    @parent
    @include('layouts.chartjs')
    <script type="text/javascript">
    const ctx = document.getElementById('chartjs').getContext('2d')
    const chart_data = @json($chart_data);

    for (let dataset of chart_data.datasets) {
        dataset.backgroundColor = peopleColor(dataset.label)
    }

    let labels = []
    const data = {
        labels: chart_data.labels,
        datasets: chart_data.datasets
    }

    chart_data.sublabels.forEach((index) => {
        labels = labels.concat(data.labels)
    })

    let chartjs = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            title: {
                display: true,
                text: 'COMO ACESSA O SISTEMA DE SAÚDE?',
                position: 'top'
            },
            legend: {
                position: 'bottom',
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
            },
            scales: {
                xAxes: [
                    {
                        id: 'labels',
                        labels: labels
                    },
                    {
                        id: 'sublabels',
                        type: 'category',
                        offset: true,
                        gridLines: {
                            offsetGridLines: true
                        },
                        labels: chart_data.sublabels
                    },
                ]
            },
        }
    });

    </script>
@endsection
