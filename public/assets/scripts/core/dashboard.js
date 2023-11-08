app.controller('dashboardCtrl', function($scope , $http, $timeout , DBService) {
    $scope.loading = false;
    $scope.formData = {
        no_of_adults:0,
        no_of_baby_staff:0,
        no_of_children:0,
        name:'',
        mobile:"",
        paid_amount:0,
        hours_occ:'',
    };

    $scope.filter = {};

    $scope.entry_id = 0;
    $scope.total_upi_collection = 0;
    $scope.total_cash_collection = 0;
    $scope.total_collection = 0;

    $scope.last_hour_upi_total = 0;
    $scope.last_hour_cash_total = 0;
    $scope.last_hour_total = 0;

    $scope.check_shift = "";
    $scope.pay_types = [];
    $scope.hours = [];
    
    $scope.init = function () {

        // var d = new Date(); // for now

        // var h = d.getHours();
        // h = (h < 10) ? ("0" + h) : h ;

        // var m = d.getMinutes();
        // m = (m < 10) ? ("0" + m) : m ;

        // var s = d.getSeconds();
        // s = (s < 10) ? ("0" + s) : s ;
        // var ampm = h >= 12 ? 'PM' : 'AM';


        // // var datetext = h + ":" + m + ":" + s + ' ' + ampm;
        // var datetext = h + ":" + m + ":" + s;

        // $scope.formData.check_in = datetext;

        
        DBService.postCall($scope.filter, '/api/dashboard/init').then((data) => {

            if (data.success) {
                $scope.pay_types = data.pay_types;
                $scope.hours = data.hours;
                $scope.entries = data.entries;

                $scope.total_upi_collection = data.total_shift_upi;
                $scope.total_cash_collection = data.total_shift_cash;
                $scope.total_collection = data.total_collection;

                $scope.last_hour_upi_total = data.last_hour_upi_total;
                $scope.last_hour_cash_total = data.last_hour_cash_total;
                $scope.last_hour_total = data.last_hour_total;
                
                $scope.check_shift = data.check_shift;
            }
        });
    }
    $scope.filterClear = function(){
        $scope.filter = {};
        $scope.init();
    }

    $scope.edit = function(entry_id){
        $("#exampleModalCenter").modal("show");
        $scope.entry_id = entry_id;
        DBService.postCall({entry_id : $scope.entry_id}, '/api/dashboard/edit-init').then((data) => {
            if (data.success) {
                $scope.formData = data.sitting_entry;
            }
            
        });
    }
    $scope.add = function(){
        $("#exampleModalCenter").modal("show");
        
    }

    $scope.hideModal = () => {
        $("#exampleModalCenter").modal("hide");
        $scope.entry_id = 0;
        $scope.formData = {
            no_of_adults:0,
            no_of_baby_staff:0,
            no_of_children:0,
            name:'',
            mobile:"",
            total_amount:0,
            paid_amount:0,
            balance_amount:0,
            hours_occ:0,
        };
    }

    $scope.onSubmit = function () {
        $scope.loading = true;
        // console.log($scope.formData);return;
        DBService.postCall($scope.formData, '/api/dashboard/store').then((data) => {
            if (data.success) {
                $("#exampleModalCenter").modal("hide");
                $scope.entry_id = 0;
                $scope.formData = {
                    no_of_adults:0,
                    no_of_baby_staff:0,
                    no_of_children:0,
                    name:'',
                    mobile:"",
                    total_amount:0,
                    paid_amount:0,
                    balance_amount:0,
                    hours_occ:0,
                    check_in:'',
                    check_out:'',
                };
                $scope.init();
                window.open(base_url+'/admin/print/'+data.id, '_blank');

            }
            $scope.loading = false;
        });
    }
    // $scope.calCheck = () => {
    //     DBService.postCall({check_in:$scope.formData.check_in,hours_occ:$scope.formData.hours_occ}, '/api/dashboard/cal-check').then((data) => {
    //         if (data.success) {
    //            console.log(data);
    //            $scope.formData.check_out = data.check_out;
    //            $scope.changeAmount();
    //         }
    //     });
    // }

    $scope.calCheck = () => {
        DBService.postCall({check_in:$scope.formData.check_in,hours_occ:$scope.formData.hours_occ}, '/api/dashboard/cal-check').then((data) => {
            if (data.success) {
               // console.log(data);
               $scope.formData.check_out = data.check_out;
               $scope.changeAmount();
            }
        });
    }
    $scope.changeAmount = function () {


        $scope.formData.total_amount = 0;

        if($scope.formData.hours_occ > 0){
            
            var hours = $scope.formData.hours_occ - 1; 

            if($scope.formData.no_of_adults > 0){
                $scope.formData.total_amount += 30 * $scope.formData.no_of_adults;
                $scope.formData.total_amount += hours * 20 * $scope.formData.no_of_adults;
            }

            if($scope.formData.no_of_children > 0){
                $scope.formData.total_amount += 20 * $scope.formData.no_of_children;
                $scope.formData.total_amount +=  hours * 10 * $scope.formData.no_of_children;
            }

        }
        $scope.formData.balance_amount = $scope.formData.total_amount - $scope.formData.paid_amount;

    }
});