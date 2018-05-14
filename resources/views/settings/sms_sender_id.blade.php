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
                            <h3 class="box-title">SMS Sender ID</h3>
                        </div>
                        @include('partials.errors')

                        <div class="box-body">
                            <!-- /.box-header -->
                            <?php
                                $sender_id = \Illuminate\Support\Facades\Auth::user()->sms_sender_id;
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="" method="post">
                                        {{csrf_field()}}
                                        @if(isset($sender_id))
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <p>Current Sender ID: {{$sender_id}}</p>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputFolderName">Sender ID</label>
                                                    <input type="text"  name="sms_sender_id" value="{{old('sms_sender_id')}}" maxlength="6" required class="form-control" placeholder="Enter Sender ID" >
                                                    <p class="help-block"><em>Maximum length: 6 characters</em></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                @if(!isset($sender_id))
                                                    <input type="submit" name="create" class="btn btn-sm btn-success" value="Create">
                                                @else
                                                    <input type="submit" name="update" class="btn btn-sm btn-success" value="Update">
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@stop