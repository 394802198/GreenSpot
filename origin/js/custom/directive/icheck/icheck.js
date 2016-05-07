/**
 * Created by Steven on 2015/7/23.
 */

app.directive('icheck', ['$timeout', function($timeout) {
    return {
        restrict: 'A',
        require: '?ngModel',
        scope: {
            checkboxClass: '=',
            radioClass:'=',
            ngModel: '='
        },
        link: function(scope, element, attrs) {
            element.iCheck({
                checkboxClass: element.attr('checkboxClass'),
                radioClass : element.attr('radioClass')
            });
            switch(element.context.type){
                case 'checkbox':
                    if(scope.ngModel)
                    {
                        element.iCheck('check');
                    }
                    element.on('ifChecked', function(){
                        $timeout(function() {
                            // anything you want can go here and will safely be run on the next digest.
                            scope.$apply(function() {
                                scope.ngModel = true;
                            });
                        });
                    });
                    element.on('ifUnchecked', function(){
                        $timeout(function() {
                            // anything you want can go here and will safely be run on the next digest.
                            scope.$apply(function() {
                                scope.ngModel = false;
                            });
                        });
                    });
                    break;
                case 'radio':
                    if(scope.ngModel===element.val())
                    {
                        element.iCheck('check');
                    }
                    element.on('ifChecked', function(){
                        $timeout(function() {
                            // anything you want can go here and will safely be run on the next digest.
                            scope.$apply(function() {
                                scope.ngModel = element.val();
                            });
                        });
                    });
                    break;
            }
        }
    };
}])

.directive('icheckSelector', ['$document', function($document) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            element.on('change', function(){
                var role = element.val();
                $document.find(':checkbox[data-icheck-checkbox]').iCheck('uncheck');
                $document.find(':checkbox[data-icheck-'+role+']').iCheck('check');
            });
            //element.iCheck('check');
        }
    };
}]);