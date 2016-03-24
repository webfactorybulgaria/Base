angular.module('typicms')

.directive('editTranslation', function() {
    return {
    	restrict: 'A',
        scope: {
            action: '&'
        },
        link: function($scope, element, attrs) {
            element.click(function(){
	        	element.addClass('hidden').next().removeClass('hidden');
                element.next().find('input').val($scope.$parent.model.translation);
	        	element.next().find('input').focus();
	        });
        }
    };
})

.directive('saveTranslation', function() {
    return {
    	restrict: 'A',
        scope: {
            action: '&'
        },
        link: function($scope, element, attrs) {
            element.click(function(){
	        	element.parent().addClass('hidden').prev().removeClass('hidden');
	        });
        }
    };
})

.directive('keyTranslation', function() {
    return {
    	restrict: 'A',
        scope: {
            action: '&'
        },
        require: 'ngModel',
        link: function($scope, element, attrs, ctrl) {
            element.bind('keydown keypress', function(event) {
			    if(event.which === 13) {
			    	//key enter
                    element.blur();
			    	element.next().triggerHandler('click');
			    	element.next().trigger('click');
			    	element.parent().addClass('hidden').prev().removeClass('hidden');
			    }
			    if(event.which === 27) {
                    //key escape
                    ctrl.$viewValue = $scope.$parent.temp;
                    ctrl.$render();
                    $scope.$parent.model.translation = $scope.$parent.temp;
                    //$scope.ngModel = $scope.$parent.temp;
                    $scope.$apply();
                    element.blur();
			    	element.parent().addClass('hidden').prev().removeClass('hidden');
			    }
			});
        }
    };
});


