@extends('layout.main')

@section('container')
<div class="row">
    <div class="card shadow mb-4 border-left-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
        </div>

        <div class="card-body">
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
                <hr>
                Styling for the area chart can be found in the
                <code>/js/demo/chart-area-demo.js</code> file.
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
<script src="{{ url('assets/_vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ url('assets/js/chart-area-demo.js') }}"></script>
@endsection