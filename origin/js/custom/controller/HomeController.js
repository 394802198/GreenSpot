function HomeController($scope, $http, commonUtilService, $timeout, $interval, homeService, homeProductFeatureService, homeProductComboService)
{
    $scope.home_info = {
        /** Plan length */
        productComboLength : 0,
        productFeatureLength : 0,
        planLength : 0,
        deviceLength : 0,
        addOnServiceLength : 0,
        /** Manager length */
        managerLength : 0,
        /** Contact Us length */
        messageLength : 0,
        messageNotRepliedLength : 0
    };

    function initData(){
        homeService.getHomeInfo()
            .then(function(response){
                $scope.home_info = response;
            });
    }
    initData();

    $scope.contactUs = {};
    $scope.submitContact = function()
    {
        $scope.isSubmitDisabled = true;
        $http.post('/api/contact_us/submitContact', $scope.contactUs).
            success(function(data, status, headers, config) {
                if(data.hasErrors){
                    commonUtilService.toastWarning(data.errorMap);
                    $scope.isSubmitDisabled = false;
                } else {
                    commonUtilService.toastInfo(data.successMap);
                    $timeout(function(){
                        $scope.isSubmitDisabled = false;
                    },20000);

                    $scope.contactUs.countDown=20;
                    var timer = $interval(function(){
                        if($scope.contactUs.countDown==1){
                            $interval.cancel(timer);
                        }
                        $scope.contactUs.countDown--;
                    }, 1000);
                }
            }).
            error(function(data, status, headers, config) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
            });
    };

    homeProductFeatureService.getAll()
        .then(function(response){
            $scope.productFeatures = response;
        });

    homeProductComboService.getFirstThree()
        .then(function(response){
            $scope.productCombos = response;
            for(var productCombo in $scope.productCombos)
            {
                $scope.productCombos[productCombo].feature_ids = $scope.productCombos[productCombo].feature_ids.split('^_greenspot_^');
            }
        });

}

HomeController.$inject = ['$scope', '$http', 'commonUtilService', '$timeout', '$interval', 'homeService', 'homeProductFeatureService', 'homeProductComboService'];

app.controller('HomeController', HomeController);