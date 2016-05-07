function NewProductComboController($scope, productComboService, productFeatureService, planService)
{
    $scope.productCombo = {
        pay_frequency_on_home_page : 'ANNUAL',
        is_on_home_page : 'NO',
        is_on_shelf: 'YES'
    };

    planService.getAll()
        .then(function(response){

            $scope.plans = [];
            for(var res in response)
            {
                var plan = {};
                plan.id = response[res].id;
                plan.name = response[res].name;
                plan.is_checked = false;
                $scope.plans.push(plan);
            }

        });

    productFeatureService.getAll()
        .then(function(response){

            $scope.product_features = [];
            for(var res in response)
            {
                var product_feature = {};
                product_feature.id = response[res].id;
                product_feature.name = response[res].name;
                product_feature.is_checked = false;
                $scope.product_features.push(product_feature);
            }

        });

    $scope.create = function()
    {
        $scope.feature_ids = '';
        for(var product_feature in $scope.product_features)
        {
            if($scope.product_features[product_feature].is_checked)
            {
                $scope.feature_ids += $scope.product_features[product_feature].id;
                $scope.feature_ids += '^_greenspot_^';
            }
        }
        $scope.productCombo.feature_ids = $scope.feature_ids.substr(0, $scope.feature_ids.lastIndexOf('^_greenspot_^'));

        $scope.plan_ids = '';
        for(var plan in $scope.plans)
        {
            if($scope.plans[plan].is_checked)
            {
                $scope.plan_ids += $scope.plans[plan].id;
                $scope.plan_ids += '^_greenspot_^';
            }
        }
        $scope.productCombo.plan_ids = $scope.plan_ids.substr(0, $scope.plan_ids.lastIndexOf('^_greenspot_^'));

        productComboService.create($scope.productCombo);
    };
}

NewProductComboController.$inject = ['$scope', 'productComboService', 'productFeatureService', 'planService'];

app.controller('NewProductComboController', NewProductComboController);