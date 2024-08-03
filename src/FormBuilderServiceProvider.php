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
        $this->loadViewsFrom(__DIR__.'/Resources/views', 'forms');

        // Publish routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Publish migrations if necessary
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations')
        ], 'migrations');
        $this->publishes([
            __DIR__ . '/../src/assets' => public_path('vendor/formbuilder'),
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
