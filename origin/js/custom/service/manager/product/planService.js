app.factory('planService',['$http', '$q', '$location', 'commonUtilService', function($http, $q, $location, commonUtilService){
    return{
        getResultsPage:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/plan_rest/getResultsPage',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        getAll:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/plan_rest/getAll',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        getPlanById:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/plan_rest/getPlanById',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        update:function(data){
            var $promise = $http.post('api/manager_product/plan_rest/update',data);
            $promise.then(function(msg){
                var data = msg.data;
                if(data.hasErrors){
                    commonUtilService.toastError(data.errorMap);
                } else {
                    commonUtilService.toastSuccess(data.successMap);
                    $location.path('/manager/product/plan/all');
                }
            });
        },
        create:function(data){
            var $promise = $http.post('api/manager_product/plan_rest/create',data);
            $promise.then(function(msg){
                var data = msg.data;
                if(data.hasErrors){
                    commonUtilService.toastError(data.errorMap);
                } else {
                    commonUtilService.toastSuccess(data.successMap);
                    $location.path('/manager/product/plan/all');
                }
            });
        },
        delete:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/plan_rest/delete',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        goUp:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/plan_rest/go_up',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        goDown:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_product/plan_rest/go_down',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        }
    };

}]);