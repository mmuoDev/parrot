@extends('layouts.main-menu')
@section('contents')
    <!-- Main content -->
    <div class="content-wrapper">
        <section class="content">
            <hr/>
        <div class="row">

            <div class="col-md-12">
                <div class="box box-warning">

                    <div class="box-header with-border">
                        <h3 class="box-title">Users Management</h3>
                        <!-- /.box-tools -->
                    </div>
                    -
                    <!-- /.box-header -->
                    <div class="row">
                        <div class="col-md-6">
                            @include('partials.errors')
                        </div>
                    </div>


                    <div class="box-body ">
                        <div class="row"></div>
                        {{-- <div class="table-responsive mailbox-messages"> --}}
                        <div class="col-lg-12">
                            <table class="table table-responsive" id="">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Activate/Deactivate</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($users))
                                    <?php $i =0; ?>
                                    @foreach($users as $user)
                                        <?php $i++;
                                        $status = $user->enabled;
                                        //$photo = \App\Libraries\Utilities::getUserPhoto($user->id);
                                        ?>
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->role}}</td>
                                            <td>
                                                <form id="myForm" name="myForm" action="{{url('users/edit')}}" method="post">
                                                    <input type="checkbox" <?php if($status == 1){ echo "checked"; } ?> class="toggle2" name="toggle" id="toggle" value="{{$user->id}}" data-toggle="toggle" data-off="Disabled" data-on="Enabled">

                                                </form>
                                            </td>
                                            {{--
                                            <td> <button type="button" data-toggle="modal" data-target="#{{$member->tid}}" class="btn btn-default btn-sm"><i class="fa fa-plus"></i></button></td>
                                            --}}

                                        </tr>
                                        <!-- /.mail-box-messages -->


                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>


                        <form class="" method="post" action="{{url('users/add-user')}}" accept-charset="UTF-8" id="users-form" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">

                                <div class="col-lg-12">
                                    <h4>Add New Users</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-bordered" id="items">
                                        <thead>
                                        <tr style="background-color: #f9f9f9;">
                                            <th width="5%"  class="text-center">Actions</th>
                                            <th width="20%" class="text-left">Name</th>
                                            <th width="25%" class="text-left">Email</th>
                                            <th width="20%" class="text-left">Password</th>
                                            <th width="15" class="text-left">Category</th>
                                            {{--<th width="20%" class="text-left">Photo</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $item_row = 0; ?>
                                        <tr id="item-row-{{ $item_row }}">
                                            <td class="text-center" style="vertical-align: middle;">
                                                <button type="button"  onclick="$(this).tooltip('destroy'); $('#item-row-{{ $item_row }}').remove();" data-toggle="tooltip" title="" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                            </td>
                                            <td>
                                                <input class="form-control typeahead" required placeholder="Name" name="item[{{ $item_row }}][name]" type="text" id="item-name-{{ $item_row }}">
                                                <input  name="item[{{ $item_row }}][item_id]" type="hidden" id="item-id-{{ $item_row }}" >
                                            </td>
                                            <td>
                                                <input class="form-control typeahead" required placeholder="Email" name="item[{{ $item_row }}][email]" type="email" id="item-email-{{ $item_row }}">
                                            </td>
                                            <td>
                                                <input  class="form-control" required placeholder="Password" name="item[{{ $item_row }}][password]" onkeyup="" type="password" id="item-password-{{ $item_row }}">
                                            </td>
                                            <td>
                                                <select name="item[{{ $item_row }}][category_id]" class="form-control iop" id='item-category_id-'. {{$item_row}} required>
                                                    @if(isset($categories))
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->role }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
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







                            <div class="box-footer">
                                <center>
                                    <button type="submit" class="btn btn-success">Add Users</button>
                                </center>
                            </div>
                        </form>

                    </div>
                    <!-- /. box -->
                </div>

                <!-- /.col -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
@endsection
@section('scripts')
    <script>
        //$( function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });

        //$('.date-picker1').datepicker();
        $('.toggle2').change(function (event) {

            var mode = $(this).prop('checked');
            //alert(this.value);
            var member_id = this.value;
            //console.log(member_id);
            //console.log(mode);
            if (mode == true) {
                var value = confirm("Are you sure you want to activate this user");

            }
            if (mode == false) {
                var value = confirm("Are you sure you want to deactivate this user");
            }
            //alert(mode);
            if (value == true) {
                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: '{{url('/users/edit')}}',
                    //"_token": $('#token').val(),
                    data: 'mode=' + mode + '&member_id=' + member_id,
                    success: function (data) {
                        var data = eval(data);
                        message = data.message;
                        success = data.success;
                        //$("#heading").html(success);
                        //$("#body").html(message);
                        //console.log(message);
                        alert(message);
                    }
                });
            } else {
                //alert(mode);
                if(mode == true){
                    this.checked = false; // reset first
                    event.preventDefault();
                    return false;
                }else if(mode == false){
                    this.checked = true; // reset first
                    event.preventDefault();
                    return false;
                }
                //alert("cancel");

            }

        });

        $('#projects').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'csv'
            ]
        });
        //});
        var item_row = '{{ $item_row }}';

        //console.log(item_row);

        function addItem() {
            html = '<tr id="item-row-' + item_row + '">';
            html += '  <td class="text-center" style="vertical-align: middle;">';
            html += '      <button type="button" onclick=" $(\'#item-row-' + item_row + '\').remove(); totalItem();" data-toggle="tooltip" title="" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>';
            html += '  </td>';
            html += '  <td>';
            html += '      <input class="form-control typeahead" required="required" placeholder="Name" name="item[' + item_row + '][name]" type="text" id="item-name-' + item_row + '">';
            html += '      <input name="item[' + item_row + '][item_id]" type="hidden" id="item-id-' + item_row + '">';
            html += '  </td>';
            html += '  <td>';
            html += '      <input class="form-control typeahead" required="required" placeholder="Email" name="item[' + item_row + '][email]" type="email" id="item-email-' + item_row + '">';
            html += '  </td>';
            html += '  <td>';
            html += '      <input onkeyup="" class="form-control" onclick="" placeholder="Password" required="required" name="item[' + item_row + '][password]" type="password" id="item-password-' + item_row + '">';
            html += '  </td>';
            html += '  <td>';
            html += '      <select  class="form-control select2" name="item[' + item_row + '][category_id]" id="item-category_id-' + item_row + '">';
            // html += '         <option selected="selected" value="">--Please select--</option>';
            @if(isset($categories))
                    @foreach($categories as $category)
                html += '<option value="{{ $category->id }}">{{ $category->role }}</option>';
            @endforeach
                    @endif
                html += '</select>';
            html += '  </td>';

            $('#items tbody #addItem').before(html);
            //$('[rel=tooltip]').tooltip();

            $('[data-toggle="tooltip"]').tooltip('hide');

            $('#item-row-' + item_row + ' .select2').select2({
                placeholder: "{{-- trans('general.form.select.field', ['field' => trans_choice('general.taxes', 1)]) --}}"
            });

            item_row++;
        }

        function getDatePicker() {
            //$('.date-picker2').datepicker();
            $('.date-picker2').datepicker();
            $('.date-picker2').datepicker('show');
        }
        //});

    </script>
@endsection