<div ng-app="typicms" ng-cloak ng-controller="ListController">

    <div class="panel panel-default">

        <div class="panel-heading">
            <h2 class="panel-title">@lang('history::global.Latest changes')</h2>
            @can('destroy-history')
            <button class="btn-clear-history" id="clear-history" ng-click="clearHistory()">@lang('history::global.Clear')</button>
            @endcan
        </div>

        <div class="table-responsive">
            <table st-table="displayedModels" st-pipe="callServer" class="table table-condensed table-main">
                <thead>
                    <tr>
                        <th class="created_at">Date</th>
                        <th class="title">Title</th>
                        <th class="historable_table">Module</th>
                        <th class="action">Action</th>
                        <th class="user_name">User</th>
                    </tr>
                </thead>

                <tbody ng-class="{'table-loading':isLoading}">
                    <tr ng-repeat="model in displayedModels">
                        <td>@{{ model.created_at | dateFromMySQL:'short' }}</td>
                        <td>
                            <a ng-if="model.href" href="@{{ model.href }}?locale=@{{ model.locale }}">@{{ model.title }}</a>
                            <span ng-if="! model.href">@{{ model.title }}</span>
                            <span ng-if="model.locale">(@{{ model.locale }})</span>
                        </td>
                        <td>@{{ model.historable_table }}</td>
                        <td>
                            <span class="fa fa-fw @{{ model.icon_class }}"></span> @{{ model.action }}
                        </td>
                        <td>@{{ model.user_name }}</td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>

</div>
