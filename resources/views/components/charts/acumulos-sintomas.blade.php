@section('script')
    @parent
    @include('layouts.chartjs')
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-stacked100"></script>

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
                datalabels: CHARTJS_CONFIG.DATALABEL.DEFAULT,
                stacked100: {
                    enable: true
                }
            }
        }

        options.plugins.datalabels.formatter = (_value, context) => {
            const data = context.chart.data;
            const {
                datasetIndex,
                dataIndex
            } = context;
            return `${data.calculatedData[datasetIndex][dataIndex]}% (${data.originalData[datasetIndex][dataIndex]})`;
        }

        options.title.text = 'ACÚMULO DE SINTOMAS'

        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });

    </script>
@endsection
