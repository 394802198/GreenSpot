function AllProductFeaturesController($scope, commonUtilService, productFeatureService)
{
    $scope.pagination = {
        keywords : '',
        pageSize : 18,
        currentPage : 1,
        productFeatures : []
    };

    function getResultsPage(pagination){
        productFeatureService.getResultsPage(pagination)
            .then(function(response)
            {
                $scope.pagination.productFeatures.length = 0;
                $scope.pagination.realLength = response.length;

                for(var productFeatureIndex in response)
                {
                    var productFeature = [];

                    productFeature.push(response[productFeatureIndex].id);
                    productFeature.push(response[productFeatureIndex].name);
                    productFeature.push(response[productFeatureIndex].sequence);
                    productFeature.push(response[productFeatureIndex].is_on_home_page);

                    $scope.pagination.productFeatures.push(productFeature);

                }
            });
    }
    getResultsPage($scope.pagination);

    $scope.deleteProductFeature = function(id){
        var data = {
            id : id
        };
        productFeatureService.delete(data)
            .then(function(response)
            {
                if(response.hasErrors){
                    commonUtilService.toastError(response.errorMap);
                } else {
                    commonUtilService.toastSuccess(response.successMap);
                }
                $scope.pagination.keywords = '';
                $scope.pagination.currentPage = 1;
                getResultsPage($scope.pagination);
            });
    };

    $scope.filterProductFeature = function() {
        getResultsPage($scope.pagination);
    };

    $scope.goUp = function(id){
        var data = {
            id : id
        };
        productFeatureService.goUp(data)
            .then(function(response)
            {
                if(response.hasErrors){
                    commonUtilService.toastError(response.errorMap);
                } else {
                    commonUtilService.toastSuccess(response.successMap);
                }
                getResultsPage($scope.pagination);
            });
    };

    $scope.goDown = function(id){
        var data = {
            id : id
        };
        productFeatureService.goDown(data)
            .then(function(response)
            {
                if(response.hasErrors){
                    commonUtilService.toastError(response.errorMap);
                } else {
                    commonUtilService.toastSuccess(response.successMap);
                }
                getResultsPage($scope.pagination);
            });
    };

}

AllProductFeaturesController.$inject = ['$scope', 'commonUtilService', 'productFeatureService'];

app.controller('AllProductFeaturesController', AllProductFeaturesController);