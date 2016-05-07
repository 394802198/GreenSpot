app.factory('contactUsService',['$http', '$q', function($http, $q){
    return{
        getResultsPage:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_contact_us/rest/getResultsPage',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        getMessageById:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_contact_us/rest/getMessageById',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        doneReply:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_contact_us/rest/doneReply',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        },
        reply:function(data){
            var defer = $q.defer();
            var $promise = $http.post('api/manager_contact_us/rest/reply',data);
            $promise.success(function(response){
                defer.resolve(response);
            });
            return defer.promise;
        }
    };

}]);