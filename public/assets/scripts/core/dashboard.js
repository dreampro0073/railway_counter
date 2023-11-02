app.controller('dashboardCtrl', function($scope , $http, $timeout , DBService) {
    $scope.loading = false;
    $scope.formData = {
        
    };

    $scope.pay_types = [];
    
    $scope.init = function () {
        DBService.postCall({}, '/api/dashboard/init').then((data) => {
            if (data.success) {
                $scope.pay_types = data.pay_types;
            }
        });
    }
});

