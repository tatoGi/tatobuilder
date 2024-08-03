<?php

namespace Tatobuilder\FormBuilder;

use Illuminate\Support\ServiceProvider;

class FormBuilderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish views
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'forms');
        
        // Publish routes
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');

        // Publish migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        // Publish assets
        $this->publishes([
            __DIR__.'/../assets' => public_path('vendor/formbuilder'),
        ], 'public');
    }

    public function register()
    {
        // Register any bindings or services
    }
}

