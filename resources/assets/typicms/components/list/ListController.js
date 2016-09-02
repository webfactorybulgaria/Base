/*jslint browser: true*/
/*globals $, jQuery, angular, TypiCMS, alertify, top, window, console*/

(function (angular) {

    'use strict';

    angular.module('typicms').controller('ListController', ['$http', '$scope', '$location', '$api', function ($http, $scope, $location, $api) {

        $scope.itemsByPage = 30;
        $scope.initializing = true;
        var url = $location.absUrl().split('?')[0],
            moduleName = url.split('/')[4],
            ctrl = this;
            $scope.params = {};

        $scope.TypiCMS = TypiCMS;

        // if we query files from a gallery, we need the gallery_id value :
        if (moduleName === 'galleries' && url.split('/')[5]) {
            $scope.params.gallery_id = url.split('/')[5];
            $scope.gallery_id = $scope.params.gallery_id;
        }

        // if we query menulinks menu_id value :
        if (moduleName === 'menus' && url.split('/')[5]) {
            $scope.params.menu_id = url.split('/')[5];
            moduleName = 'menulinks';
        }

        if (TypiCMS.models) {
            $scope.models = TypiCMS.models;
            $scope.displayedModels = [].concat($scope.models);
        } else {
            /*
            $api.query($scope.params).$promise.then(function (all) {
                $scope.models = all;
                //copy the references (you could clone ie angular.copy but then have to go through a dirty checking for the matches)
                $scope.displayedModels = [].concat($scope.models);
            });
            */
        }
        if (TypiCMS.options) {
            $scope.options = TypiCMS.options;
        }

        /**
         * Empty object that will contain checked items
         */
        $scope.checked = {
            models: []
        };

        /**
         * Update tourprices filter
         */
        $scope.updateFilter = function () {
            $scope.params.tableState.pagination.start = 0;
            $scope.callServer($scope.params.tableState);
            console.log('updateFilter');
        };

        /**
         * Check all items
         */
        $scope.toggleCheckAll = function () {
            var countChecked = $scope.checked.models.length
            $scope.checked.models = [];
            if (countChecked < $scope.displayedModels.length) {
                this.checkAll();
            }
        };

        /**
         * Check all items
         */
        $scope.checkAll = function () {
            $scope.checked.models = [];
            $scope.displayedModels.forEach(function (model) {
                $scope.checked.models.push(model);
            });
        };

        /**
         * Uncheck all items
         */
        $scope.uncheckAll = function () {
            $scope.checked.models = [];
        };

        /**
         * Check all online or offline items
         */
        $scope.checkOnOffline = function (status) {
            $scope.checked.models = [];
            $scope.models.forEach(function (model) {
                if (model.status == status) {
                    $scope.checked.models.push(model);
                }
            });
        };

        /**
         * Check all offline items
         */
        $scope.checkOffline = function () {
            this.checkOnOffline(0);
        };

        /**
         * Check all online items
         */
        $scope.checkOnline = function () {
            this.checkOnOffline(1);
        };

        /**
         * Delete checked items
         */
        $scope.deleteChecked = function () {
            var ids = [],
                models = $scope.checked.models,
                number = models.length;
            if (!window.confirm('Are you sure you want to delete ' + number + ' items?')) {
                return false;
            }
            models.forEach(function (model) {
                ids.push(model.id);
                var index = $scope.models.indexOf(model);
                $scope.models.splice(index, 1);
            });

            $scope.checked.models = [];

            $api.delete({ids: ids.join()}).$promise.then(
                function (data) {
                    if (data.number < number) {
                        alertify.error((number - data.number) + ' items could not be deleted.');
                    }
                },
                function (reason) {
                    alertify.error('Error ' + reason.status + ' ' + reason.statusText);
                }
            );
        };

        /**
         * Set status = 0 or 1 for item
         */
        $scope.toggleStatus = function (model) {
            var newStatus = Math.abs(model.status - 1),
                label = (newStatus === 1)
                    ? 'online'
                    : 'offline';
            model.status = newStatus;
            $api.update({id: model.id}, model).$promise.then(
                function () {
                    alertify.success('Item is ' + label + '.');
                },
                function (reason) {
                    alertify.error('Error ' + reason.status + ' ' + reason.statusText);
                }
            );
        };

        /**
         * Set homepage = 0 or 1 for item
         */
        $scope.toggleHomepage = function (model) {
            model.homepage = Math.abs(model.homepage - 1);
            $api.update({id: model.id}, model).$promise.then(
                function () {
                    alertify.success('Homepage is set.');
                },
                function (reason) {
                    alertify.error('Error ' + reason.status + ' ' + reason.statusText);
                }
            );
        };

        /**
         * Clear history
         */
        $scope.clearHistory = function () {
            if (window.confirm('Are you sure you want to clear history?')) {
                $api.delete().$promise.then(
                    function (data) {
                        if (data.error) {
                            console.log(data);
                        } else {
                            $scope.displayedModels = [];
                        }
                    },
                    function (reason) {
                        alertify.error('Error ' + reason.status + ' ' + reason.statusText);
                    }
                );
            }
        };

        /**
         * Update model
         */
        $scope.update = function (model) {
            $api.update({id: model.id}, model).$promise.then(
                null,
                function (reason) {
                    alertify.error('Error ' + reason.status + ' ' + reason.statusText);
                }
            );
        };

        /**
         * TinyMCE File picker
         */
        $scope.selectAndClose = function (CKEditorFuncNum, file) {
            window.opener.CKEDITOR.tools.callFunction(CKEditorFuncNum, file);
            window.close();
        };

        /**
         * Delete an item from a non-nested list
         */
        $scope.delete = function (model, title) {
            if (!title) {
                title = model.title;
            }
            if (!window.confirm('Delete « ' + title + ' » ?')) {
                return false;
            }
            var index = $scope.models.indexOf(model);
            $api.delete({id: model.id}, function (data) {
                if (index !== -1) {
                    $scope.models.splice(index, 1);
                    if ($scope.stCtrl) {
                        $scope.stCtrl.pipe();
                    }
                }
                if (data.error) {
                    alertify.error('Error');
                }
            }, function (reason) {
                alertify.error('Error ' + reason.status + ' ' + reason.statusText);
            });
        };

        /**
         * Delete an item from a nested list
         */
        $scope.deleteFromNested = function (scope, title) {
            if (!title) {
                title = scope.model.title;
            }
            if (scope.hasChild()) {
                alertify.error('Cannot delete item because it has children.');
                return false;
            }
            if (!window.confirm('Supprimer « ' + title + ' » ?')) {
                return false;
            }
            $api.delete({id: scope.model.id}, function (data) {
                scope.remove();
                if (data.error) {
                    alertify.error('Error');
                }
            }, function (reason) {
                alertify.error('Error ' + reason.status + ' ' + reason.statusText);
            });
        };

        $scope.treeOptions = {
            accept: function (sourceNodeScope, destNodesScope) {
                if (destNodesScope.model && destNodesScope.model.module) {
                    return false;
                }
                return true;
            },
            dropped: function (event) {

                var model = event.source.nodeScope.model,
                    parentId = null,
                    data = {},
                    nodes = event.dest.nodesScope,
                    currentList = nodes.$modelValue;

                // If there is a parent
                if (event.dest.nodesScope.$nodeScope) {
                    parentId = nodes.$nodeScope.model.id;
                }

                // do nothing when no move
                if (event.dest.index === event.source.index && model.parent_id === parentId) {
                    return false;
                }

                data.moved = model.id;
                data.item = [];
                model.position = event.dest.index + 1;
                model.parent_id = parentId;

                angular.forEach(currentList, function (model) {
                    data.item.push({id: model.id, parent_id: model.parent_id});
                });

                $http.post('/admin/' + moduleName + '/sort', data).success(function (data) {
                    alertify.success(data.message);
                }).error(function (data) {
                    alertify.error(data.error.message);
                });

            }
        };

        $scope.callServer = function (tableState, ctrl) {
            if ( !$scope.stCtrl && ctrl ) {
                $scope.stCtrl = ctrl;
            }

            $scope.isLoading = true;

            var pagination = tableState.pagination;

            var start = pagination.start || 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
            var number = pagination.number || 20;  // Number of entries showed per page.

            $scope.params.start = start;
            $scope.params.number = number;
            $scope.params.tableState = tableState;

            $api.query($scope.params).$promise.then(function (result) {

                $scope.models = result[0].data;
                $scope.totalModels = result[0].total;
                $scope.displayedModels = [].concat($scope.models);

                tableState.pagination.numberOfPages = result[0].last_page;//set the number of pages so the pagination can update
                $scope.isLoading = false;
                $scope.initializing = false;

            });
        };


    }]);

}(angular));
