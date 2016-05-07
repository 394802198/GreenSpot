app.config( ["$routeProvider", function ($routeProvider) {
    $routeProvider
        .when('/payment/:id', {
            templateUrl: 'pages/payment/home.html',
            controller: PaymentController
        });
}]);