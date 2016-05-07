app.factory('commonUtilService',['toastr',function(toastr){

    function getJsonArr(msgMap)
    {
        var msgMapArr = [];
        for(var msg in msgMap){
            msgMapArr.push(msgMap[msg]);
        }
        return msgMapArr;
    }

    return{
        toastWarning:function(msgMap){
            var msgMapArr = getJsonArr(msgMap);
            for(var i=msgMapArr.length; i>0; i--)
            {
                toastr.warning(msgMapArr[i-1]);
            }
        },
        toastError:function(msgMap){
            var msgMapArr = getJsonArr(msgMap);
            for(var i=msgMapArr.length; i>0; i--)
            {
                toastr.error(msgMapArr[i-1]);
            }
        },
        toastInfo:function(msgMap){
            var msgMapArr = getJsonArr(msgMap);
            for(var i=msgMapArr.length; i>0; i--)
            {
                toastr.info(msgMapArr[i-1]);
            }
        },
        toastSuccess:function(msgMap){
            var msgMapArr = getJsonArr(msgMap);
            for(var i=msgMapArr.length; i>0; i--)
            {
                toastr.success(msgMapArr[i-1]);
            }
        }
    };

}]);