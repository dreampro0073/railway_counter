@extends('admin.layout')


@section('header_scripts')
    <link href=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
        rel="stylesheet">
         <link
        href=
"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet">
    
@endsection

@section('main')


<div class="main" ng-controller="dashboardCtrl" ng-init="init();"> 
    @include('admin.entries.add')

  <div class="card shadow mb-4 p-4"> 
        <button ng-click="">Add New</button>
    </div>
</div>
@endsection

@section('footer_scripts')
    <?php $version = "0.0.1"; ?>
    <script type="text/javascript" src=
        "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js">
    </script>
 
    <script src=
        "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
    </script>

    <script type="text/javascript" src="{{url('assets/scripts/core/dashboard.js')}}"></script>

    <script type="text/javascript">
        $('.datetime').datetimepicker({
            format: 'hh:mm:ss'
        });
    </script>

@endsection