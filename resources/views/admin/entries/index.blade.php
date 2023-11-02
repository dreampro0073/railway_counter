@extends('admin.layout')


@section('header_scripts')
 
@endsection

@section('main')

<div class="main" ng-controller="dashboardCtrl" ng-init="init();">   
    <div class="card shadow mb-4 p-4"> 
        <form name="plan" novalidate="novalidate" ng-submit="storePlan(plan.$valid)">
            <div class="row">
                <div class="col-md-3 form-group">
                    <label>Name</label>
                    <input type="text" ng-model="formData.name" class="form-control" required />
                </div>
                <div class="col-md-3 form-group">
                    <label>Mobile No.</label>
                    <input type="number" ng-model="formData.mobile_no" class="form-control" required />
                </div>
                <div class="col-md-3 form-group">
                    <label>PNR/UID</label>
                    <input type="number" ng-model="formData.pnr_uid" class="form-control" required />
                </div>
                
                <div class="col-md-3 form-group">
                    <label>Train No.</label>
                    <input type="number" ng-model="formData.train_no" class="form-control" required />
                </div>
                <div class="col-md-3 form-group">
                    <label>Pay Type</label>
                    <select ng-model="formData.pay_type" class="form-control" required >
                        <option value="">--select--</option>
                        <option ng-repeat="item in pay_types" value=@{{item.value}}>@{{ item.label}}</option>
                    </select>
                </div> 
                <div class="col-md-3 form-group">
                    <label>No of Adults</label>
                    <input type="number" ng-model="formData.no_of_adults" class="form-control" required />
                </div>
                <div class="col-md-3 form-group">
                    <label>No of children</label>
                    <input type="number" ng-model="formData.no_of_children" class="form-control" required />
                </div>
                <div class="col-md-3 form-group">
                    <label>Baby/Staff</label>
                    <input type="number" ng-model="formData.no_of_baby_staff" class="form-control" required />
                </div>
                <div class="col-md-3 form-group">
                    <label>Paid Amt.</label>
                    <input type="number" ng-model="formData.paid_amount" class="form-control" required />
                </div>
                <div class="col-md-3 form-group">
                    <label>Hour Occ</label>
                    <input type="number" ng-model="formData.hours_occ" class="form-control" required />
                </div>
                 
            </div>
            <div class="pt-4">
                <button type="submit" class="btn btn-primary" ng-disabled="loading">
                    <span ng-if="!loading">Submit</span>
                    <span ng-if="loading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                </button> 
            </div>  
            
       </form>
    </div>
</div>
@endsection

@section('footer_scripts')
    <?php $version = "0.0.1"; ?>
    <script type="text/javascript" src="{{url('assets/scripts/core/dashboard.js?v='.$version)}}" ></script>
@endsection