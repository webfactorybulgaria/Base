<?php

namespace TypiCMS\Modules\Candidates\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Shells\Facades\TypiCMS;
use TypiCMS\Modules\Core\Shells\Observers\FileObserver;
use TypiCMS\Modules\Core\Shells\Observers\SlugObserver;
use TypiCMS\Modules\Core\Shells\Services\Cache\LaravelCache;
use TypiCMS\Modules\Candidates\Shells\Models\Candidate;
use TypiCMS\Modules\Candidates\Shells\Models\CandidateTranslation;
use TypiCMS\Modules\Candidates\Shells\Repositories\CacheDecorator;
use TypiCMS\Modules\Candidates\Shells\Repositories\EloquentCandidate;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.candidates'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['candidates' => ['linkable_to_page', 'srcDir' => __DIR__.'/../']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'candidates');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'candidates');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/candidates'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Candidates',
            'TypiCMS\Modules\Candidates\Shells\Facades\Facade'
        );

        // Observers
        CandidateTranslation::observe(new SlugObserver());
        Candidate::observe(new FileObserver());
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Candidates\Shells\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Candidates\Shells\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('candidates::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('candidates');
        });

        $app->bind('TypiCMS\Modules\Candidates\Shells\Repositories\CandidateInterface', function (Application $app) {
            $repository = new EloquentCandidate(new Candidate());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'candidates', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
