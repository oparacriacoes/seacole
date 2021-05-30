@section('script')
    @parent
    @include('layouts.chartjs')

    <script type="text/javascript">
        const chart_data = @json($chart_data);
        const ctx = document.getElementById('chartjs').getContext('2d');

        const data = {
            labels: chart_data.labels,
            datasets: [{
                label: 'Casos Monitorados',
                data: chart_data.data,
            }],
        }

        const options = {
            ...CHARTJS_CONFIG.DEFAULT_OPTIONS,
            plugins: {
                datalabels: CHARTJS_CONFIG.DATALABEL.PERCENTUAL
            }
        }

        options.title.text = 'Situação Total de Casos Monitorados'

        new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });

    </script>
@endsection