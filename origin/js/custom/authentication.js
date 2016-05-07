
app.run(['$rootScope', '$location', 'sessionService', 'authorizationService', function($rootScope, $location, sessionService, authorizationService){

    $rootScope.isLoggedIn = true;
    var routeNeedPermission = '/manager';  //route that require login
    $rootScope.$on('$routeChangeStart', function(event){
        if( $location.path().indexOf(routeNeedPermission) !==-1 )
        {
            var connected = sessionService.isLoggedIn();
            connected.then(function(response){
                if(response === 'NO')
                {
                    $rootScope.isLoggedIn = false;
                    $location.path('/manager/login');
                }
                /**
                 * Logged in
                 */
                else
                {
                    if($location.path().substring(0, '/manager'.length) !== '/manager')
                    {
                        $location.path('/manager/home');
                    }
                    $rootScope.isLoggedIn = true;

                    /**
                     * To check if access path is authorization needed.
                     */
                    var authorization_paths = authorizationService.getAuthorizationLinkagesPath();
                    var isAuthorizationNeeded = false;
                    for(var authorization_path in authorization_paths)
                    {
                        if($location.path().indexOf(authorization_paths[authorization_path]) !== -1)
                        {
                            isAuthorizationNeeded = true;
                            break;
                        }
                    }

                    /**
                     * If authorization needed then get current manager's authorized_paths from session.
                     * If access path not existed in the authorized_paths then direct to home page.
                     */
                    if(isAuthorizationNeeded)
                    {
                        var authorized_paths = '';
                        var isAuthorized = false;
                        sessionService.getManagerSession().then(function(response){
                            authorized_paths = response.authorized_paths.split(',');
                            for(var authorized_path in authorized_paths)
                            {
                                if($location.path().indexOf(authorized_paths[authorized_path]) !== -1)
                                {
                                    isAuthorized = true;
                                    break;
                                }
                            }
                            if(!isAuthorized)
                            {
                                $location.path('/manager/home');
                            }
                        });
                    }

                }
            });
        }

        // Which nav should be shown
        var directories = ['/support_center', '/manager', '/'];
        for(var i=0; i<directories.length; i++){
            if($location.path().substring(0, directories[i].length) === directories[i]){
                $rootScope.currentNav = directories[i];
                break;
            }
        }

    });
}]);