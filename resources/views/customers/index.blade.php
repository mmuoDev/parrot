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
                <?php
                    $count = \App\Libraries\Utilities::getTotalCustomers();
                ?>
                <div class="col-md-12">
                    <!-- MAP & BOX PANE -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Customers</h3>
                            <span class="pull-right"><button class="btn btn-default btn-sm" type="button">Total: {{$count}}</button></span>
                        </div>
                        @include('partials.errors')
                        <div class="box-body">
                            <!-- /.box-header -->
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped server_table">
                                        <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>Total Purchases (₦)</th>
                                            <th>Date Joined</th>
                                            <th>Last Purchase</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@stop