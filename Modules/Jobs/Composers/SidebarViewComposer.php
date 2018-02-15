<?php

namespace TypiCMS\Modules\Jobs\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('jobs::global.name'), function (SidebarItem $item) {
                $item->id = 'jobs';
                $item->icon = config('typicms.jobs.sidebar.icon');
                $item->weight = config('typicms.jobs.sidebar.weight');
                $item->route('admin::index-jobs');
                $item->append('admin::create-job');
                $item->authorize(
                    Gate::allows('index-jobs')
                );
            });
        });
    }
}
