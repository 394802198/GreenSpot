function AllProductCombosController($scope, commonUtilService, productComboService)
{
    $scope.pagination = {
        keywords : '',
        pageSize : 18,
        currentPage : 1,
        productCombos : []
    };

    function getResultsPage(pagination){
        productComboService.getResultsPage(pagination)
            .then(function(response)
            {
                $scope.pagination.productCombos.length = 0;
                $scope.pagination.realLength = response.length;

                for(var productComboIndex in response)
                {
                    var productCombo = [];

                    productCombo.push(response[productComboIndex].id);
                    productCombo.push(response[productComboIndex].name);
                    productCombo.push(response[productComboIndex].shipping_fee);
                    productCombo.push(response[productComboIndex].fee_on_home_page);
                    productCombo.push(response[productComboIndex].pay_frequency_on_home_page);
                    productCombo.push(response[productComboIndex].sequence);
                    productCombo.push(response[productComboIndex].is_on_home_page);
                    productCombo.push(response[productComboIndex].is_on_shelf);

                    $scope.pagination.productCombos.push(productCombo);

                }
            });
    }
    getResultsPage($scope.pagination);

    $scope.deleteProductCombo = function(id){
        var data = {
            id : id
        };
        productComboService.deleteProductCombo(data)
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

    $scope.filterProductCombo = function() {
        getResultsPage($scope.pagination);
    };

    $scope.goUp = function(id){
        var data = {
            id : id
        };
        productComboService.goUp(data)
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
        productComboService.goDown(data)
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

AllProductCombosController.$inject = ['$scope', 'commonUtilService', 'productComboService'];

app.controller('AllProductCombosController', AllProductCombosController);