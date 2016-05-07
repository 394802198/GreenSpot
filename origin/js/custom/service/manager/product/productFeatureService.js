app.factory('productFeatureService',['$http', '$q', '$location', 'commonUtilService', function($http, $q, $location, commonUtilService){
    return{
        getResultsPage:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/product_feature_rest/getResultsPage',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        getAll:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/product_feature_rest/getAll',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        getProductFeatureById:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/product_feature_rest/getProductFeatureById',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        update:function(data){
            var $promise = $http.post('api/manager_product/product_feature_rest/update',data);
            $promise.then(function(msg){
                var data = msg.data;
                if(data.hasErrors){
                    commonUtilService.toastError(data.errorMap);
                } else {
                    commonUtilService.toastSuccess(data.successMap);
                    $location.path('/manager/product/product_feature/all');
                }
            });
        },
        create:function(data){
            var $promise = $http.post('api/manager_product/product_feature_rest/create',data);
            $promise.then(function(msg){
                var data = msg.data;
                if(data.hasErrors){
                    commonUtilService.toastError(data.errorMap);
                } else {
                    commonUtilService.toastSuccess(data.successMap);
                    $location.path('/manager/product/product_feature/all');
                }
            });
        },
        delete:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/product_feature_rest/delete',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        goUp:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/product_feature_rest/go_up',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        goDown:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/product_feature_rest/go_down',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        }
    };

}]);