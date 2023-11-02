app.controller('dashboardCtrl', function($scope , $http, $timeout , DBService) {
    $scope.loading = false;
    $scope.formData = {
        no_of_adults:0,
        no_of_baby_staff:0,
        no_of_children:0,
    };

    $scope.entry_id = 0;

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

    $scope.addInit = function(entry_id = 0){
        $scope.entry_id = entry_id;
        DBService.postCall({entry_id : $scope.entry_id}, '/api/dashboard/edit-init').then((data) => {
            if (data.success) {
                $scope.formData = data.sitting_entry;
            }
            $("#entryModal").modal("show");
        });
    }

    $scope.onSubmit = function () {
        console.log($scope.formData);return;
        DBService.postCall({}, '/api/dashboard/init').then((data) => {
            if (data.success) {
                $scope.pay_types = data.pay_types;
                $scope.hours = data.hours;
                $("#entryModal").modal("hide");
                $scope.init();
            }
        });
    }
});

