@section('script')
    @parent
    @include('layouts.chartjs')
    <script type="text/javascript">
    const ctx = document.getElementById('chartjs').getContext('2d')
    const chart_data = @json($chart_data);

    for (let dataset of chart_data.datasets) {
        dataset.backgroundColor = peopleColor(dataset.label)
    }

    const data = {
        labels: chart_data.labels,
        datasets: chart_data.datasets
    }

    let chartjs = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            title: {
                display: true,
                text: 'PRECISOU IR A ALGUM SERVIÇO DE SAÚDE?',
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
            }
        }
    });

    </script>
@endsection
