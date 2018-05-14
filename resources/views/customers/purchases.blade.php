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
                            <h3 class="box-title">Purchases for [{{ucwords($name)}}]</h3>
                            <a class="btn btn-danger btn-sm pull-right" href="{{url('/customers')}}">Back to Customers</a>
                        </div>
                        @include('partials.errors')
                        <div class="box-body">
                            <!-- /.box-header -->
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="tables" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Date</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price (₦)</th>
                                            <th>Total (₦)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($purchases))
                                            <?php $i = 0; ?>
                                            @foreach($purchases as $purchase)
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{date('l jS \of F, Y', strtotime($purchase->created))}}</td>
                                                    <td>{{ucwords($purchase->product)}}</td>
                                                    <td>{{$purchase->quantity}}</td>
                                                    <td>{{number_format($purchase->price, 2)}}</td>
                                                    <td>{{number_format($purchase->total, 2)}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@stop