<?php

namespace Tatobuilder\FormBuilder;

use Illuminate\Support\ServiceProvider;

class FormBuilderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish views
        $this->publishes([
            __DIR__.'/../Resources/views' => resource_path('views/vendor/formbuilder'),
        ], 'views');

        // Load routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Publish migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        // Publish assets
        $this->publishes([
            __DIR__.'/../assets' => public_path('vendor/formbuilder'),
        ], 'public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Register any package services
    }
}
