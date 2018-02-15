<?php

namespace TypiCMS\Modules\Jobs\Providers;

use Illuminate\Routing\Router;
use TypiCMS\Modules\Core\Shells\Facades\TypiCMS;
use TypiCMS\Modules\Core\Shells\Providers\BaseRouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'TypiCMS\Modules\Jobs\Shells\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function (Router $router) {

            /*
             * Front office routes
             */
            if ($page = TypiCMS::getPageLinkedToModule('jobs')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.jobs', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.jobs.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/jobs', 'AdminController@index')->name('admin::index-jobs');
            $router->get('admin/jobs/create', 'AdminController@create')->name('admin::create-job');
            $router->get('admin/jobs/{job}/edit', 'AdminController@edit')->name('admin::edit-job');
            $router->post('admin/jobs', 'AdminController@store')->name('admin::store-job');
            $router->put('admin/jobs/{job}', 'AdminController@update')->name('admin::update-job');

            /*
             * API routes
             */
            $router->get('api/jobs', 'ApiController@index')->name('api::index-jobs');
            $router->put('api/jobs/{job}', 'ApiController@update')->name('api::update-job');
            $router->delete('api/jobs/{job}', 'ApiController@destroy')->name('api::destroy-job');
        });
    }
}
