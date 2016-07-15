angular.module('smart-table').directive('pageSelect', function() {
  return {
    restrict: 'E',
    template: '<input type="text" class="select-page" ng-model="inputPage" ng-change="selectPage(inputPage)">',
    link: function(scope, element, attrs) {
      scope.$watch('currentPage', function(c) {
        scope.inputPage = c;
      });
    }
  }
}).directive('stRatio', function() {
    return {
      link:function(scope, element, attr){
        var ratio =+ (attr.stRatio);

        element.css('width', ratio+'%');

      }
    };
});
