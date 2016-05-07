function PaymentController($scope, $location, $routeParams, paymentService)
{
    $scope.productCombo = {
        'id' : $routeParams.id
    };
    $scope.service = {
        'business_type' : 'Hotel',
        'is_new_shipping_address' : 'NO',
        'shipping_fee' : 10
    };

    $scope.service_plans = [];
    $scope.service_devices = [];
    $scope.service_addon_services = [];

    $scope.service_total_payable = 0;

    $scope.checkout = function()
    {
        var service_plan_ids = '';
        var service_device_ids_and_qty = '';
        var service_addon_service_ids = '';
        /**
         * Get service plan ids
         */
        for(var service_plan in $scope.service_plans)
        {
            service_plan_ids += $scope.service_plans[service_plan].id;
            if(service_plan < $scope.service_plans.length - 1)
            {
                service_plan_ids += '^_greenspot_^';
            }
        }
        /**
         * Get service device ids
         */
        for(var service_device in $scope.service_devices)
        {
            service_device_ids_and_qty += $scope.service_devices[service_device].id + '|' + $scope.service_devices[service_device].qty;
            if(service_device < $scope.service_devices.length - 1)
            {
                service_device_ids_and_qty += '^_greenspot_^';
            }
        }
        /**
         * Get service device ids
         */
        for(var service_addon_service in $scope.service_addon_services)
        {
            service_addon_service_ids += $scope.service_addon_services[service_addon_service].id;
            if(service_addon_service < $scope.service_addon_services.length - 1)
            {
                service_addon_service_ids += '^_greenspot_^';
            }
        }

        $scope.service.plan_ids = service_plan_ids;
        $scope.service.device_ids_and_qty = service_device_ids_and_qty;
        $scope.service.addon_service_ids = service_addon_service_ids;
        $scope.service.total_amount = $scope.service_total_payable;

        paymentService.checkout($scope.service);
    };

    $scope.changePlan = function(plan, service_plan)
    {
        plan = JSON.parse(plan);
        for(var sp in $scope.service_plans)
        {
            if($scope.service_plans[sp].id == service_plan.id)
            {
                //for(var device in $scope.service_plans[sp].devices)
                //{
                    for(var service_device in $scope.service_devices)
                    {
                        $scope.service_devices[service_device] = plan.devices[0];
                        //console.log(plan.devices[device]);
                    }
                //}
                $scope.service_plans[sp] = plan;
            }
        }
        $scope.getServiceTotalPrice();
    };

    $scope.changeQty = function(qty, device)
    {
        for(var d in $scope.service_devices)
        {
            if($scope.service_devices[d].id == device.id)
            {
                $scope.service_devices[d].qty = qty;
                $scope.service_devices[d].is_changing_qty = 'NO';
            }
        }
        $scope.getServiceTotalPrice();
    };

    $scope.changeCombo = function(id)
    {
        $location.path('/payment/'+id);
    };

    $scope.getServiceTotalPrice = function()
    {
        var plan_total = 0;
        var device_total = 0;

        var plans = $scope.service_plans;
        for(var plan in plans)
        {
            if(typeof plans[plan].annual_fee != 'undefined')
            {
                plan_total += Number(plans[plan].annual_fee);
            }
            for(var device in plans[plan].devices)
            {
                if(typeof plans[plan].devices[device].annual_fee != 'undefined')
                {
                    device_total += (Number(plans[plan].devices[device].annual_fee) * Number(plans[plan].devices[device].qty));
                }
            }
        }

        $scope.service_total_payable = Number(plan_total) + Number(device_total) + Number($scope.service.shipping_fee);
        $scope.service_total_payable = Number($scope.service_total_payable).toFixed(2);
    };

    paymentService.getProductComboAndDetailsById($scope.productCombo)
        .then(function(response){
            $scope.productCombo = response;

            var plans = $scope.productCombo.plans;
            for(var plan in plans)
            {
                if(typeof plans[plan].annual_fee != 'undefined')
                {
                    plans[plan].annual_fee = Number(plans[plan].annual_fee).toFixed(2);
                    $scope.service_plans.push(plans[plan]);
                }

                for(var device in plans[plan].devices)
                {
                    if(typeof plans[plan].devices[device].annual_fee != 'undefined')
                    {
                        plans[plan].devices[device].annual_fee = Number(plans[plan].devices[device].annual_fee).toFixed(2);
                        $scope.service_devices.push(plans[plan].devices[device]);
                    }
                }
            }

            $scope.service.shipping_fee = Number($scope.productCombo.shipping_fee).toFixed(2);

            $scope.getServiceTotalPrice();
        });

    paymentService.getFirstThree()
        .then(function(response){
            $scope.productCombos = response;
        });

    paymentService.getAllPlanHasDevice()
        .then(function(response){

            $scope.plans = [];
            for(var res in response)
            {
                var plan = {};
                plan.id = response[res].id;
                plan.name = response[res].name;
                plan.annual_fee = Number(response[res].annual_fee).toFixed(2);
                plan.is_changing_plan = response[res].is_changing_plan;
                plan.has_device = response[res].has_device;
                plan.devices = response[res].devices;
                plan.brief_description = response[res].brief_description;
                $scope.plans.push(plan);
            }

        });
}

PaymentController.$inject = ['$scope' ,'$location', '$routeParams', 'paymentService'];

app.controller('PaymentController', PaymentController);