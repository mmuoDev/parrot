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
                            <h3 class="box-title">Products</h3>
                            <button class="btn btn-sm btn-success pull-right" TYPE="button" data-toggle="modal" title="Project Files" data-target="#location_">Add Product</button>
                        </div>
                        @include('partials.errors')
                        <div class="modal fade" id="location_">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">New Product</h4>
                                    </div>
                                    <form class="" method="post" action="">
                                        {{csrf_field()}}
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputFolderName">Name of Product</label>
                                                        <input type="text"  name="name"  required class="form-control" id="exampleInputFolderName" placeholder="E.g. Semovita">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputFolderName">Price of Product (₦)</label>
                                                        <input type="number"  name="price"  required class="form-control" id="exampleInputFolderName">
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
                                            <th>Product Name [Price]</th>
                                            <th>Status</th>
                                            <th>Edit Product</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($products))
                                            <?php $i = 0; ?>
                                            @foreach($products as $product)
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{ucwords($product->name)}} [₦{{number_format($product->price, 2)}}]</td>
                                                    <td>
                                                        @if($product->status_id == 1)
                                                            Added to Stock
                                                        @else
                                                            Removed from Stock
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" data-toggle="modal" data-target="#{{$product->id}}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if($product->status_id == 1)
                                                            <button type="button" data-toggle="modal" data-target="#{{$product->id}}_" class="btn btn-danger btn-sm">Remove from Stock</button>
                                                        @else
                                                            <button type="button" data-toggle="modal" data-target="#{{$product->id}}__" class="btn btn-success btn-sm">Add to Stock</button>
                                                        @endif
                                                    </td>
                                                    <!-- /.mail-box-messages -->
                                                    <div class="modal fade" id="{{$product->id}}_">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title"></h4>

                                                                </div>
                                                                <form class="" method="post" action="{{url('settings/products/update-status')}}">
                                                                    {{csrf_field()}}
                                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                                    <div class="modal-body">
                                                                        <p>
                                                                            Are you sure you want to remove <strong>{{ucwords($product->name)}}</strong> from stock?
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">No</button>
                                                                        <input type="submit" name="remove_stock" value="Yes" class="btn btn-primary">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.mail-box-messages -->
                                                    <div class="modal fade" id="{{$product->id}}__">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title"></h4>

                                                                </div>
                                                                <form class="" method="post" action="{{url('settings/products/update-status')}}">
                                                                    {{csrf_field()}}
                                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                                    <div class="modal-body">
                                                                        <p>
                                                                            Are you sure you want to add <strong>{{ucwords($product->name)}}</strong> back to stock?
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">No</button>
                                                                        <input type="submit" name="add_stock" value="Yes" class="btn btn-primary">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.mail-box-messages -->
                                                    <div class="modal fade" id="{{$product->id}}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title">Edit Product</h4>

                                                                </div>
                                                                <form class="" method="post" action="{{url('settings/products/update')}}">
                                                                    {{csrf_field()}}

                                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputFolderName">Name of Product</label>
                                                                                    <input type="text"  name="name" value="{{$product->name}}"  required class="form-control" id="exampleInputFolderName">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-lg-6">
                                                                                <div class="text-box form-group">
                                                                                    <label for="exampleInputFile">Price of Product (₦)</label>
                                                                                    <input type="numeric"  name="price" value="{{$product->price}}"  required class="form-control" id="exampleInputFolderName">
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