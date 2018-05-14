<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Happy Parrot</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('/dist/css/skins/_all-skins.min.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('/bower_components/morris.js/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('/bower_components/jvectormap/jquery-jvectormap.css')}}">
    <!-- Date Picker -->
    {{--<link rel="stylesheet" href="{{asset('/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">--}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!--Datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" type="text/css"/>

    <!--Toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css">
    <style>
        .styleButton{
            color: red;
        }
    </style>
    @yield('styles')


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
        @include('layouts.top-menu')
        @include('layouts.side-menu')
        @yield('contents')

        <!--Footer -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2018 <a href="https://www.gpayafrica.com">Techie Solutions</a>.</strong> All rights
            reserved.
        </footer>
        <div class="control-sidebar-bg"></div>
</div>
<!-- jQuery 3 -->
<script src="{{asset('/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<!-- Morris.js charts -->
<script src="{{asset('/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
{{--<script src="{{asset('/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>--}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('/dist/js/demo.js')}}"></script>
<!--Datatable JS-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<!--Highcharts-->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<!--Google Maps -->
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-6H7c_nIa-X3lbUvrJYdigU5dS5cfKTQ&callback=initMap">
</script>
<!-- Toastr-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<!-- Toastr notification -->
<script>
    toastr.options.preventDuplicates = true;
    // toastr.success("ola");
    @if (session('middleware'))
    toastr.error("{{session('middleware')}}");
    @endif

    @if (session('welcome_back'))
    toastr.success("{{session('welcome_back')}}");
    @endif

    @if (session('welcome'))
    toastr.success("{{session('welcome')}}");
    @endif

    @if (session('delete_message'))
    toastr.error("{{session('delete_message')}}");
    @endif

    @if (session('success'))
    toastr.success("{{session('success')}}");
    @endif

    @if (session('notify'))
    toastr.success("{{session('notify')}}");
    @endif

    @if (session('success_image'))
    toastr.success("{{session('success_image')}}");
    @endif

    @if (session('error'))
    toastr.error("{{session('error')}}");
    @endif

    @if (session('info'))
    toastr.info("{{session('info')}}");
    @endif

    @if ($errors->has('image_reference'))
    toastr.error("{{$errors->first('image_reference')}}");
    @endif
    //Mark as read
    function markAsReadFxn(notify_id){
        $.get('notifications/markAsRead/'+notify_id);
        //alert(notify_id);
    }
    // $('.dropdown-menu li').click(function (event) {
    //     var children=$(this).children("input[type=text]");
    //     if(children.length!=0)
    //     {
    //         event.stopPropagation();
    //     }
    // });
</script>
<script>
    //Server-side processing of customers
    $('.server_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'print', 'excel', 'pdf'
        ],
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('customers') }}",
        "columns":[
            { "data": "s_n" },
            { "data": "name" },
            { "data": "phone_number" },
            { "data": "total_purchase"},
            {"data": "date_joined"},
            {"data": "last_purchase"},
            {"data": "action"}
        ]
    });
    //$( function() {
    $('#tables').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'print', 'excel', 'pdf'
        ]
    });
    $('#tables2').DataTable({
        dom: 'Bfrtip',
        buttons : []
    });
    $('.fromDate').datepicker(
        { dateFormat: 'dd/mm/yy' }
    );
    $('.toDate').datepicker(
        { dateFormat: 'dd/mm/yy' }
    );
    //});
</script>
@yield('scripts')
</body>
</html>
