app.factory('homeProductComboService',['$http', '$q', '$location', 'commonUtilService', function($http, $q){
    return{
        getFirstThree:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/product_combo_rest/getFirstThree',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        }
    };

}]);