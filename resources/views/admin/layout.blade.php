<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Title</title>
   <!--  <link rel="stylesheet" type="text/css" href="{{url('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/bootstrap-datetimepicker.min.css')}}"> -->

    <link rel="stylesheet" type="text/css" href="{{url('bootstrap3/css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{url('date/bootstrap-time.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/custom.css')}}">
</head>
<body  ng-app="app">
	<div id="wrapper">
		<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <div class="">
                	@yield('main')
                </div>
             
            </div>
            
        </div>
    </div>
    <script type="text/javascript">
        var base_url = "{{url('/')}}";
        var CSRF_TOKEN = "{{ csrf_token() }}";
    </script>
    <!-- <script type="text/javascript" src="{{url('assets/scripts/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/scripts/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/scripts/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/scripts/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/scripts/bootstrap-datetimepicker.min.js')}}"></script> -->
    <script type="text/javascript" src="{{url('assets/scripts/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{url('bootstrap3/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{url('date/bootstrapp-time.min.js')}}"></script>

    <script type="text/javascript" src="{{url('assets/scripts/angular.min.js')}}" ></script>

    <script type="text/javascript" src="{{url('assets/scripts/jcs-auto-validate.js')}}" ></script>

    <script type="text/javascript" src="{{url('assets/js/custom.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/scripts/core/app.js')}}" ></script>

    <script type="text/javascript" src="{{url('assets/scripts/core/services.js')}}" ></script>

    <script type="text/javascript" type="text/javascript" src="{{url('assets/scripts/core/dashboard.js')}}"></script>
    <script>
      angular.module("app").constant("CSRF_TOKEN", "{{ csrf_token() }}");
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#timePicker').timepicker({
                minuteStep: 1,
            });
            $('#timePicker2').timepicker({
                minuteStep:1,
            });
        });
    </script>

</body>
</html>