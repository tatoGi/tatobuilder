<?php

namespace Tatobuilder\FormBuilder\Providers;

use Illuminate\Support\ServiceProvider;

class FormBuilderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish views
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/forms'),
        ], 'views');

        // Publish routes
        $this->publishes([
            __DIR__.'/../../routes' => base_path('routes'),
        ], 'routes');

        // Publish migrations
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'migrations');

        // Publish assets
        $this->publishes([
            __DIR__.'/../../public' => public_path('vendor/formbuilder'),
        ], 'public');
        
        // Publish controllers
        $this->publishes([
            __DIR__.'/../../src/Http/Controllers' => app_path('Http/Controllers/Forms'),
        ], 'controllers');

        // Publish models
        $this->publishes([
            __DIR__.'/../../src/Models' => app_path('Models/Forms'),
        ], 'models');
    }

    public function register()
    {
        // Register any package services here
    }
}
