function EditAddonServiceController($location, $scope, $routeParams, addonServiceService)
{
    $scope.addonService = {
        'id' : $routeParams.id,
        'is_lump_accepted' : $routeParams.is_lump_accepted,
        'is_weekly_accepted' : $routeParams.is_weekly_accepted,
        'is_monthly_accepted' : $routeParams.is_monthly_accepted,
        'is_annual_accepted' : $routeParams.is_annual_accepted,
        'is_on_shelf' : $routeParams.is_on_shelf
    };

    function initData(){
        addonServiceService.getAddonServiceById($scope.addonService).then(
            function (response) {
                $scope.addonService = response;

                /**
                 * If get empty array then direct to home page
                 */
                if(JSON.stringify($scope.addonService)=='[]')
                {
                    $location.path('/manager/home');
                }
            }
        );
    }
    initData();

    $scope.update = function()
    {
        if($scope.addonService.is_lump_accepted=='NO')
        {
            $scope.addonService.lump_fee = '';
        }
        if($scope.addonService.is_weekly_accepted=='NO')
        {
            $scope.addonService.weekly_fee = '';
        }
        if($scope.addonService.is_monthly_accepted=='NO')
        {
            $scope.addonService.monthly_fee = '';
        }
        if($scope.addonService.is_annual_accepted=='NO')
        {
            $scope.addonService.annual_fee = '';
        }
        addonServiceService.update($scope.addonService);
    };
}

EditAddonServiceController.$inject = ['$location', '$scope', '$routeParams', 'addonServiceService'];

app.controller('EditAddonServiceController', EditAddonServiceController);