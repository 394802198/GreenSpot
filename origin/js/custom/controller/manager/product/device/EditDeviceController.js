function EditDeviceController($location, $scope, $routeParams, deviceService)
{
    $scope.device = {
        'id' : $routeParams.id,
        'is_lump_accepted' : $routeParams.is_lump_accepted,
        'is_weekly_accepted' : $routeParams.is_weekly_accepted,
        'is_monthly_accepted' : $routeParams.is_monthly_accepted,
        'is_annual_accepted' : $routeParams.is_annual_accepted,
        'is_on_shelf' : $routeParams.is_on_shelf
    };

    function initData(){
        deviceService.getDeviceById($scope.device)
            .then(function (response) {
                $scope.device = response;

                /**
                 * If get empty array then direct to home page
                 */
                if(JSON.stringify($scope.device)=='[]')
                {
                    $location.path('/manager/home');
                }
            });
    }
    initData();

    $scope.update = function()
    {
        if($scope.device.is_lump_accepted=='NO')
        {
            $scope.device.lump_fee = '';
        }
        if($scope.device.is_weekly_accepted=='NO')
        {
            $scope.device.weekly_fee = '';
        }
        if($scope.device.is_monthly_accepted=='NO')
        {
            $scope.device.monthly_fee = '';
        }
        if($scope.device.is_annual_accepted=='NO')
        {
            $scope.device.annual_fee = '';
        }
        deviceService.update($scope.device);
    };
}

EditDeviceController.$inject = ['$location', '$scope', '$routeParams', 'deviceService'];

app.controller('EditDeviceController', EditDeviceController);