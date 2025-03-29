@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">All Users Expenses Report</div>
        <div class="card-body">
            <div id="chart" style="width: 100%; height: 400px;"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var chart = echarts.init(document.getElementById('chart'));
        var option = {
            title: { text: 'Expenses by Category (All Users)' },
            xAxis: { type: 'category', data: @json($categories->pluck('name')) },
            yAxis: { type: 'value' },
            series: [{
                data: @json($expenses->groupBy('category_id')->map->sum('amount')->values()),
                type: 'bar'
            }]
        };
        chart.setOption(option);
    </script>
@endsection