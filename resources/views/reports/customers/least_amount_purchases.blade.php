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
                            <h3 class="box-title">Customer Reports: Least Amount Spent</h3>
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
                                <div class="col-lg-7">
                                    <div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
                                    @if(isset($data))
                                    @section('scripts')
                                        <script>
                                            var data = '<?php echo $data; ?>';
                                            var r_data = JSON.parse(data);

                                            console.log(r_data);
                                            console.log(r_data[0]);
                                            var categories = r_data[0];
                                            var data = r_data[1];
                                            console.log(data);
                                            Highcharts.chart('container', {
                                                chart: {
                                                    type: 'bar'
                                                },
                                                title: {
                                                    text: 'Least Amount Spent'
                                                },
                                                subtitle: {
                                                    //text: 'Source: <a href="https://en.wikipedia.org/wiki/World_population">Wikipedia.org</a>'
                                                },
                                                xAxis: {
                                                    categories: categories,
                                                    title: {
                                                        text: null
                                                    }
                                                },
                                                yAxis: {
                                                    min: 0,
                                                    allowDecimals: false,
                                                    title: {
                                                        text: 'Amount Spent',
                                                        align: 'high'
                                                    },
                                                    // labels: {
                                                    //     overflow: 'justify'
                                                    // }
                                                },
                                                plotOptions: {
                                                    bar: {
                                                        dataLabels: {
                                                            enabled: true
                                                        }
                                                    }
                                                },
                                                legend: {
                                                    layout: 'vertical',
                                                    align: 'right',
                                                    verticalAlign: 'top',
                                                    x: -40,
                                                    y: 80,
                                                    floating: false,
                                                    borderWidth: 1,
                                                    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                                    shadow: true
                                                },
                                                credits: {
                                                    enabled: false
                                                },
                                                series: [data]
                                            });
                                        </script>
                                    @stop
                                </div>
                                <div class="col-lg-5">
                                    <!-- List these guys and show last purchase dates -->
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Last Purchase</th>
                                            <th>Purchase History</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $data = json_decode($data, true);
                                        $customers = isset($data[2])?$data[2]:"";
                                        //dd($customers);
                                        ?>
                                        @if(!empty($customers))
                                            @foreach($customers as $customer)
                                                <?php
                                                $customer_name = \App\Customer::where('id', $customer)->first()->customer_name;
                                                $last_purchase = \App\Customer::where('id', $customer)->first()->last_purchase;
                                                $phone_number = \App\Customer::where('id', $customer)->first()->phone_number;
                                                ?>
                                                <tr>
                                                    <td>{{ucwords($customer_name)}}</td>
                                                    <td>{{date('l jS \of F, Y', strtotime($last_purchase))}}</td>
                                                    <td><a class="btn btn-primary btn-sm" href="{{url('customers/purchases/'.$phone_number)}}"><i class="fa fa-history"></i></a></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
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

