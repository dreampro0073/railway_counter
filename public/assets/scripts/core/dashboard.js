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

