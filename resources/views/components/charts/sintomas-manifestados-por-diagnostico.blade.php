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
            ...CHARTJS_CONFIG.STACKED_OPTIONS,
            plugins: {
                datalabels: CHARTJS_CONFIG.DATALABEL.DEFAULT
            }
        }

        options.title.text = 'SINTOMAS MANIFESTADOS POR DIAGNÓSTICO'

        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });

    </script>
@endsection
