<?php

namespace Tatobuilder\FormBuilder;

use Illuminate\Support\ServiceProvider;

class FormBuilderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish views
        $this->publishes([
            __DIR__.'/../Views' => resource_path('views/vendor/forms'),
        ], 'views');

        // Publish routes
        $this->publishes([
            __DIR__.'/../../routes' => base_path('routes'),
        ], 'routes');

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
      
    }
}

