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
                            <h3 class="box-title">New transaction</h3>
                        </div>
                        <!-- /.box-header -->
                        @include('partials.errors')
                        <form role="form" method="post" action="">
                                {{csrf_field()}}
                            <div class="box-body">
                                <div class="row text-center">
                                    <div class="col-lg-4 col-lg-offset-4">
                                        <div class="form-group">
                                            <label for="exampleInputFolderName">Phone Number</label>
                                            <input type="text" class="form-control" placeholder="Enter Phone Number"
                                                   name="phone" value="{{old('phone')}}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <center>
                                    <button type="submit" class="btn btn-success">Add Record</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop