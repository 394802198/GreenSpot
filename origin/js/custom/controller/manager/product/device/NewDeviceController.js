function NewDeviceController($scope, deviceService)
{
    $scope.device = {
        is_lump_accepted: 'NO',
        is_weekly_accepted: 'NO',
        is_monthly_accepted: 'NO',
        is_annual_accepted: 'NO',
        is_on_shelf: 'YES'
    };

    $scope.create = function()
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
        deviceService.create($scope.device);
    };
}

NewDeviceController.$inject = ['$scope', 'deviceService'];

app.controller('NewDeviceController', NewDeviceController);