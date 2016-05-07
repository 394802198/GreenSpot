app.config( ["$routeProvider", function ($routeProvider) {
    $routeProvider
        .when('/manager/login', {
            templateUrl: 'pages/manager/login.html',
            controller : SessionController
        })
        .when('/manager/home', {
            templateUrl: 'pages/manager/home.html',
            controller : HomeController
        })
        .when('/manager/my_profile', {
            templateUrl: 'pages/manager/my_profile.html',
            controller : MyProfileController
        })
    /**
     * Product Module Routes
     */
        .when('/manager/product/product_combo/all', {
            templateUrl: 'pages/manager/product/product_combo/all_product_combos.html',
            controller : AllProductCombosController
        })
        .when('/manager/product/product_combo/new', {
            templateUrl: 'pages/manager/product/product_combo/new_product_combo.html',
            controller : NewProductComboController
        })
        .when('/manager/product/product_combo/edit/:id/:pay_frequency_on_home_page/:is_on_home_page/:is_on_shelf', {
            templateUrl: 'pages/manager/product/product_combo/edit_product_combo.html',
            controller : EditProductComboController
        })
        .when('/manager/product/product_feature/all', {
            templateUrl: 'pages/manager/product/product_feature/all_product_features.html',
            controller : AllProductFeaturesController
        })
        .when('/manager/product/product_feature/new', {
            templateUrl: 'pages/manager/product/product_feature/new_product_feature.html',
            controller : NewProductFeatureController
        })
        .when('/manager/product/product_feature/edit/:id/:is_on_home_page', {
            templateUrl: 'pages/manager/product/product_feature/edit_product_feature.html',
            controller : EditProductFeatureController
        })
        .when('/manager/product/plan/all', {
            templateUrl: 'pages/manager/product/plan/all_plans.html',
            controller : AllPlansController
        })
        .when('/manager/product/plan/new', {
            templateUrl: 'pages/manager/product/plan/new_plan.html',
            controller : NewPlanController
        })
        .when('/manager/product/plan/edit/:id/:is_lump_accepted/:is_weekly_accepted/:is_monthly_accepted/:is_annual_accepted/:is_on_shelf', {
            templateUrl: 'pages/manager/product/plan/edit_plan.html',
            controller : EditPlanController
        })
        .when('/manager/product/device/all', {
            templateUrl: 'pages/manager/product/device/all_devices.html',
            controller : AllDevicesController
        })
        .when('/manager/product/device/new', {
            templateUrl: 'pages/manager/product/device/new_device.html',
            controller : NewDeviceController
        })
        .when('/manager/product/device/edit/:id/:is_lump_accepted/:is_weekly_accepted/:is_monthly_accepted/:is_annual_accepted/:is_on_shelf', {
            templateUrl: 'pages/manager/product/device/edit_device.html',
            controller : EditDeviceController
        })
        .when('/manager/product/addon_service/all', {
            templateUrl: 'pages/manager/product/addon_service/all_addon_services.html',
            controller : AllAddonServicesController
        })
        .when('/manager/product/addon_service/new', {
            templateUrl: 'pages/manager/product/addon_service/new_addon_service.html',
            controller : NewAddonServiceController
        })
        .when('/manager/product/addon_service/edit/:id/:is_lump_accepted/:is_weekly_accepted/:is_monthly_accepted/:is_annual_accepted/:is_on_shelf', {
            templateUrl: 'pages/manager/product/addon_service/edit_addon_service.html',
            controller : EditAddonServiceController
        })
    /**
     * Service Module Routes
     */
    /**
     * Billing Module Routes
     */
    /**
     * Sales Module Routes
     */
    /**
     * Manager Module Routes
     */
        .when('/manager/all', {
            reloadOnSearch: false,
            templateUrl: 'pages/manager/manager/all_managers.html',
            controller : AllManagersController
        })
        .when('/manager/edit/:id', {
            templateUrl: 'pages/manager/manager/edit_manager.html',
            controller : EditManagerController
        })
        .when('/manager/new', {
            templateUrl: 'pages/manager/manager/new_manager.html',
            controller : NewManagerController
        })
    /**
     * Contact Us Module Routes
     */
        .when('/manager/contact_us/message/all', {
            reloadOnSearch: false,
            templateUrl: 'pages/manager/contact_us/all_messages.html',
            controller : AllMessagesController
        })
        .when('/manager/contact_us/message/edit/:id', {
            templateUrl: 'pages/manager/contact_us/edit_message.html',
            controller : EditMessageController
        });
}]);