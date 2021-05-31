@section('script')
    @parent
    @include('layouts.chartjs')
    <script type="text/javascript">
    const chart_data = @json($chart_data);
    const ctx = document.getElementById('chartjs').getContext('2d');

    const data = {
        labels: chart_data.labels,
        datasets: [{
            data: chart_data.data,
            hoverOffset: 4
        }]
    }

    let chartjs = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: {
            title: {
                display: true,
                text: 'DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS',
                position: 'top'
            },
            legend: {
                position: 'bottom',
            },
            plugins: {
                datalabels: {
                    color: 'white',
                    font: {
                        weight: 'normal'
                    },
                    formatter: (value, ctx) => {
                        let sum = ctx.dataset._meta[0].total;
                        let percentage = (value * 100 / sum).toFixed(2) + "%";
                        return percentage;
                    }
                }
            }
        }
    });
    </script>
@endsection
