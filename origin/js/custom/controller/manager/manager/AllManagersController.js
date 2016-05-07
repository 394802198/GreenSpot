function AllManagersController($scope, commonUtilService, managerService)
{
    $scope.pagination = {
        keywords : '',
        pageSize : 18,
        currentPage : 1,
        managers : []
    };

    function getResultsPage(pagination){
        managerService.getResultsPage(pagination)
            .then(function(response)
            {
                $scope.pagination.managers.length = 0;

                for(var managerIndex in response)
                {
                    var manager = [];

                    manager.push(response[managerIndex].id);
                    manager.push(response[managerIndex].account);
                    manager.push(response[managerIndex].role);
                    manager.push(response[managerIndex].first_name);
                    manager.push(response[managerIndex].last_name);
                    manager.push(response[managerIndex].email);
                    manager.push(response[managerIndex].mobile);
                    manager.push(response[managerIndex].landline);

                    $scope.pagination.managers.push(manager);

                }
            });
    }
    getResultsPage($scope.pagination);

    $scope.deleteManager = function(id){
        var data = {
            id : id
        };
        managerService.delete(data)
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

    $scope.filterManager = function(pagination) {
        getResultsPage(pagination);
    };

}

AllManagersController.$inject = ['$scope', 'commonUtilService', 'managerService'];

app.controller('AllManagersController', AllManagersController);