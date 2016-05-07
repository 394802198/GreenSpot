app.factory('paymentService',['$http', '$q', 'commonUtilService', function($http, $q, commonUtilService){
    return{
        getFirstThree:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/payment_rest/getFirstThree',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        getProductComboAndDetailsById:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/payment_rest/getProductComboAndDetailsById',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        getAllPlanHasDevice:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/payment_rest/getAllPlanHasDevice',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        checkout:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/service_rest/checkout',data);
            $promise.success(function(response){
                console.log(response);
                var data = response;
                if(data.hasErrors){
                    commonUtilService.toastError(data.errorMap);
                } else {
                    commonUtilService.toastSuccess(data.successMap);
                    window.location.href = '/api/payment_express_rest/make_payment_service/'+data.model.id+'/'+data.model.total_amount;
                }
            });
            return defer.promise;
        }
    };

}]);