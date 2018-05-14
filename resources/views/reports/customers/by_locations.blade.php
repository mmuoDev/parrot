@extends('layouts.main-menu')
@section('styles')
    <style>
        #map2 {
            height: 100%;
        }

    </style>
@stop
@section('contents')
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <hr/>
            <!--Error messages -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">
                    <!-- MAP & BOX PANE -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Customer Reports: Number of Customers By Location</h3>
                        </div>
                        @include('partials.errors')
                        <div class="box-body">
                            <!-- /.box-header -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="" method="post">
                                        {{csrf_field()}}

                                        <div class="row">
                                            <div class="col-lg-2 hidden-sm hidden-xs"></div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFolderName">From</label>
                                                    <input type="text"  name="from" value="{{old('from')}}" id="" required class="form-control fromDate" placeholder="From" >
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputFolderName">To</label>
                                                    <input type="text"  name="to" value="{{old('to')}}" required class="form-control toDate"  placeholder="To">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 hidden-sm hidden-xs"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <center>
                                                    <button type="submit" class="btn btn-success">Filter Results</button>
                                                </center>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
                                    @if(isset($data))
                                    @section('scripts')
                                        <script>
                                            var data = '<?php echo $data; ?>';
                                            var r_data = JSON.parse(data);
                                            console.log(r_data);
                                            // Build the chart
                                            Highcharts.chart('container', {
                                                chart: {
                                                    plotBackgroundColor: null,
                                                    plotBorderWidth: null,
                                                    plotShadow: false,
                                                    type: 'pie'
                                                },
                                                title: {
                                                    text: 'Number of Customers By Location'
                                                },
                                                tooltip: {
                                                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                                },
                                                plotOptions: {
                                                    pie: {
                                                        allowPointSelect: true,
                                                        cursor: 'pointer',
                                                        dataLabels: {
                                                            enabled: false
                                                        },
                                                        showInLegend: true
                                                    }
                                                },
                                                series: [{
                                                    name: 'Customers',
                                                    colorByPoint: true,
                                                    data: r_data
                                                }]
                                            });
                                        </script>
                                    @stop
                                </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@stop

