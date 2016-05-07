function EditPlanController($location, $scope, $routeParams, planService, deviceService)
{
    $scope.plan = {
        'id' : $routeParams.id,
        'is_lump_accepted' : $routeParams.is_lump_accepted,
        'is_weekly_accepted' : $routeParams.is_weekly_accepted,
        'is_monthly_accepted' : $routeParams.is_monthly_accepted,
        'is_annual_accepted' : $routeParams.is_annual_accepted,
        'is_on_shelf' : $routeParams.is_on_shelf
    };

    function initData(){
        planService.getPlanById($scope.plan)
            .then(function (response) {
                $scope.plan = response;

                /**
                 * If get empty array then direct to home page
                 */
                if(JSON.stringify($scope.plan)=='[]')
                {
                    $location.path('/manager/home');
                }
                else
                {
                    deviceService.getAll()
                        .then(function(response){

                            $scope.devices = [];
                            for(var res in response)
                            {
                                var device = {};
                                device.id = response[res].id;
                                device.name = response[res].name;
                                if($scope.plan.device_ids!==null && $scope.plan.device_ids.indexOf(device.id) !== -1)
                                {
                                    var device_ids = $scope.plan.device_ids.split('^_greenspot_^');
                                    for(var device_id in device_ids)
                                    {
                                        device.is_checked = false;
                                        if(device_ids[device_id]==device.id)
                                        {
                                            device.is_checked = true;
                                            break;
                                        }
                                    }
                                }
                                $scope.devices.push(device);
                            }

                        });
                }
            });
    }
    initData();

    $scope.update = function()
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

        planService.update($scope.plan);
    };
}

EditPlanController.$inject = ['$location', '$scope', '$routeParams', 'planService', 'deviceService'];

app.controller('EditPlanController', EditPlanController);