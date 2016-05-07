function EditMessageController($location, $scope, $routeParams, commonUtilService, contactUsService)
{
    $scope.config = {
        langType : 'en',
        resizeType : 0,
        width: '100%',
        items : [
            'preview', 'fontname', 'fontsize',
            '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'removeformat',
            '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist', 'insertunorderedlist',
            '|', 'link'
        ]
    };

    $scope.message = {
        'id' : $routeParams.id
    };

    function initData(){
        contactUsService.getMessageById($scope.message).then(
            function (response) {

                $scope.message = response;

                /**
                 * If get empty array then direct to home page
                 */
                if(JSON.stringify($scope.message)=='[]')
                {
                    $location.path('/manager/home');
                }
            }
        );
    }
    initData();

    $scope.reply = function()
    {
        contactUsService.reply($scope.message)
            .then(function(response){
                if(response.hasErrors){
                    commonUtilService.toastError(response.errorMap);
                } else {
                    commonUtilService.toastSuccess(response.successMap);
                    $location.path('/manager/contact_us/all_messages');
                }
            });
    };

}

EditMessageController.$inject = ['$location', '$scope', '$routeParams', 'commonUtilService', 'contactUsService'];

app.controller('EditMessageController', EditMessageController);