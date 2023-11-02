@extends('admin.layout')


@section('header_scripts')
 
@endsection

@section('main')

<div class="main" ng-controller="dashboardCtrl" ng-init="init();">   
    <div class="card shadow mb-4"> 
       
    </div>
</div>
@endsection

@section('footer_scripts')
    <?php $version = "0.0.1"; ?>
    <script type="text/javascript" src="{{url('assets/scripts/core/dashboard.js?v='.$version)}}" ></script>
@endsection