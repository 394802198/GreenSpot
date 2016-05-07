app.factory('homeProductFeatureService',['$http', '$q', '$location', 'commonUtilService', function($http, $q){
    return{
        getAll:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/product_feature_rest/getAll',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        getProductFeatureById:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/product_feature_rest/getProductFeatureById',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        }
    };

}]);