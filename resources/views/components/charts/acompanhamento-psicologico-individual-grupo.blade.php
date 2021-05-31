@section('script')
    @parent
    @include('layouts.chartjs')
    <script type="text/javascript">
    const chart_data = @json($chart_data);
    const ctx = document.getElementById('chartjs').getContext('2d');

    let chartjs = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: chart_data.labels,
            datasets: [{
                data: chart_data.data,
            }],
        },
        options: {
            title: {
                display: true,
                text: 'ACOMPANHAMENTO PSICOLÓGICO: INDIVIDUAL X EM GRUPO',
                position: 'top'
            },
            legend: {
                position: 'bottom'
            },
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
@endsection
