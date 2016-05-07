function EditManagerController($location, $scope, $routeParams, managerService, authorizationService)
{
    $scope.manager = {
        'id' : $routeParams.id
    };
    $scope.authorization_linkages_path = authorizationService.getAuthorizationLinkagesPath();
    $scope.authorization_linkages_status = {};

    function initData(){
        managerService.getManagerById($scope.manager).then(
            function (response) {
                $scope.manager = response;

                /**
                 * If get empty array then direct to home page
                 */
                if(JSON.stringify($scope.manager)=='[]')
                {
                    $location.path('/manager/home');
                }
                else
                {
                    authorizationService.getMatchedAuthorizationLinkagesStatus($scope.manager.authorized_paths).then(
                        function(response){
                            $scope.authorization_linkages_status = response;
                        }
                    );
                }
            }
        );
    }
    initData();

    $scope.update = function(data)
    {
        authorizationService.getFinalSelectedAuthorizedPaths(data, $scope.authorization_linkages_status, $scope.authorization_linkages_path);
        managerService.update(data);
    };

}

EditManagerController.$inject = ['$location', '$scope', '$routeParams', 'managerService', 'authorizationService'];

app.controller('EditManagerController', EditManagerController);