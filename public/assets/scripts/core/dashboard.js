app.controller('dashboardCtrl', function($scope , $http, $timeout , DBService) {
    $scope.loading = false;
    $scope.formData = {
        
    };
    
    $scope.init = function () {
        DBService.postCall({}, '/api/dashboard/init').then((data) => {
            if (data.success) {
                console.log(data);
            }
        });
    }
});

