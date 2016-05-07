function AllAddonServicesController($scope, commonUtilService, addonServiceService)
{
    $scope.pagination = {
        keywords : '',
        pageSize : 18,
        currentPage : 1,
        addonServices : []
    };

    function getResultsPage(pagination){
        addonServiceService.getResultsPage(pagination)
            .then(function(response)
            {
                $scope.pagination.addonServices.length = 0;
                $scope.pagination.realLength = response.length;

                for(var addonServiceIndex in response)
                {
                    var addonService = [];

                    addonService.push(response[addonServiceIndex].id);
                    addonService.push(response[addonServiceIndex].name);
                    addonService.push(response[addonServiceIndex].lump_fee);
                    addonService.push(response[addonServiceIndex].weekly_fee);
                    addonService.push(response[addonServiceIndex].monthly_fee);
                    addonService.push(response[addonServiceIndex].annual_fee);
                    addonService.push(response[addonServiceIndex].is_lump_accepted);
                    addonService.push(response[addonServiceIndex].is_weekly_accepted);
                    addonService.push(response[addonServiceIndex].is_monthly_accepted);
                    addonService.push(response[addonServiceIndex].is_annual_accepted);
                    addonService.push(response[addonServiceIndex].is_on_shelf);

                    $scope.pagination.addonServices.push(addonService);

                }
            });
    }
    getResultsPage($scope.pagination);

    $scope.deleteAddonService = function(id){
        var data = {
            id : id
        };
        addonServiceService.delete(data)
            .then(function(response)
            {
                if(response.hasErrors){
                    commonUtilService.toastError(response.errorMap);
                } else {
                    commonUtilService.toastSuccess(response.successMap);
                }
                $scope.pagination.keywords = '';
                $scope.pagination.currentPage = 1;
                getResultsPage($scope.pagination);
            });
    };

    $scope.filterAddonService = function() {
        getResultsPage($scope.pagination);
    };

}

AllAddonServicesController.$inject = ['$scope', 'commonUtilService', 'addonServiceService'];

app.controller('AllAddonServicesController', AllAddonServicesController);