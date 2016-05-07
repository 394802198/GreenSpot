function NewAddonServiceController($scope, addonServiceService)
{
    $scope.addonService = {
        is_lump_accepted: 'NO',
        is_weekly_accepted: 'NO',
        is_monthly_accepted: 'NO',
        is_annual_accepted: 'NO',
        is_on_shelf: 'YES'
    };

    $scope.create = function()
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
        addonServiceService.create($scope.addonService);
    };
}

NewAddonServiceController.$inject = ['$scope', 'addonServiceService'];

app.controller('NewAddonServiceController', NewAddonServiceController);