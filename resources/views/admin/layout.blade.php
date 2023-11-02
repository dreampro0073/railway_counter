<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>M/s New Nabaratna Hospitality Pvt. Ltd</title>

    
    <!-- <link href="{{url('assets/vendor1/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css"> -->
    <link href="{{url('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        

    <!-- Custom styles for this template-->
    <link href="{{url('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <!-- <link href="{{url('assets/css/jquery-ui.min.css')}}" rel="stylesheet"> -->


    <!-- <link rel="stylesheet" type="text/css" href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css"> -->

    <?php $version = "1.2.4"; ?>


    <link href="{{url('assets/css/custom.css?v='.$version)}}" rel="stylesheet">


    
    @yield('header_scripts')

</head>
<body id="page-top" ng-app="app">
	<div id="wrapper">
		<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('admin.page_header')

                <div class="container-fluid">
                	@yield('main')
                </div>
             
            </div>
            
        </div>
    </div>

    <script type="text/javascript">
        var base_url = "{{url('/')}}";
        var CSRF_TOKEN = "{{ csrf_token() }}";
    </script>
    <!-- Bootstrap core JavaScript-->
    <!-- <script src="{{url('assets/vendor1/jquery/jquery.min.js')}}"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    
    <!-- <script src="{{url('assets/js/jquery-ui.min.js')}}"></script> -->
    <script src="{{url('assets/vendor1/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <!-- <script src="{{url('assets/vendor1/jquery-easing/jquery.easing.min.js')}}"></script> -->

    <!-- Custom scripts for all pages-->
    <script src="{{url('assets/js/sb-admin-2.min.js')}}"></script>

    <!-- <script src="{{url('assets/vendor1/datatables/jquery.dataTables.min.js')}}"></script> -->
    <!-- <script src="{{url('assets/vendor1/datatables/dataTables.bootstrap4.min.js')}}"></script> -->
    <!-- <script src="{{url('assets/js/demo/datatables-demo.js')}}"></script> -->

    <!-- <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script> -->

    <script>
        // $('.datepicker').datepicker({
        //     uiLibrary: 'bootstrap4',
        // });
        // $('.datepicker1').datepicker({
        //     uiLibrary: 'bootstrap4',
        // });
    </script>    

    <!--Begin Angular scripts -->

    <script type="text/javascript" src="{{url('assets/scripts/angular.min.js')}}" ></script>

    <script type="text/javascript" src="{{url('assets/scripts/jcs-auto-validate.js')}}" ></script>
    
    <script type="text/javascript" src="{{url('assets/js/custom.js?v='.$version)}}"></script>
    <script type="text/javascript" src="{{url('assets/scripts/core/app.js?v='.$version)}}" ></script>
    @yield('footer_scripts')

    <script type="text/javascript" src="{{url('assets/scripts/core/services.js?v='.$version)}}" ></script>

    <script>
      angular.module("app").constant("CSRF_TOKEN", "{{ csrf_token() }}");
    </script>


</body>
</html>