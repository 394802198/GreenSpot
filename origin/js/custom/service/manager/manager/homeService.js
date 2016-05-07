app.factory('homeService',['$http', '$q', function($http, $q){
    return{
        getHomeInfo:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager/rest/getHomeInfo',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        }
    };

}]);