@extends('admin.layout')


@section('header_scripts')
 
@endsection

@section('main')


<div class="main" ng-controller="dashboardCtrl" ng-init="init();"> 
    @include('admin.entries.add')

    <div class="card shadow mb-4 p-4">
        <div>
            <button ng-click="addInit()" class="btn btn-primary">Add New</button>
        </div>

        <div class="filters">
            <form name="filterForm"  novalidate>
                <div class="row" style="font-size: 14px">

                    <div class="col-md-2 form-group">
                        <label class="label-control">Name</label>
                        <input type="text" class="form-control" ng-model="filter.name" />
                    </div>                    
                    <div class="col-md-2 form-group">
                        <label class="label-control">Mobile</label>
                        <input type="text" class="form-control" ng-model="filter.mobile_no" />
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="label-control">PNR</label>
                        <input type="text" class="form-control" ng-model="filter.pnr_uid" />
                    </div>
                    <div class="col-md-2 form-group">
                        <label class="label-control">Train</label>
                        <input type="text" class="form-control" ng-model="filter.train_no" />
                    </div>
                    <div class="col-md-2 text-right" style="margin-top: 13px;" class="mb-2">
                        <button type="button" ng-click="init()" class="btn btn-sm btn-primary">Search</button>
                        <button type="button" ng-click="filterClear()" class="btn btn-sm btn-warning">Clear</button>
                    </div>
                </div>
            </form>
        </div>

        <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Name</th>
                        <th>PNR</th>
                        <th>Train</th>
                        <th>Mobile No</th>
                        <th>Pay Type</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in dataset">
                        <td>@{{ $index+1 }}</td>
                        <td><span ng-click="addInit(item.id)">@{{ item.name }}</span></td>
                        <td>@{{ item.pnr_uid }}</td>
                        <td>@{{ item.train_no }}</td>
                        <td>@{{ item.mobile_no }}</td>
                        <td>@{{ item.pay_by }}</td>
                        <td>@{{ item.paid_amount }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
    <?php $version = "0.0.1"; ?>
    <script type="text/javascript" src="{{url('assets/scripts/core/dashboard.js?v='.$version)}}" ></script>
@endsection