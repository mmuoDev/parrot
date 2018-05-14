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
            <?php
                //Today
                $getTodayNewCustomers = \App\Libraries\Utilities::getTodayNewCustomers();
                $getTodayTotalCustomers = \App\Libraries\Utilities::getTodayTotalCustomers();
                $totalAmountSpentToday = \App\Libraries\Utilities::totalAmountSpentToday();
                //7 days
                $get7daysNewCustomers = \App\Libraries\Utilities::get7daysNewCustomers();
                $get7daysTotalCustomers = \App\Libraries\Utilities::get7daysTotalCustomers();
                $totalAmountSpent7days = \App\Libraries\Utilities::totalAmountSpent7days();
            ?>
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">
                    <!-- MAP & BOX PANE -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h2 class="box-title">Dashboard</h2>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>Today's Transactions</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="info-box bg-green">
                                        <span class="info-box-icon"><i class="fa fa-male"></i></span>
                                        <a style="color:white;">
                                            <div class="info-box-content">

                                                <h2>
                                                    <span class="info-box-number" style="font-size: 0.7em; font-weight: bold">New Customers</span>
                                                </h2>
                                                <span class="progress-description">
                                                    {{$getTodayNewCustomers}}
                                                </span>
                                            </div>
                                        </a>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="info-box bg-red">
                                        <span class="info-box-icon"><i class="fa fa-user"></i></span>
                                        <a style="color:white;">
                                            <div class="info-box-content">

                                                <h2>
                                                    <span class="info-box-number" style="font-size: 0.7em; font-weight: bold">Total Unique Customers</span>
                                                </h2>
                                                <span class="progress-description">
                                                    {{$getTodayTotalCustomers}}
                                                </span>
                                            </div>
                                        </a>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="info-box bg-blue">
                                        <span class="info-box-icon"><i class="fa fa-money"></i></span>
                                        <a style="color:white;">
                                            <div class="info-box-content">

                                                <h2>
                                                    <span class="info-box-number" style="font-size: 0.7em; font-weight: bold">Total Amount Spent</span>
                                                </h2>
                                                <span class="progress-description">
                                                    {{isset($totalAmountSpentToday)?'₦'.number_format($totalAmountSpentToday, 2): 0}}
                                                </span>
                                            </div>
                                        </a>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>Last 7 days Transactions</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="info-box bg-orange">
                                        <span class="info-box-icon"><i class="fa fa-male"></i></span>
                                        <a style="color:white;">
                                            <div class="info-box-content">

                                                <h2>
                                                    <span class="info-box-number" style="font-size: 0.7em; font-weight: bold">New Customers</span>
                                                </h2>
                                                <span class="progress-description">
                                                    {{$get7daysNewCustomers}}
                                                </span>
                                            </div>
                                        </a>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="info-box bg-blue">
                                        <span class="info-box-icon"><i class="fa fa-user"></i></span>
                                        <a style="color:white;">
                                            <div class="info-box-content">

                                                <h2>
                                                    <span class="info-box-number" style="font-size: 0.7em; font-weight: bold">Total Unique Customers</span>
                                                </h2>
                                                <span class="progress-description">
                                                    {{$get7daysTotalCustomers}}
                                                </span>
                                            </div>
                                        </a>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="info-box bg-green">
                                        <span class="info-box-icon"><i class="fa fa-money"></i></span>
                                        <a style="color:white;">
                                            <div class="info-box-content">

                                                <h2>
                                                    <span class="info-box-number" style="font-size: 0.7em; font-weight: bold">Total Amount Spent</span>
                                                </h2>
                                                <span class="progress-description">
                                                    {{isset($totalAmountSpent7days)?'₦'.number_format($totalAmountSpent7days, 2): 0}}
                                                </span>
                                            </div>
                                        </a>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>Customers' Behaviour</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="tables2" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Date</th>
                                            <th>New Customers</th>
                                            <th>Total Unique Customers</th>
                                            <th>Total Amount Spent (₦)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($data))
                                                <?php $i = 1; ?>
                                                @foreach($data as $datum)
                                                    <?php
                                                        $new_customers = \App\Libraries\Utilities::getTodayNewCustomers($datum->tdate);
                                                        $tdate = date('d-m-Y', strtotime($datum->tdate));
                                                    ?>
                                                    <tr>
                                                        <td>{{$i++}}</td>
                                                        <td>{{$tdate}}</td>
                                                        <td>{{$new_customers}}</td>
                                                        <td>{{$datum->count}}</td>
                                                        <td>{{isset($datum->total)?number_format($datum->total, 2): 0}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </section>
    </div>
@stop
@section('scripts')

@stop

