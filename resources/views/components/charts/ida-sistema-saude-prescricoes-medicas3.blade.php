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

        console.log(chart_data.data)

        const options = {
            ...CHARTJS_CONFIG.DEFAULT_OPTIONS,
            plugins: {
                datalabels: CHARTJS_CONFIG.DATALABEL.PERCENTUAL_VALUE
            }
        }

        options.title.text = 'PRESCRIÇÕES MEDICAMENTOS DE QUEM FOI AO SISTEMA DE SAÚDE (PESSOAS BRANCAS)'

        new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });

    </script>
@endsection
