<?php

namespace TypiCMS\Modules\Candidates\Providers;

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
    protected $namespace = 'TypiCMS\Modules\Candidates\Shells\Http\Controllers';

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
            if ($page = TypiCMS::getPageLinkedToModule('candidates')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.candidates', 'uses' => 'PublicController@index']);
                        $router->get($uri.'/{slug}', $options + ['as' => $lang.'.candidates.slug', 'uses' => 'PublicController@show']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/candidates', 'AdminController@index')->name('admin::index-candidates');
            $router->get('admin/candidates/create', 'AdminController@create')->name('admin::create-candidate');
            $router->get('admin/candidates/{candidate}/edit', 'AdminController@edit')->name('admin::edit-candidate');
            $router->post('admin/candidates', 'AdminController@store')->name('admin::store-candidate');
            $router->put('admin/candidates/{candidate}', 'AdminController@update')->name('admin::update-candidate');

            /*
             * API routes
             */
            $router->get('api/candidates', 'ApiController@index')->name('api::index-candidates');
            $router->put('api/candidates/{candidate}', 'ApiController@update')->name('api::update-candidate');
            $router->delete('api/candidates/{candidate}', 'ApiController@destroy')->name('api::destroy-candidate');
        });
    }
}
