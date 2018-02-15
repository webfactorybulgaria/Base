<div ng-app="typicms" ng-cloak ng-controller="ListController">

    <a id="uploaderAddButtonContainer" href="#" class="btn-add"><i id="uploaderAddButton" class="fa fa-plus-circle"></i><span class="sr-only">@{{ ucfirst(trans('files::global.New')) }}</span></a>
    <h1>
        <span>@{{ models.length }} @choice('files::global.files', 2)</span>
    </h1>

    <div class="dropzone" drop-zone="" id="dropzone">
        <div class="dz-message">@lang('files::global.Click or drop files to upload')</div>
    </div>

    <div class="btn-toolbar">
        @include('core::admin._lang-switcher')
    </div>

    <div class="table-responsive">

        <table st-table="displayedModels" st-safe-src="models" st-order st-filter class="table table-condensed table-main">
            <thead>
                <tr>
                    <th class="delete"></th>
                    <th class="edit"></th>
                    <th class="image">Image</th>
                    <th st-sort="position" st-sort-default="true" class="position st-sort">Position</th>
                    <th st-sort="file" class="title st-sort">Filename</th>
                    <th st-sort="alt_attribute" class="selected st-sort">Alt attribute</th>
                    <th st-sort="width" class="width st-sort">Width</th>
                    <th st-sort="height" class="width st-sort">Height</th>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td>
                        <input st-search="title" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                    <td>
                        <input st-search="alt_attribute" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>

            <tbody>
                <tr ng-repeat="model in displayedModels">
                    <td typi-btn-delete action="delete(model, model.file)"></td>
                    <td>
                        <a class="btn btn-default btn-xs btn-edit" href="../../files/@{{ model.id }}/edit?redirect_to_gallery=1" title="Edit"><span class="fa fa-pencil"></span></a>
                    </td>
                    <td ng-switch="model.type">
                        <img ng-switch-when="i" ng-src="@{{ model.thumb_src }}" alt="@{{ model.alt_attribute }}">
                        <span class="fa fa-fw fa-file-o" ng-switch-default></span>
                    </td>
                    <td>
                        <input class="form-control input-sm" min="0" type="number" name="position" string-to-number ng-model="model.position" ng-change="update(model)">
                    </td>
                    <td>@{{ model.file }}</td>
                    <td>@{{ model.alt_attribute }}</td>
                    <td>@{{ model.width }}</td>
                    <td>@{{ model.height }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" typi-pagination></td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>
