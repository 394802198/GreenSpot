app.factory('addonServiceService',['$http', '$q', '$location', 'commonUtilService', function($http, $q, $location, commonUtilService){
    return{
        getResultsPage:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/addon_service_rest/getResultsPage',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        getAddonServiceById:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/addon_service_rest/getAddonServiceById',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        update:function(data){
            var $promise = $http.post('api/manager_product/addon_service_rest/update',data);
            $promise.then(function(msg){
                var data = msg.data;
                if(data.hasErrors){
                    commonUtilService.toastError(data.errorMap);
                } else {
                    commonUtilService.toastSuccess(data.successMap);
                    $location.path('/manager/product/addon_service/all');
                }
            });
        },
        create:function(data){
            var $promise = $http.post('api/manager_product/addon_service_rest/create',data);
            $promise.then(function(msg){
                var data = msg.data;
                if(data.hasErrors){
                    commonUtilService.toastError(data.errorMap);
                } else {
                    commonUtilService.toastSuccess(data.successMap);
                    $location.path('/manager/product/addon_service/all');
                }
            });
        },
        delete:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/addon_service_rest/delete',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        }
    };

}]);