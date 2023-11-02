app.controller('dashboardCtrl', function($scope , $http, $timeout , DBService) {
    $scope.loading = false;
    $scope.formData = {
        no_of_adults:0,
        no_of_baby_staff:0,
        no_of_children:0,
    };

    $scope.pay_types = [];
    $scope.hours = [];
    
    $scope.init = function () {

        var d = new Date(); // for now

        var h = d.getHours();
        h = (h < 10) ? ("0" + h) : h ;

        var m = d.getMinutes();
        m = (m < 10) ? ("0" + m) : m ;

        var s = d.getSeconds();
        s = (s < 10) ? ("0" + s) : s ;

        var datetext = h + ":" + m + ":" + s;


        $scope.formData.check_in = datetext;

        DBService.postCall({}, '/api/dashboard/init').then((data) => {
            if (data.success) {
                $scope.pay_types = data.pay_types;
                $scope.hours = data.hours;
            }
        });
    }
    $scope.onSubmit = function () {
        console.log($scope.formData);return;
        DBService.postCall({}, '/api/dashboard/init').then((data) => {
            if (data.success) {
                $scope.pay_types = data.pay_types;
                $scope.hours = data.hours;
            }
        });
    }
});

