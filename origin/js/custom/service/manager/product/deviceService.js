app.factory('deviceService',['$http', '$q', '$location', 'commonUtilService', function($http, $q, $location, commonUtilService){
    return{
        getResultsPage:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/device_rest/getResultsPage',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        getAll:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/device_rest/getAll',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        getDeviceById:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/device_rest/getDeviceById',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        update:function(data){
            var $promise = $http.post('api/manager_product/device_rest/update',data);
            $promise.then(function(msg){
                var data = msg.data;
                if(data.hasErrors){
                    commonUtilService.toastError(data.errorMap);
                } else {
                    commonUtilService.toastSuccess(data.successMap);
                    $location.path('/manager/product/device/all');
                }
            });
        },
        create:function(data){
            var $promise = $http.post('api/manager_product/device_rest/create',data);
            $promise.then(function(msg){
                var data = msg.data;
                if(data.hasErrors){
                    commonUtilService.toastError(data.errorMap);
                } else {
                    commonUtilService.toastSuccess(data.successMap);
                    $location.path('/manager/product/device/all');
                }
            });
        },
        delete:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/device_rest/delete',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        }
    };

}]);