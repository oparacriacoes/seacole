@section('script')
    @parent
    @include('layouts.chartjs')

    <script type="text/javascript">
        const chart_data = @json($chart_data);
        const ctx = document.getElementById('chartjs').getContext('2d');
        const backgroundColors  = []

        for (let label of chart_data.labels) {
            backgroundColors.push(peopleColor(label))
        }

        const data = {
            labels: chart_data.labels,
            datasets: [{
                data: chart_data.data,
                backgroundColor: backgroundColors
            }],
        }

        const options = {
            ...CHARTJS_CONFIG.DEFAULT_OPTIONS,
            plugins: {
                datalabels: CHARTJS_CONFIG.DATALABEL.PERCENTUAL
            }
        }

        options.title.text = chart_data.title

        new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });

    </script>
@endsection
