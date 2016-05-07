app.config(['toastrConfig', '$locationProvider', function(toastrConfig, $locationProvider) {

    $locationProvider.html5Mode(true).hashPrefix('!');

    angular.extend(toastrConfig, {
        allowHtml: false,
        autoDismiss: false,
        closeButton: false,
        closeHtml: '<button>&times;</button>',
        containerId: 'toast-container',
        messageClass: 'toast-message',
        positionClass: 'toast-bottom-right',
        timeOut: 3000
    });
}]);
