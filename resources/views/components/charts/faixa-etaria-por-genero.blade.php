@section('script')
    @parent
    @include('layouts.chartjs')

    <script type="text/javascript">
        const chart_data = @json($chart_data);
        const ctx = document.getElementById('chartjs').getContext('2d');

        const data = {
            labels: chart_data.labels,
            datasets: chart_data.datasets,
        }

        const options = {
            ...CHARTJS_CONFIG.DEFAULT_OPTIONS,
            scales: {
                yAxes: [{
                    stacked: true
                }],
                xAxes: [{
                    stacked: false
                }]
            },
            plugins: {
                datalabels: {
                    ...CHARTJS_CONFIG.DATALABEL.DEFAULT,
                    display: function(context) {
                        return context.dataset.data[context.dataIndex] != 0 ? 'auto' : false;
                    }
                }
            }
        }

        options.title.text = 'FAIXA ETÁRIA POR GÊNERO'

        new Chart(ctx, {
            type: 'horizontalBar',
            data: data,
            options: options
        });

    </script>
@endsection