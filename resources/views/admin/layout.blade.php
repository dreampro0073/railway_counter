<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>M/s New Nabaratna Hospitality Pvt. Ltd</title>

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        
    <link href="{{url('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <!-- <link href="{{url('assets/css/jquery-ui.min.css')}}" rel="stylesheet"> -->

    <?php $version = "1.2.4"; ?>

    <link href="{{url('assets/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">

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
    <script src="{{url('assets/scripts/jquery.min.js')}}"></script>
    
    <script src="{{url('assets/vendor1/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('assets/js/sb-admin-2.min.js')}}"></script>

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