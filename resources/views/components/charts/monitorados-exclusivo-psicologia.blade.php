@section('script')
    @parent
    @include('layouts.chartjs')
    <script type="text/javascript">
        const chart_data = @json($chart_data);
        const ctx = document.getElementById('chartjs').getContext('2d');

        const data = {
            labels: chart_data.labels,
            datasets: [{
                label: 'Pacientes Monitorados x Paciente Exclusivo Psicologia',
                data: chart_data.data,
            }],
        }

        const options = {
            ...CHARTJS_CONFIG.DEFAULT_OPTIONS,
            plugins: {
                datalabels: CHARTJS_CONFIG.DATALABEL.PERCENTUAL
            }
        }

        options.title.text = 'Pacientes Monitorados x Paciente Exclusivo Psicologia'

        new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });

        </script>
@endsection
