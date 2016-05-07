app.config( ["$routeProvider", function ($routeProvider) {
    $routeProvider
        .when('/support_center', {
            templateUrl: 'pages/support_center/index.html'
        })
        .when('/support_center/how_do_you_choose_your_authentication_method', {
            templateUrl: 'pages/support_center/how_do_you_choose_your_authentication_method.html'
        })
        .when('/support_center/set_your_customers_wifi_time', {
            templateUrl: 'pages/support_center/set_your_customers_wifi_time.html'
        })
        .when('/support_center/choose_a_templet_for_your_wifi_authentication_page', {
            templateUrl: 'pages/support_center/choose_a_templet_for_your_wifi_authentication_page.html'
        })
        .when('/support_center/upload_your_logo_contact_and_info_to_authentication_page', {
            templateUrl: 'pages/support_center/upload_your_logo_contact_and_info_to_authentication_page.html'
        })
        .when('/support_center/upload_your_promotion_images', {
            templateUrl: 'pages/support_center/upload_your_promotion_images.html'
        })
        .when('/support_center/set_black_white_list', {
            templateUrl: 'pages/support_center/set_black_white_list.html'
        })
        .when('/support_center/how_you_set_membership_card', {
            templateUrl: 'pages/support_center/how_you_set_membership_card.html'
        })
        .when('/support_center/change_your_password', {
            templateUrl: 'pages/support_center/change_your_password.html'
        })
        .when('/support_center/sms_topup', {
            templateUrl: 'pages/support_center/sms_topup.html'
        })
        .when('/support_center/check_dashboard', {
            templateUrl: 'pages/support_center/check_dashboard.html'
        })
        .when('/support_center/check_user_list', {
            templateUrl: 'pages/support_center/check_user_list.html'
        })
        .when('/support_center/e_shop/general', {
            templateUrl: 'pages/support_center/e_shop/general.html'
        })
        .when('/support_center/e_shop/template', {
            templateUrl: 'pages/support_center/e_shop/template.html'
        })
        .when('/support_center/e_shop/ads', {
            templateUrl: 'pages/support_center/e_shop/ads.html'
        })
        .when('/support_center/e_shop/section', {
            templateUrl: 'pages/support_center/e_shop/section.html'
        })
        .when('/support_center/e_shop/information', {
            templateUrl: 'pages/support_center/e_shop/information.html'
        })
        .when('/support_center/e_shop/message', {
            templateUrl: 'pages/support_center/e_shop/message.html'
        });
}]);