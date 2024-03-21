@extends('index')
@section('content')

<div class="page-inner">
    <div class="panel-header">
        <div class="page-header">
            <h4 class="page-title">Dashboard</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Dashboard</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3>Percentage of Documents per Type</h3>
                </div>
                <div class="card-body" id="content">
                    <div class="chart-container">
                        <canvas id="pie" style="width: 50%; height: 50%"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3>Documents Created per Month ({{ date('Y')}})</h3>
                </div>
                <div class="card-body" id="content">
                    <div class="chart-container">
                        <canvas id="line"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{ asset('atlantis/assets/js/plugin/chart.js/chart.min.js') }}"></script>
<script>

    var pieLabel = "{{ json_encode($DocumentsPerType[0]) }}";
    var pieData = "{{ json_encode($DocumentsPerType[1]) }}";
    var pieColor = "{{ json_encode($DocumentsPerType[2]) }}";

    var lineData = "{{ json_encode($DocumentsPerMonth) }}";

    pieChart = document.getElementById('pie').getContext('2d');
    lineChart = document.getElementById('line').getContext('2d');

    var myPieChart = new Chart(pieChart, {
            type: 'pie',
            data: {
                datasets: [{
                    data: JSON.parse(pieData.replace(/&quot;/g,'"')),
                    backgroundColor :JSON.parse(pieColor.replace(/&quot;/g,'"')),
                    borderWidth: 0
                }],
                labels: JSON.parse(pieLabel.replace(/&quot;/g,'"')) //['New Visitors', 'Subscribers', 'Active Users']
            },
            options : {
                responsive: true, 
                maintainAspectRatio: false,
                legend: {
                    position : 'bottom',
                    labels : {
                        fontColor: 'rgb(154, 154, 154)',
                        fontSize: 11,
                        usePointStyle : true,
                        padding: 20
                    }
                },
                pieceLabel: {
                    render: 'percentage',
                    fontColor: 'white',
                    fontSize: 14,
                },
                tooltips: false,
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 20,
                        bottom: 20
                    }
                }
            }
        });

    var myLineChart = new Chart(lineChart, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Documents Created",
                    borderColor: "#1d7af3",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#1d7af3",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    backgroundColor: 'transparent',
                    fill: true,
                    borderWidth: 2,
                    data: JSON.parse(lineData.replace(/&quot;/g,'"')) //[542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 900]
                }]
            },
            options : {
                responsive: true, 
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels : {
                        padding: 10,
                        fontColor: '#1d7af3',
                    }
                },
                tooltips: {
                    bodySpacing: 4,
                    mode:"nearest",
                    intersect: 0,
                    position:"nearest",
                    xPadding:10,
                    yPadding:10,
                    caretPadding:10
                },
                layout:{
                    padding:{left:15,right:15,top:15,bottom:15}
                }
            }
        });
</script>
@endpush