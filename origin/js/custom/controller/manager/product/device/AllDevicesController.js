function AllDevicesController($scope, commonUtilService, deviceService)
{
    $scope.pagination = {
        keywords : '',
        pageSize : 18,
        currentPage : 1,
        devices : []
    };

    function getResultsPage(pagination){
        deviceService.getResultsPage(pagination)
            .then(function(response)
            {
                $scope.pagination.devices.length = 0;
                $scope.pagination.realLength = response.length;

                for(var deviceIndex in response)
                {
                    var device = [];

                    device.push(response[deviceIndex].id);
                    device.push(response[deviceIndex].name);
                    device.push(response[deviceIndex].lump_fee);
                    device.push(response[deviceIndex].weekly_fee);
                    device.push(response[deviceIndex].monthly_fee);
                    device.push(response[deviceIndex].annual_fee);
                    device.push(response[deviceIndex].is_lump_accepted);
                    device.push(response[deviceIndex].is_weekly_accepted);
                    device.push(response[deviceIndex].is_monthly_accepted);
                    device.push(response[deviceIndex].is_annual_accepted);
                    device.push(response[deviceIndex].is_on_shelf);

                    $scope.pagination.devices.push(device);

                }
            });
    }
    getResultsPage($scope.pagination);

    $scope.deleteDevice = function(id){
        var data = {
            id : id
        };
        deviceService.delete(data)
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

    $scope.filterDevice = function() {
        getResultsPage($scope.pagination);
    };

}

AllDevicesController.$inject = ['$scope', 'commonUtilService', 'deviceService'];

app.controller('AllDevicesController', AllDevicesController);