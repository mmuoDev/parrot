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
                            <h3 class="box-title">Customer Locations</h3>
                            <button class="btn btn-sm btn-success pull-right" TYPE="button" data-toggle="modal" title="Project Files" data-target="#location_">Add location</button>
                        </div>
                        @include('partials.errors')
                        <div class="modal fade" id="location_">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">New Location</h4>
                                    </div>
                                    <form class="" method="post" action="">
                                        {{csrf_field()}}
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputFolderName">Location</label>
                                                        <input type="text"  name="location"  required class="form-control" id="exampleInputFolderName" placeholder="E.g. Lekki">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="text-box form-group">
                                                        <label for="exampleInputFile">Select State</label>
                                                        <select name="state_id" id="input" class="form-control" required="required">
                                                            @if(isset($states))
                                                                @foreach($states as $s)
                                                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                        <div class="box-body">
                        <!-- /.box-header -->
                        <div class="row">
                            <div class="col-md-12">
                                <table id="tables2" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Location [State]</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($locations))
                                        <?php $i = 0; ?>
                                        @foreach($locations as $location)
                                            <?php $i++; ?>
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{ucwords($location->location)}} [{{ucfirst($location->state)}}]</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" data-toggle="modal" data-target="#{{$location->location_id}}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></button>
                                                    </div>
                                                </td>
                                                <!-- /.mail-box-messages -->
                                                <div class="modal fade" id="{{$location->location_id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title">Edit Location</h4>

                                                            </div>
                                                            <form class="" method="post" action="{{url('settings/locations/update')}}">
                                                                {{csrf_field()}}

                                                                <input type="hidden" name="location_id" value="{{$location->location_id}}">
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="exampleInputFolderName">Location</label>
                                                                                <input type="text"  name="location" value="{{$location->location}}"  required class="form-control" id="exampleInputFolderName" placeholder="E.g. Lekki">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6">
                                                                            <div class="text-box form-group">
                                                                                <label for="exampleInputFile">Select State</label>
                                                                                <select name="state_id" id="input" class="form-control" required="required">
                                                                                    @if(isset($states))
                                                                                        @foreach($states as $s)
                                                                                            <option
                                                                                                    @if($location->state_id == $s->id) {{'selected'}} @endif
                                                                                                    value="{{ $s->id }}">{{ $s->name }}</option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                                    <input type="submit" name="submit" value="Save Changes" class="btn btn-primary">
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
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
        </section>
    </div>
@stop