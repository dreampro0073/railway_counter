@extends('admin.layout')


@section('header_scripts')
 
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
    <script type="text/javascript" src="{{url('assets/scripts/core/dashboard.js?v='.$version)}}" ></script>
@endsection