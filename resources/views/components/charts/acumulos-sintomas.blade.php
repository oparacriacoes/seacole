<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-stacked100">    </script>
@endsection
@section('script')
    @parent
    @include('layouts.chartjs')
    <script type="text/javascript">
    const chart_data = @json($chart_data);

    const ctx = document.getElementById('chartjs').getContext('2d');

    console.log(chart_data.datasets)

    let chartjs = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chart_data.labels,
            datasets: chart_data.datasets,
        },
        options: {
            title: {
                display: true,
                text: 'ACÚMULO DE SINTOMAS',
                position: 'top'
            },
            legend: {
                position: 'bottom',
            },
            scales: {
                yAxes: [
                    {
                        stacked: true
                    }
                ],
                xAxes: [
                    {
                        stacked: true
                    },
                ]
            },
            plugins: {
                datalabels: {
                    color: 'white',
                    font: {
                        weight: 'bold',
                    },
                    formatter: (value, ctx) => value != '0' ? Math.abs(value) : '',
                },
                stacked100: { enable: true }
            }
        }
    });

    </script>
@endsection
