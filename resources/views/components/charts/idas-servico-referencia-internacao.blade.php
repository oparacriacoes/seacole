@section('script')
    @parent
    @include('layouts.chartjs')

    <script type="text/javascript">
        const chart_data = @json($chart_data);
        const ctx = document.getElementById('chartjs').getContext('2d');

        const data = {
            labels: chart_data.labels,
            datasets: [{
                label: 'Número de idas ao servico de saúde',
                data: chart_data.data,
            }],
        }

        const options = {
            ...CHARTJS_CONFIG.DEFAULT_OPTIONS,
            plugins: {
                datalabels: CHARTJS_CONFIG.DATALABEL.DEFAULT
            }
        }

        options.title.text = 'Número de idas ao servico de saúde'

        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });

        </script>
@endsection