<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>hashaj</title>
    <link rel="stylesheet" type="text/css" href="https://testadmin.bbfootballschools.com/portal/assets/global/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://testadmin.bbfootballschools.com/portal/assets/global/plugins/simple-line-icons/simple-line-icons.min.css">

    <link rel="stylesheet" type="text/css" href="https://testadmin.bbfootballschools.com/portal/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="https://testadmin.bbfootballschools.com/portal/assets/global/plugins/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/custom.css')}}">
</head>
<body  ng-app="app">
    <div class="main" ng-controller="dashboardCtrl" ng-init="init();"> 
        @include('admin.entries.add')
        <div class="card shadow mb-4 p-4">
            <div style="box-shadow: 0 0 5px rgba(0,0,0,0.5);">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6" style="padding-top: 18px;">
                            <span style="font-size: 18px;font-weight: bold;font-style: italic;">M/s New Nabaratna Hospitality Pvt. Ltd.</span> 
                        </div>
                        <div class="col-md-6" style="text-align: right;padding: 15px 0;">
                            <button type="button" ng-click="add()" class="btn btn-primary">Add New</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container">
                <div class="filters" style="margin:24px 0;">
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
                            <div class="col-md-4 text-right" style="margin-top: 25px;" class="mb-2">
                                <button type="button" ng-click="init()" class="btn btn-sm btn-primary">Search</button>
                                <button type="button" ng-click="filterClear()" class="btn btn-sm btn-warning">Clear</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div>
                    <table class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Name</th>
                                <th>Mobile No</th>

                                <th>PNR</th>
                                <th>Train</th>
                                <th>Pay Type</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody ng-if="entries.length > 0">
                            <tr ng-repeat="item in entries">
                                <td>@{{ $index+1 }}</td>
                                <td><a href="javascript:;" ng-click="edit(item.id)" style="font-style: italic;text-decoration: underline;font-weight: bold;">@{{ item.name }}</a></td>
                                <td>@{{ item.mobile_no }}</td>

                                <td>@{{ item.pnr_uid }}</td>
                                <td>@{{ item.train_no }}</td>
                                <td>@{{ item.pay_by }}</td>
                                <td>@{{ item.paid_amount }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div ng-if="entries.length == 0" class="alert alert-danger">Data Not Found!</div>
                </div>
            </div>
           
        </div>
    </div>
    
    <script type="text/javascript">
    var base_url = "{{url('/')}}";
    var CSRF_TOKEN = "{{ csrf_token() }}";
    </script>
    <script type="text/javascript" src="https://testadmin.bbfootballschools.com/portal/assets/global/plugins/jquery.min.js"></script>
    <script type="text/javascript" src="https://testadmin.bbfootballschools.com/portal/assets/global/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://testadmin.bbfootballschools.com/portal/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="https://testadmin.bbfootballschools.com/portal/assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript" src="{{url('assets/scripts/angular.min.js')}}" ></script>

    <script type="text/javascript" src="{{url('assets/scripts/jcs-auto-validate.js')}}" ></script>

    <script type="text/javascript" src="{{url('assets/js/custom.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/scripts/core/app.js')}}" ></script>
    @yield('footer_scripts')

    <script type="text/javascript" src="{{url('assets/scripts/core/services.js')}}" ></script>

    <script type="text/javascript" type="text/javascript" src="{{url('assets/scripts/core/dashboard.js')}}"></script>



<script>
  angular.module("app").constant("CSRF_TOKEN", "{{ csrf_token() }}");
</script>

</body>
</html>