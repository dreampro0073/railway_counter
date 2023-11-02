@extends('admin.layout')


@section('header_scripts')
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('main')


<div class="main" ng-controller="dashboardCtrl" ng-init="init();"> 
    @include('admin.entries.add')

    
</div>
@endsection

@section('footer_scripts')
    <?php $version = "0.0.1"; ?>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="{{url('assets/scripts/core/dashboard.js?v='.$version)}}" ></script>

@endsection