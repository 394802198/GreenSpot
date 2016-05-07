function AllMessagesController($scope, commonUtilService, contactUsService)
{
    $scope.pagination = {
        keywords : '',
        pageSize : 18,
        currentPage : 1,
        messages : []
    };

    function getResultsPage(pagination)
    {
        contactUsService.getResultsPage(pagination)
            .then(function(response)
            {
                $scope.pagination.messages.length = 0;

                for(var messageIndex in response)
                {
                    var message = [];
                    message.push(response[messageIndex].id);
                    message.push(response[messageIndex].email);
                    message.push(response[messageIndex].is_replied);
                    message.push(response[messageIndex].received_datetime);
                    message.push(response[messageIndex].replied_datetime);

                    $scope.pagination.messages.push(message);

                }
            });
    }
    getResultsPage($scope.pagination);

    $scope.filterMessages = function(pagination)
    {
        getResultsPage(pagination);
    };

    $scope.doneReply = function(id)
    {
        var data = {
            id : id
        };
        contactUsService.doneReply(data)
            .then(function(response){
                if(response.hasErrors){
                    commonUtilService.toastError(response.errorMap);
                } else {
                    commonUtilService.toastSuccess(response.successMap);
                }
                getResultsPage($scope.pagination);
            });
    };

}

AllMessagesController.$inject = ['$scope', 'commonUtilService', 'contactUsService'];

app.controller('AllMessagesController', AllMessagesController);