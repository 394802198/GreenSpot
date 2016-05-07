function EditProductComboController($location, $scope, $routeParams, productComboService, productFeatureService, planService)
{
    $scope.productCombo = {
        'id' : $routeParams.id,
        'pay_frequency_on_home_page' : $routeParams.pay_frequency_on_home_page,
        'is_on_home_page' : $routeParams.is_on_home_page,
        'is_on_shelf' : $routeParams.is_on_shelf
    };

    function initData(){
        productComboService.getProductComboById($scope.productCombo)
            .then(function (response) {

                $scope.productCombo = response;

                /**
                 * If get empty array then direct to home page
                 */
                if(JSON.stringify($scope.productCombo)=='[]')
                {
                    $location.path('/manager/home');
                }
                else
                {

                    planService.getAll()
                        .then(function(response){

                            $scope.plans = [];
                            for(var res in response)
                            {
                                var plan = {};
                                plan.id = response[res].id;
                                plan.name = response[res].name;
                                if($scope.productCombo.plan_ids!==null && $scope.productCombo.plan_ids.indexOf(plan.id) !== -1)
                                {
                                    var plan_ids = $scope.productCombo.plan_ids.split('^_greenspot_^');
                                    for(var plan_id in plan_ids)
                                    {
                                        plan.is_checked = false;
                                        if(plan_ids[plan_id]==plan.id)
                                        {
                                            plan.is_checked = true;
                                            break;
                                        }
                                    }
                                }
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
                                if($scope.productCombo.feature_ids!==null && $scope.productCombo.feature_ids.indexOf(product_feature.id) !== -1)
                                {
                                    var feature_ids = $scope.productCombo.feature_ids.split('^_greenspot_^');
                                    for(var feature_id in feature_ids)
                                    {
                                        product_feature.is_checked = false;
                                        if(feature_ids[feature_id]==product_feature.id)
                                        {
                                            product_feature.is_checked = true;
                                            break;
                                        }
                                    }
                                }
                                $scope.product_features.push(product_feature);
                            }

                        });
                }
            });
    }
    initData();

    $scope.update = function()
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

        if($scope.productCombo.feature_ids==='')
        {
            $scope.productCombo.feature_ids='none';
        }
        if($scope.productCombo.device_ids==='')
        {
            $scope.productCombo.device_ids='none';
        }
        if($scope.productCombo.plan_ids==='')
        {
            $scope.productCombo.plan_ids='none';
        }

        productComboService.update($scope.productCombo);
    };
}

EditProductComboController.$inject = ['$location', '$scope', '$routeParams', 'productComboService', 'productFeatureService', 'planService'];

app.controller('EditProductComboController', EditProductComboController);