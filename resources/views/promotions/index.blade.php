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
                            <h3 class="box-title">Promotions</h3>

                        </div>
                        @include('partials.errors')
                        <div class="box-body">
                            <!-- /.box-header -->
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="" method="post"  onsubmit="return confirm('Are you sure you want to send this message?');">
                                    {{csrf_field()}}
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="text-box form-group">
                                                    <label for="exampleInputFile">Select Category</label>
                                                    <select name="category_id" id="input" class="form-control" required="required">
                                                        <option value="">--Please select--</option>
                                                        @if(isset($categories))
                                                            @foreach($categories as $category)
                                                                <option
                                                                        @if($category->id == old('category_id')) {{'selected'}} @endif
                                                                        value="{{$category->id}}">{{$category->category}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h4>Specify Date Range <small>[Not compulsory]</small></h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">From</label>
                                                    <input type="text"  name="start_date"  class="form-control fromDate" value="{{old('start_date')}}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">To</label>
                                                    <input type="text" name="end_date" class="form-control toDate" value="{{old('end_date')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Message</label>
                                                    <textarea name="message" id="message" class="form-control" maxlength="459" required>{{old('message')}}</textarea>
                                                    <p class="help-block"></p>
                                                    <span id="characters"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <button type="submit" class="btn btn-success">Send</button>
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
@section('scripts')
    <script>
        //This block of code does what it is supposed to do.
        $('#message').keyup(updateCount);
        $('#message').keydown(updateCount);
        //function to determine SMS count
        function checkCount(count) {
            var status;
            if(count == 0){
                status = 0;
            }
            else if(count <= 160){
                status = 1;
            }else if(count > 160 && count < 306){
                status = 2;
            }else{
                status = 3;
            }
            return status;
        }
        function updateCount() {
            var cs = $(this).val().length;
            $('#characters').text('Message Length: '+ cs + ' characters. . .'+ 'Cost: ' + checkCount(cs) + ' SMS');
        }
    </script>
@stop