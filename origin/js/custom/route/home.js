app.config( ["$routeProvider", function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'pages/home.html',
            controller : HomeController
        })
        .when('/more_e_shop', {
            templateUrl: 'pages/more_e_shop.html'
        })
        .otherwise({
            redirectTo: '/'
        });
}]);