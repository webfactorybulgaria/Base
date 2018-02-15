<?php

namespace TypiCMS\Modules\Candidates\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('candidates::global.name'), function (SidebarItem $item) {
                $item->id = 'candidates';
                $item->icon = config('typicms.candidates.sidebar.icon');
                $item->weight = config('typicms.candidates.sidebar.weight');
                $item->route('admin::index-candidates');
                $item->append('admin::create-candidate');
                $item->authorize(
                    Gate::allows('index-candidates')
                );
            });
        });
    }
}
