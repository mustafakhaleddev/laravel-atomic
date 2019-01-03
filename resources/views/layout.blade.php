<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/vendor/atomic/plugins/images/favicon.png')}}">
    <!-- Bootstrap Core CSS -->
    @if(\MustafaKhaled\AtomicPanel\AtomicPanel::$rtl)
        <link href="{{asset('/vendor/atomic/bootstrap/dist/css/bootstrap-rtl.min.css')}}" rel="stylesheet">
    @else
        <link href="{{asset('/vendor/atomic/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    @endif
<!-- Menu CSS -->
    <link href="{{asset('/vendor/atomic/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css')}}"
          rel="stylesheet">
    <!-- toast CSS -->
    <link href="{{asset('/vendor/atomic/plugins/bower_components/toast-master/css/jquery.toast.css')}}"
          rel="stylesheet">
    <!-- morris CSS -->
    <link href="{{asset('/vendor/atomic/plugins/bower_components/morrisjs/morris.css')}}" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="{{asset('/vendor/atomic/plugins/bower_components/chartist-js/dist/chartist.min.css')}}"
          rel="stylesheet">
    <link href="{{asset('/vendor/atomic/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css')}}"
          rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{asset('/vendor/atomic/css/animate.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">

    @if(\MustafaKhaled\AtomicPanel\AtomicPanel::$rtl)
        <link href="{{asset('/vendor/atomic/css/style-rtl.css')}}" rel="stylesheet">
    @else
        <link href="{{asset('/vendor/atomic/css/style.css')}}" rel="stylesheet">
    @endif
<!-- color CSS -->
    <link href="{{asset('/vendor/atomic/css/colors/default.css')}}" id="theme" rel="stylesheet">
    <link href="{{asset('/vendor/atomic/css/trix.css')}}" id="theme" rel="stylesheet">
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css" rel="stylesheet">--}}
    {{--<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">--}}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css"/>
    @yield('header')
    <title>{{\MustafaKhaled\AtomicPanel\AtomicPanel::name() }}</title>
@foreach(\MustafaKhaled\AtomicPanel\AtomicPanel::$atomicStyles as $style)
    {!! $style !!}
@endforeach
<!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('/vendor/atomic/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('/vendor/atomic/plugins/bower_components/toast-master/js/jquery.toast.js')}}"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
</head>

<body class="fix-header" {{\MustafaKhaled\AtomicPanel\AtomicPanel::$rtl?'dir=rtl':''}}>
<!-- ============================================================== -->
<!-- Preloader -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>
<!-- ============================================================== -->
<!-- Wrapper -->
<!-- ============================================================== -->
<div id="wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <div class="top-left-part">
                <!-- Logo -->
                @include('atomic::partials.logo')

            </div>
            <!-- /Logo -->
            <ul class="nav navbar-top-links navbar-right pull-right">
                {{--<li>--}}
                {{--<form role="search" class="app-search hidden-sm hidden-xs m-r-10">--}}
                {{--<input type="text" placeholder="Search..." class="form-control"> <a href=""><i--}}
                {{--class="fa fa-search"></i></a></form>--}}
                {{--</li>--}}
                <li>
                    @include('atomic::partials.user')
                </li>
            </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- End Top Navigation -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <div class="navbar-default sidebar" role="navigation">
        @include('atomic::navigation')
    </div>
    <!-- ============================================================== -->
    <!-- End Left Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
    <div id="page-wrapper">
    @include('flash::message')

    @yield('content')
    <!-- /.container-fluid -->
        <footer class="footer text-center"> 2019 &copy; Atomic Panel made with ♥ to you by <a
                    href="http://mustafakhaled.com">mustafakhaled.com</a></footer>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('/vendor/atomic/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{asset('/vendor/atomic/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>
<!--slimscroll JavaScript -->
<script src="{{asset('/vendor/atomic/js/jquery.slimscroll.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('/vendor/atomic/js/waves.js')}}"></script>
<!--Counter js -->
<script src="{{asset('/vendor/atomic/plugins/bower_components/waypoints/lib/jquery.waypoints.js')}}"></script>
<script src="{{asset('/vendor/atomic/plugins/bower_components/counterup/jquery.counterup.min.js')}}"></script>
<!-- chartist chart -->
<script src="{{asset('/vendor/atomic/plugins/bower_components/chartist-js/dist/chartist.min.js')}}"></script>
<script src="{{asset('/vendor/atomic/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js')}}"></script>
<!-- Sparkline chart JavaScript -->
<script src="{{asset('/vendor/atomic/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{asset('/vendor/atomic/js/custom.min.js')}}"></script>
<script src="{{asset('/vendor/atomic/js/trix.js')}}"></script>
{{--<script src="{{asset('/vendor/atomic/js/dashboard1.js')}}"></script>--}}

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
@foreach(\MustafaKhaled\AtomicPanel\AtomicPanel::$atomicScripts as $script)
    {!! $script !!}
@endforeach
@yield('footer')
<script>
    $('#flash-overlay-modal').modal();
    $('body').on('click', '.atomic-show-more', function () {
        var value = $(this).data('atomic-value');
        var name = $(this).data('atomic-name');
        swal(name, value);

    });
    $('body').on('click', '.atomic-delete-row', function () {
        var deleteUrl = $(this).data('atomic-delete-url');
        swal({
            title: "{{__('Are you sure?')}}",
            text: "{{__('Once deleted, you will not be able to recover this imaginary value!')}}",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    swal("{{__('Poof! Your imaginary value has been deleted!')}}", {
                        icon: "success",
                    });
                    window.location = deleteUrl;
                } else {
                    swal("{{__('Your imaginary value is safe!')}}");
                }
            });
    })

    $(function () {
        $('.atomic-timepicker').datepicker({
            format: 'yyyy-m-d',
        });
    });
</script>
</body>

</html>
