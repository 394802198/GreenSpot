function NewManagerController($scope, managerService, authorizationService)
{
    $scope.manager = {};
    $scope.authorization_linkages_path = authorizationService.getAuthorizationLinkagesPath();
    $scope.authorization_linkages_status = authorizationService.getAuthorizationLinkagesStatus();

    $scope.create = function(data)
    {
        authorizationService.getFinalSelectedAuthorizedPaths(data, $scope.authorization_linkages_status, $scope.authorization_linkages_path);
        managerService.create(data);
    };
}

NewManagerController.$inject = ['$scope', 'managerService', 'authorizationService'];

app.controller('NewManagerController', NewManagerController);