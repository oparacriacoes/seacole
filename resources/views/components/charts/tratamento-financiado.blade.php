@section('script')
    @parent
    @include('layouts.chartjs')

    <script type="text/javascript">
        const chart_data = @json($chart_data);
        const ctx = document.getElementById('chartjs').getContext('2d');

        for (let dataset of chart_data.datasets) {
            dataset.backgroundColor = peopleColor(dataset.label)
        }

        const data = {
            labels: chart_data.labels,
            datasets: chart_data.datasets
        }

        const options = {
            ...STACKED_RACE_OPTIONS(chart_data.labels, chart_data.sublabels),
            plugins: {
                datalabels: CHARTJS_CONFIG.DATALABEL.DEFAULT
            }
        }

        console.log(options)

        options.title.text = 'TRATAMENTO FINANCIADO PRESCRITO POR MÉDICOS DO PROJETO'

        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });

    </script>
@endsection
