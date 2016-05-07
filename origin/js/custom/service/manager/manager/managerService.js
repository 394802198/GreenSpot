app.factory('managerService',['$http', '$q', '$location', 'commonUtilService', function($http, $q, $location, commonUtilService){
    return{
        updateMyProfile:function(data){
            var $promise = $http.post('api/manager/rest/updateMyProfile',data);
            $promise.then(function(msg){
                var data = msg.data;
                if(data.hasErrors){
                    commonUtilService.toastError(data.errorMap);
                } else {
                    commonUtilService.toastSuccess(data.successMap);
                    $location.path('/manager/home');
                }
            });
        },
        getResultsPage:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager/rest/getResultsPage',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        getManagerById:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager/rest/getManagerById',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        update:function(data){
            var $promise = $http.post('api/manager/rest/update',data);
            $promise.then(function(msg){
                var data = msg.data;
                if(data.hasErrors){
                    commonUtilService.toastError(data.errorMap);
                } else {
                    commonUtilService.toastSuccess(data.successMap);
                    $location.path('/manager/all');
                }
            });
        },
        create:function(data){
            var $promise = $http.post('api/manager/rest/create',data);
            $promise.then(function(msg){
                var data = msg.data;
                if(data.hasErrors){
                    commonUtilService.toastError(data.errorMap);
                } else {
                    commonUtilService.toastSuccess(data.successMap);
                    $location.path('/manager/all');
                }
            });
        },
        checkAccountExisted:function(data){
            var $promise = $http.post('api/manager/rest/check_account_existed',data);
            $promise.then(function(msg){
                var data = msg.data;
                if(data.hasErrors){
                    commonUtilService.toastError(data.errorMap);
                }
            });
        },
        delete:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager/rest/delete',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        }
    };

}]);