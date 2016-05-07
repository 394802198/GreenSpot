function MyProfileController($scope, sessionService, managerService)
{
    $scope.manager = {};

    function initData(){
        sessionService.getManagerSession().then(
            function (response) {
                $scope.manager = response;
            }
        );
    }
    initData();

    $scope.updateMyProfile = function(data){
        managerService.updateMyProfile(data);
    };
}

MyProfileController.$inject = ['$scope', 'sessionService', 'managerService'];

app.controller('MyProfileController', MyProfileController);