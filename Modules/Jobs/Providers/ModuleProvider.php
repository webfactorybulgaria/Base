<?php

namespace TypiCMS\Modules\Jobs\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Shells\Facades\TypiCMS;
use TypiCMS\Modules\Core\Shells\Observers\FileObserver;
use TypiCMS\Modules\Core\Shells\Observers\SlugObserver;
use TypiCMS\Modules\Core\Shells\Services\Cache\LaravelCache;
use TypiCMS\Modules\Jobs\Shells\Models\Job;
use TypiCMS\Modules\Jobs\Shells\Models\JobTranslation;
use TypiCMS\Modules\Jobs\Shells\Repositories\CacheDecorator;
use TypiCMS\Modules\Jobs\Shells\Repositories\EloquentJob;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.jobs'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['jobs' => ['linkable_to_page', 'srcDir' => __DIR__.'/../']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'jobs');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'jobs');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/jobs'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Jobs',
            'TypiCMS\Modules\Jobs\Shells\Facades\Facade'
        );

        // Observers
        JobTranslation::observe(new SlugObserver());
        Job::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Jobs\Shells\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Jobs\Shells\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('jobs::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('jobs');
        });

        $app->bind('TypiCMS\Modules\Jobs\Shells\Repositories\JobInterface', function (Application $app) {
            $repository = new EloquentJob(new Job());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'jobs', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
