function AllPlansController($scope, commonUtilService, planService)
{
    $scope.pagination = {
        keywords : '',
        pageSize : 18,
        currentPage : 1,
        plans : []
    };

    function getResultsPage(pagination){
        planService.getResultsPage(pagination)
            .then(function(response)
            {
                $scope.pagination.plans.length = 0;
                $scope.pagination.realLength = response.length;

                for(var planIndex in response)
                {
                    var plan = [];

                    plan.push(response[planIndex].id);
                    plan.push(response[planIndex].name);
                    plan.push(response[planIndex].lump_fee);
                    plan.push(response[planIndex].weekly_fee);
                    plan.push(response[planIndex].monthly_fee);
                    plan.push(response[planIndex].annual_fee);
                    plan.push(response[planIndex].is_lump_accepted);
                    plan.push(response[planIndex].is_weekly_accepted);
                    plan.push(response[planIndex].is_monthly_accepted);
                    plan.push(response[planIndex].is_annual_accepted);
                    plan.push(response[planIndex].is_on_shelf);

                    $scope.pagination.plans.push(plan);

                }
            });
    }
    getResultsPage($scope.pagination);

    $scope.deletePlan = function(id){
        var data = {
            id : id
        };
        planService.delete(data)
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

    $scope.filterPlan = function() {
        getResultsPage($scope.pagination);
    };

}

AllPlansController.$inject = ['$scope', 'commonUtilService', 'planService'];

app.controller('AllPlansController', AllPlansController);