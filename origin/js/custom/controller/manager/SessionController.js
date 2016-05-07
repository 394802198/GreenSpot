function SessionController($scope, sessionService)
{
    $scope.login = function(data){
        sessionService.login(data);
    };
    $scope.logout = function(){
        sessionService.logout();
    };
}

SessionController.$inject = ['$scope', 'sessionService'];

app.controller('SessionController', SessionController);