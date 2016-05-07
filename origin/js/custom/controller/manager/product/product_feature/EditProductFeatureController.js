function EditProductFeatureController($location, $scope, $routeParams, productFeatureService)
{
    $scope.productFeature = {
        'id' : $routeParams.id,
        'is_on_home_page' : $routeParams.is_on_home_page
    };

    function initData(){
        productFeatureService.getProductFeatureById($scope.productFeature).then(
            function (response) {
                $scope.productFeature = response;

                /**
                 * If get empty array then direct to home page
                 */
                if(JSON.stringify($scope.productFeature)=='[]')
                {
                    $location.path('/manager/home');
                }
            }
        );
    }
    initData();

    $scope.update = function()
    {
        productFeatureService.update($scope.productFeature);
    };
}

EditProductFeatureController.$inject = ['$location', '$scope', '$routeParams', 'productFeatureService'];

app.controller('EditProductFeatureController', EditProductFeatureController);