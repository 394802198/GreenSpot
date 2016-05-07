app.factory('sessionService',['$http', '$q','$location','commonUtilService',function($http, $q, $location, commonUtilService){
    return{
        login:function(data){
            var $promise = $http.post('api/manager/session_control/login',data); //send data to user.php
            $promise.then(function(msg){
                var data = msg.data;
                if(data.hasErrors){
                    commonUtilService.toastError(data.errorMap);
                    $location.path('/manager/login');
                } else {
                    commonUtilService.toastSuccess(data.successMap);
                    $location.path('/manager/home');
                }
            });
        },
        logout:function(){
            var $promise = $http.post('api/manager/session_control/logout');
            $promise.then(function(msg) {
                var data = msg.data;
                commonUtilService.toastSuccess(data.successMap);
                $location.path('/manager/login');
            });
        },
        isLoggedIn:function(){
            var defer = $q.defer();
            var $promise = $http.get('api/manager/session_control/isLoggedIn');
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        getManagerSession:function(data){
            var defer = $q.defer();
            var $promise = $http.get('api/manager/session_control/getManagerSession', data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        }
    };

}]);