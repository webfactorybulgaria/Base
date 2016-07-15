angular.module('smart-table').directive('stPersist', function () {
    return {
        require: '^stTable',
        link: function (scope, element, attr, ctrl) {
            var nameSpace = attr.stPersist;

            //save the table state every time it changes
            scope.$watch(function () {
                return ctrl.tableState();
            }, function (newValue, oldValue) {
                if (newValue !== oldValue) {
                    localStorage.setItem(nameSpace, JSON.stringify(newValue));
                }
            }, true);

            var tableState = ctrl.tableState();
            //fetch the table state when the directive is loaded
            if (localStorage.getItem(nameSpace)) {
                var savedState = JSON.parse(localStorage.getItem(nameSpace));
                scope.itemsByPage = savedState.pagination.number;
            } else {
                savedState = {};
                if (attr.stSortDefault) {
                  sortDefault = scope.$eval(attr.stSortDefault) !== undefined ? scope.$eval(attr.stSortDefault) : attr.stSortDefault;
                  ctrl.tableState().sort = {
                    'predicate': sortDefault,
                    'reverse':   attr.stSortDefaultReverse ? true : false
                  };
                }
            }

            angular.merge(tableState, savedState);

            ctrl.pipe();

        }
    };
});
