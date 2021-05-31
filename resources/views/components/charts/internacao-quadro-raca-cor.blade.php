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

        options.title.text = 'Internação Pelo Quadro Raça/Cor'

        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });

    </script>
@endsection
