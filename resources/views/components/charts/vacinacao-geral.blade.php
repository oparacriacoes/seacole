@section('script')
    @parent
    @include('layouts.chartjs')
    <script type="text/javascript">
        const chart_data = @json($chart_data);
        const ctx = document.getElementById('chartjs').getContext('2d');

        const data = {
            labels: chart_data.labels,
            datasets: [{
                label: 'Vacinação Mensal',
                data: chart_data.data,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }],
        }

        const options = {
            plugins: {
                datalabels: CHARTJS_CONFIG.DATALABEL.DEFAULT
            }
        }

        new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });
        </script>
@endsection
