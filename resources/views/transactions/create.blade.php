@extends('layouts.main-menu')
@section('styles')
    <style>
        #map2 {
            height: 100%;
        }
        .new_location{
            display: none;
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
                            <div class="box-body">
                                @if($count > 0)
                                    <!--User Profile -->
                                    <?php
                                        //customer details
                                        $customer = \Illuminate\Support\Facades\DB::select("
                                        select c.id as customer_id, c.customer_name, c.location_id, l.location, s.name as state, c.last_purchase from customers as c, locations as l, states as s WHERE
                                        c.location_id = l.id and l.state_id = s.id and c.phone_number = '$phone'
                                        ");
                                        //get purchases for this customer
                                        $purchases = \Illuminate\Support\Facades\DB::select("
                                        select p.product, p.price, p.quantity, p.total, p.created_at as created from purchases as p, customers as c where p.customer_id = c.id and
                                        c.phone_number = '$phone' order by p.created_at DESC
                                        ");
                                    ?>
                                    <div class="row clearfix">
                                        <div class="col-md-6 pull-right">
                                            <div class="span2">
                                                <img src="{{asset('/images/user.png')}}"  alt="" class="img-rounded">
                                            </div>
                                            <div class="span4">
                                                <blockquote>
                                                    <p>
                                                <span><a>
                                                        {{ucwords($customer[0]->customer_name)}}</a></span>
                                                    </p>
                                                    <!-- Default Size -->
                                                    <small><cite title="Source Title">{{ucfirst($customer[0]->location)}}, {{ucfirst($customer[0]->state)}} <i class="icon-map-marker"></i></cite></small>
                                                </blockquote>
                                                <p>
                                                    <i class="icon-globe"></i> Last Purchase: {{date('l jS \of F, Y', strtotime($customer[0]->last_purchase))}} <br>
                                                </p>
                                                <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#{{$customer[0]->customer_id}}">Edit</button>
                                                <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#{{$customer[0]->customer_id}}_">Purchase History</button>
                                                <div class="modal fade" id="{{$customer[0]->customer_id}}_">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <!-- <span aria-hidden="true">&times;</span> -->
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    Close</button>
                                                                <h4 class="modal-title">Purchase History</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table id="tables2" class="table table-bordered table-striped">
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
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Edit customer details -->
                                                <div class="modal fade" id="{{$customer[0]->customer_id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title">Edit Customer Details</h4>
                                                            </div>
                                                            <form class="" method="post" action="{{url('/customers/update/'.$phone)}}">
                                                                {{csrf_field()}}
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-4">
                                                                            <div class="form-group">
                                                                                <label for="exampleInputN">Customer Name</label>
                                                                                <input type="text" class="form-control" id="exampleInputN"
                                                                                       placeholder="Enter Customer Name" name="customer_name" required value="{{$customer[0]->customer_name}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="form-group">
                                                                                <label for="exampleInputN">Customer Phone Number</label>
                                                                                <input type="number" class="form-control" id="exampleInputN"
                                                                                       placeholder="Enter Customer Phone Number" name="customer_phone_number" required value="{{$phone}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="text-box form-group">
                                                                                <label for="exampleInputFile">Select Location</label>
                                                                                <select name="location_id" id="input" class="form-control" required="required">
                                                                                    @if(isset($locations))
                                                                                        @foreach($locations as $location)
                                                                                            <option
                                                                                                    @if($customer[0]->location_id == $location->id) {{'selected'}} @endif
                                                                                                    value="{{ $location->id }}">{{ $location->location }}</option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--Add new location button -->
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <button class="btn btn-sm btn-danger" type="button" id="add">New Location</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row new_location">
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="exampleInputFolderName">New Location</label>
                                                                                <input type="text" class="form-control" placeholder="Enter New Location"
                                                                                       name="location" value="{{old('location')}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="text-box form-group">
                                                                                <label for="exampleInputFile">Select State</label>
                                                                                <select name="state_id" id="input" class="form-control">
                                                                                    <option value="">--Please select --</option>
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
                                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->
                                            </div>
                                        </div>
                                    </div>

                                @else
                                            <!-- Only show if user exists -->
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h4>Add Customer Details</h4>
                                                </div>
                                            </div>
                                            @if($count == 0)
                                                    <form action="" method="post">
                                                        {{csrf_field()}}
                                            @endif
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputN">Customer Name</label>
                                                        <input type="text" class="form-control" id="exampleInputN"
                                                               placeholder="Enter Customer Name" name="customer_name" required value="{{old('customer_name')}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputN">Customer Phone Number</label>
                                                        <input type="number" class="form-control" id="exampleInputN"
                                                               placeholder="Enter Customer Phone Number" name="phone_number" required value="{{$phone}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="text-box form-group">
                                                        <label for="exampleInputFile">Select Location</label>
                                                        <select name="location_id" id="input" class="form-control" required="required">
                                                            @if(isset($locations))
                                                                <option value="">--Please select --</option>
                                                                @foreach($locations as $location)
                                                                    <option
                                                                            @if(old('location_id') == $location->id) {{'selected'}} @endif
                                                                            value="{{ $location->id }}">{{ $location->location }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Add new location button -->
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <button class="btn btn-sm btn-danger" type="button" id="add">New Location</button>
                                                    </div>
                                                </div>
                                            <div class="row new_location">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputFolderName">New Location</label>
                                                        <input type="text" class="form-control" placeholder="Enter New Location"
                                                               name="location" value="{{old('location')}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="text-box form-group">
                                                        <label for="exampleInputFile">Select State</label>
                                                        <select name="state_id" id="input" class="form-control">
                                                            <option value="">--Please select --</option>
                                                            @if(isset($states))
                                                                @foreach($states as $s)
                                                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if($count != 0 )
                                        <form action="" method="post">
                                        {{csrf_field()}}
                                        @endif
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h4>Purchases</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table table-bordered" id="items">
                                                    <thead>
                                                    <tr style="background-color: #f9f9f9;">
                                                        <th width="5%"  class="text-center">Actions</th>
                                                        <th width="20%" class="text-left">Select Product</th>
                                                        <th width="10%" class="text-left">Quantity</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $item_row = 0; ?>
                                                    <tr id="item-row-{{ $item_row }}">
                                                        <td class="text-center" style="vertical-align: middle;">
                                                            <button type="button"  onclick="$(this).tooltip('destroy'); $('#item-row-{{ $item_row }}').remove();" data-toggle="tooltip" title="" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                                        </td>
                                                        <td>
                                                            <select name="item[{{ $item_row }}][item_id]" required class="form-control iop" id='item-item_id-'. {{$item_row}}>
                                                                <option value="">--Please select --</option>
                                                                @if(isset($products))
                                                                    @foreach($products as $product)
                                                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input class="form-control typeahead" required placeholder="Quantity" name="item[{{ $item_row }}][quantity]" type="number" id="item-quantity-{{ $item_row }}">
                                                        </td>
                                                    </tr>
                                                    <?php $item_row++; ?>
                                                    <tr id="addItem">
                                                        <td class="text-center"><button type="button" onclick="addItem();" data-toggle="tooltip" title="" class="btn btn-xs btn-primary" data-original-title=""><i class="fa fa-plus"></i></button></td>
                                                        {{--
                                                        <td class="text-right" colspan="5"></td> --}}
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                            <div class="row">
                                                <center>
                                                    <button type="submit" class="btn  btn-success">Submit</button>
                                                </center>
                                            </div>
                                    </form>
                            </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
@section('scripts')
    <script type="text/javascript">
        $('#add').click(function () {
            //$('.new_location').style.display = "block";
            document.querySelector(".new_location").style.display = "block";
            //alert("hello");
        })
        // document.querySelector("#add").addEventListener("click", function(){
        //     document.querySelector("div").style.display = "block";
        // });
        var item_row = '{{ $item_row }}';
        function addItem() {
            html  = '<tr id="item-row-' + item_row + '">';
            html += '  <td class="text-center" style="vertical-align: middle;">';
            html += '      <button type="button" onclick=" $(\'#item-row-' + item_row + '\').remove();" data-toggle="tooltip" title="" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>';
            html += '  </td>';
            html += '  <td>';
            html += '      <select  class="form-control select2" required name="item[' + item_row + '][item_id]" id="item-item_id-' + item_row + '">';
            // html += '         <option selected="selected" value="">--Please select--</option>';
            @if(isset($products))
                    @foreach($products as $product)
                html += '<option value="{{$product->id}}">{{$product->name}}</option>';
            @endforeach
                    @endif
                html += '</select>';
            html += '  </td>';
            html += '  <td>';
            html += '      <input class="form-control" placeholder="Quantity" required name="item[' + item_row + '][quantity]" type="number" id="item-quantity-' + item_row + '">';
            html += '  </td>';
            $('#items tbody #addItem').before(html);
            //$('[rel=tooltip]').tooltip();

            $('[data-toggle="tooltip"]').tooltip('hide');

            $('#item-row-' + item_row + ' .select2').select2({
                placeholder: "{{ trans('general.form.select.field', ['field' => trans_choice('general.taxes', 1)]) }}"
            });
            item_row++;
        }
    </script>
@stop