function NewPlanController($scope, planService, deviceService)
{
    $scope.plan = {
        is_lump_accepted: 'NO',
        is_weekly_accepted: 'NO',
        is_monthly_accepted: 'NO',
        is_annual_accepted: 'NO',
        is_on_shelf: 'YES'
    };

    deviceService.getAll()
        .then(function(response){

            $scope.devices = [];
            for(var res in response)
            {
                var device = {};
                device.id = response[res].id;
                device.name = response[res].name;
                device.is_checked = false;
                $scope.devices.push(device);
            }

        });

    $scope.create = function()
    {
        if($scope.plan.is_lump_accepted=='NO')
        {
            $scope.plan.lump_fee = '';
        }
        if($scope.plan.is_weekly_accepted=='NO')
        {
            $scope.plan.weekly_fee = '';
        }
        if($scope.plan.is_monthly_accepted=='NO')
        {
            $scope.plan.monthly_fee = '';
        }
        if($scope.plan.is_annual_accepted=='NO')
        {
            $scope.plan.annual_fee = '';
        }

        $scope.device_ids = '';
        for(var device in $scope.devices)
        {
            if($scope.devices[device].is_checked)
            {
                $scope.device_ids += $scope.devices[device].id;
                $scope.device_ids += '^_greenspot_^';
            }
        }
        $scope.plan.device_ids = $scope.device_ids.substr(0, $scope.device_ids.lastIndexOf('^_greenspot_^'));

        planService.create($scope.plan);
    };
}

NewPlanController.$inject = ['$scope', 'planService', 'deviceService'];

app.controller('NewPlanController', NewPlanController);