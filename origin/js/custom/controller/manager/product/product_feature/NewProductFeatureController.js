function NewProductFeatureController($scope, productFeatureService)
{
    $scope.productFeature = {
        is_on_home_page : 'NO'
    };

    $scope.create = function()
    {
        productFeatureService.create($scope.productFeature);
    };
}

NewProductFeatureController.$inject = ['$scope', 'productFeatureService'];

app.controller('NewProductFeatureController', NewProductFeatureController);